<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    //
    public function index(Request $request)
    {
        $type = $request->query('type');

        $careers = Career::latest()->simplePaginate(5);
    
        return view('admin.careers.index', compact('careers', 'type'));
    }
    public function filterByType($type)
    {
        // Retrieve careers filtered by type
        $careers = Career::where('type', $type)->latest()->simplePaginate(5);

        return view('admin.careers.index', compact('careers', 'type'));
    }

    // Show the form for creating a new career
    public function create()
    {
        return view('admin.careers.create');
    }

    // Store a newly created career in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:full-time,part-time,contract,internship,remote',
            'category' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'expiration_date' => 'nullable|date',
        ]);

        Career::create($validatedData);

        return redirect()->route('careers.index')->with('success', 'Career created successfully.');
    }

    // Show the form for editing the specified career
    public function edit(Career $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    // Update the specified career in the database
    public function update(Request $request, Career $career)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:full-time,part-time,contract,internship,remote',
            'category' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'expiration_date' => 'nullable|date',
        ]);

        $career->update($validatedData);

        return redirect()->route('careers.index')->with('success', 'Career updated successfully.');
    }

    // Remove the specified career from the database
    public function destroy(Career $career)
    {
        $career->delete();

        return redirect()->route('careers.index')->with('success', 'Career deleted successfully.');
    }
}
