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

    public function getThresholds(): array
    {
        $defaultThresholds = config('water_thresholds.' . $this->type, []);
                
        $customThresholds = $this->custom_thresholds ?? [];
        
        return array_merge($defaultThresholds, $customThresholds);
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
