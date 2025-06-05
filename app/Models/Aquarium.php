<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Measurement;

class Aquarium extends Model 
{
    protected $fillable = [
        'name', 
        'volume_liters', 
        'type', 
        'description',
        'started_at'  
    ];

    protected $casts = [
        'custom_thresholds' => 'array',
        'started_at' => 'date'  
    ];

    public function measurements() {
        return $this->hasMany(Measurement::class);
    }

    public function problems()
    {
        return $this->hasMany(Problem::class);
    }

    public function activeProblems()
    {
        return $this->problems()->whereNull('resolved_on');
    }

    /**
     * Get water parameter thresholds for this aquarium
     * @return array
     */
    public function getThresholds(): array
    {
        // Get default thresholds from config based on water type
        $waterType = $this->water_type ?: 'zoetwater'; // Default to freshwater if not set
        $defaultThresholds = config('water_thresholds.' . $waterType);
        
        // Initialize thresholds with defaults
        $thresholds = $defaultThresholds;
        
        // Override with custom values from settings if they exist
        if ($this->settings) {
            foreach ($thresholds as $param => $values) {
                if (property_exists($this->settings, "{$param}_min") && 
                    $this->settings->{"{$param}_min"} !== null) {
                    $thresholds[$param]['min'] = $this->settings->{"{$param}_min"};
                }
                
                if (property_exists($this->settings, "{$param}_max") && 
                    $this->settings->{"{$param}_max"} !== null) {
                    $thresholds[$param]['max'] = $this->settings->{"{$param}_max"};
                }
            }
        }
        
        return $thresholds;
    }

    public function needsWaterRefresh(): bool
    {
        $latestRefresh = $this->latest_water_refresh;

        if (!$latestRefresh) {
            return true;
        }

        $refreshDays = Setting::where('key', 'general')
            ->first()?->value['water_refresh_days'] ?? 14;

        return $latestRefresh->diffInDays(now()) >= $refreshDays;
    }

    public function daysSinceLastWaterRefresh(): ?int
    {
        $latestRefresh = $this->latest_water_refresh;
        return $latestRefresh ? $latestRefresh->diffInDays(now()) : null;
    }
    
    public function activeProblemsCount(): int
    {
        return $this->active_problems_count ?? 0;
    }

    public function scopeWithLatestWaterRefresh(Builder $query): Builder
    {
        return $query->addSelect([
            'latest_water_refresh' => Measurement::select('measured_on')
                ->whereColumn('aquarium_id', 'aquaria.id')
                ->whereNotNull('water_refresh_liters')
                ->latest('measured_on')
                ->limit(1)
        ])
        ->withCasts(['latest_water_refresh' => 'datetime']);
    }
}
