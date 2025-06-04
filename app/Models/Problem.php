<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Problem extends Model
{
    use HasFactory;

    protected $fillable = [
        'aquarium_id',
        'type',
        'title',
        'description',
        'started_on',
        'resolved_on',
        'solution'
    ];

    protected $casts = [
        'started_on' => 'date',
        'resolved_on' => 'date'
    ];

    public function aquarium()
    {
        return $this->belongsTo(Aquarium::class);
    }

    public function isResolved(): bool
    {
        return !is_null($this->resolved_on);
    }
}