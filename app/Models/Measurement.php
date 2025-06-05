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
        $thresholds = $this->aquarium->getThresholds();

        $parameters = [
            'temperature' => __('measurements.parameters.temperature'),
            'ph' => __('measurements.parameters.ph'),
            'kh' => __('measurements.parameters.kh'),
            'gh' => __('measurements.parameters.gh'),
            'nh4' => __('measurements.parameters.nh4'),
            'no2' => __('measurements.parameters.no2'),
            'no3' => __('measurements.parameters.no3')
        ];

        foreach ($parameters as $param => $label) {
            if (isset($this->$param) && isset($thresholds[$param])) {
                if (isset($thresholds[$param]['min']) && $this->$param < $thresholds[$param]['min']) {
                    $suggestions[] = [
                        'type' => 'warning',
                        'message' => __('measurements.suggestions.too_low', [
                            'parameter' => $label,
                            'value' => $this->$param,
                            'threshold' => $thresholds[$param]['min']
                        ])
                    ];
                }
                if (isset($thresholds[$param]['max']) && $this->$param > $thresholds[$param]['max']) {
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
        }

        return $suggestions;
    }



}