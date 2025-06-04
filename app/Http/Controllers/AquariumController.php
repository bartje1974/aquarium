<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aquarium;

class AquariumController extends Controller 
{
    public function index() 
    {
        $aquariums = Aquarium::query()
            ->withCount(['problems as active_problems_count' => fn($query) => 
                $query->whereNull('resolved_on')
            ])
            ->withLatestWaterRefresh()
            ->latest()
            ->get();

        return view('aquariums.index', compact('aquariums'));
    }

    public function create() 
    {
        return view('aquariums.create');
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:2',
            'volume_liters' => 'required|numeric|min:0|max:10000',
            'type' => 'required|in:zoetwater,zoutwater',
            'started_at' => 'required|date|before_or_equal:today',
            'description' => 'nullable|string|max:1000'
        ]);

        Aquarium::create($validated);
        
        return redirect()
            ->route('aquariums.index')
            ->with('success', __('aquarium.messages.created'));
    }
}