<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class Measurement extends Model {
    //use HasFactory;
    
    protected $fillable = [
        'aquarium_id', 'measured_on', 'temperature', 'ph', 'kh', 'gh',
        'nh4', 'no2', 'no3', 'po4', 'o2', 'co2', 'water_refresh_liters'
    ];

    protected $casts = [
        'measured_on' => 'datetime',
    ];

    public function aquarium() {
        return $this->belongsTo(Aquarium::class);
    }

    public function suggestions(): array
    {
        $suggestions = [];
        
        // Make sure the aquarium relationship is loaded
        $aquarium = $this->aquarium;
        if (!$aquarium) {
            return $suggestions;
        }
        
        // Get water type - default to 'zoetwater' if not set
        $waterType = $aquarium->water_type ?? 'zoetwater';
        
        // Get thresholds from config based on water type
        $thresholds = config("water_thresholds.{$waterType}");
        if (!$thresholds) {
            return $suggestions;
        }
        
        // Parameters to check with their translated names
        $parameters = [
            'temperature' => __('measurements.parameters.temperature'),
            'ph' => __('measurements.parameters.ph'),
            'kh' => __('measurements.parameters.kh'),
            'gh' => __('measurements.parameters.gh'),
            'nh4' => __('measurements.parameters.nh4'),
            'no2' => __('measurements.parameters.no2'),
            'no3' => __('measurements.parameters.no3'),
            'po4' => __('measurements.parameters.po4')
        ];
        
        // Compare each parameter with its threshold
        foreach ($parameters as $param => $label) {
            // Skip if measurement value is null
            if ($this->$param === null) {
                continue;
            }
            
            // Skip if threshold for this parameter doesn't exist
            if (!isset($thresholds[$param])) {
                continue;
            }
            
            // Now check if the value is outside thresholds
            if (isset($thresholds[$param]['min']) && 
                $this->$param < $thresholds[$param]['min']) {
                $suggestions[] = [
                    'type' => 'warning',
                    'message' => __('measurements.suggestions.too_low', [
                        'parameter' => $label,
                        'value' => $this->$param,
                        'threshold' => $thresholds[$param]['min']
                    ])
                ];
            }
            
            if (isset($thresholds[$param]['max']) && 
                $this->$param > $thresholds[$param]['max']) {
                $suggestions[] = [
                    'type' => 'danger',
                    'message' => __('measurements.suggestions.too_high', [
                        'parameter' => $label,
                        'value' => $this->$param,
                        'threshold' => $thresholds[$param]['max']
                    ])
                ];
            }
        }
        
        return $suggestions;
    }



}