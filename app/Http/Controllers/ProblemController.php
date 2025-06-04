<?php

namespace App\Http\Controllers;

use App\Models\Aquarium;
use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function index(Aquarium $aquarium)
    {
        $problems = $aquarium->problems()->latest()->paginate(10);
        return view('problems.index', compact('aquarium', 'problems'));
    }

    public function create(Aquarium $aquarium)
    {
        return view('problems.create', compact('aquarium'));
    }

    public function store(Request $request, Aquarium $aquarium)
    {
        $validated = $request->validate([
            'type' => 'required|in:ziekte,algen,apparatuur,overig',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'started_on' => 'required|date',
        ]);

        $aquarium->problems()->create($validated);

        return redirect()
            ->route('aquariums.problems.index', $aquarium)
            ->with('success', 'Probleem succesvol geregistreerd.');
    }

    public function resolve(Request $request, Aquarium $aquarium, Problem $problem)
    {
        $validated = $request->validate([
            'solution' => 'required|string',
            'resolved_on' => 'required|date'
        ]);

        $problem->update($validated);

        return redirect()
            ->route('aquariums.problems.index', $aquarium)
            ->with('success', 'Probleem opgelost!');
    }
}