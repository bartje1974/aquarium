<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use App\Models\Aquarium;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    public function index(Aquarium $aquarium)
    {
        $measurements = $aquarium->measurements()
            ->with('aquarium')  // Eager load aquarium relationship
            ->latest('measured_on')
            ->paginate(10);

        return view('measurements.index', compact('aquarium', 'measurements'));
    }

    public function create($aquariumId)
    {
        $aquarium = Aquarium::findOrFail($aquariumId);
        return view('measurements.create', compact('aquarium'));
    }

   
    public function store(Request $request, $aquariumId)
    {
        $aquarium = Aquarium::findOrFail($aquariumId);
        
        $validated = $request->validate([
            'measured_on' => 'required|date',
            'temperature' => 'required|numeric',
            'ph' => 'required|numeric',
            'kh' => 'nullable|numeric',
            'gh' => 'nullable|numeric',
            'nh4' => 'nullable|numeric',
            'no2' => 'nullable|numeric',
            'no3' => 'nullable|numeric',
            'po4' => 'nullable|numeric',
            'o2' => 'nullable|numeric',
            'co2' => 'nullable|numeric',
            'water_refresh_liters' => 'nullable|numeric|min:0'
        ]);

        $aquarium->measurements()->create($validated);

        return redirect()
            ->route('aquariums.measurements.create', $aquarium)
            ->with('success', __('measurements.messages.created_add_another'));
    }

    public function edit($aquariumId, Measurement $measurement)
    {
        $aquarium = Aquarium::findOrFail($aquariumId);
        return view('measurements.edit', compact('aquarium', 'measurement'));
    }

    public function update(Request $request, $aquariumId, Measurement $measurement)
    {
        $aquarium = Aquarium::findOrFail($aquariumId);
    
        $validated = $request->validate([
            'measured_on' => 'required|date',
            'temperature' => 'required|numeric',
            'ph' => 'required|numeric',
            'kh' => 'nullable|numeric',
            'gh' => 'nullable|numeric',
            'nh4' => 'nullable|numeric',
            'no2' => 'nullable|numeric',
            'no3' => 'nullable|numeric',
            'po4' => 'nullable|numeric',
            'o2' => 'nullable|numeric',
            'co2' => 'nullable|numeric',
            'water_refresh_liters' => 'nullable|numeric|min:0'
        ]);

        $measurement->update($validated);

        return redirect()
            ->route('aquariums.measurements.index', $aquarium)
            ->with('success', __('measurements.messages.updated'));
    }

    public function show($aquariumId, Measurement $measurement)
    {
        $aquarium = Aquarium::findOrFail($aquariumId);
        $measurement->load('aquarium'); // Eager load if needed
        $suggestions = $measurement->suggestions();
        
        return view('measurements.show', compact('aquarium', 'measurement', 'suggestions'));
    }
}
