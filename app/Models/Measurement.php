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
            'temperature' => 'Temperature',
            'ph' => 'pH',
            'kh' => 'KH',
            'gh' => 'GH',
            'nh4' => 'NH₄',
            'no2' => 'NO₂',
            'no3' => 'NO₃'
        ];

        foreach ($parameters as $param => $label) {
            if (isset($this->$param) && isset($thresholds[$param])) {
                if (isset($thresholds[$param]['min']) && $this->$param < $thresholds[$param]['min']) {
                    $suggestions[] = [
                        'type' => 'warning',
                        'message' => "{$label} is te laag ({$this->$param}). Moet minimaal {$thresholds[$param]['min']} zijn."
                    ];
                }
                if (isset($thresholds[$param]['max']) && $this->$param > $thresholds[$param]['max']) {
                    $suggestions[] = [
                        'type' => 'danger',
                        'message' => "{$label} is te hoog ({$this->$param}). Moet maximaal {$thresholds[$param]['max']} zijn."
                    ];
                }
            }
        }

        return $suggestions;
    }



}