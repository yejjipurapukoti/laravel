<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    public function index()
    {
        $institutes = Institute::latest()->paginate(10);
        return view('institutes.index', compact('institutes'));
    }

    public function create()
    {
        return view('institutes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'number_of_students' => 'nullable|max:255',
        ]);

        Institute::create($request->only(['description', 'number_of_students']));

        return redirect()->route('institutes.index')->with('success', 'Institute created successfully!');
    }

    public function show(string $id)
    {
        $institute = Institute::findOrFail($id);
        return view('institutes.show', compact('institute'));
    }

    public function edit(string $id)
    {
        $institute = Institute::findOrFail($id);
        return view('institutes.edit', compact('institute'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'number_of_students' => 'nullable|max:255',
        ]);

        $institute = Institute::findOrFail($id);
        $institute->update($request->only(['description', 'number_of_students']));

        return redirect()->route('institutes.index')->with('success', 'Institute updated successfully!');
    }

    public function destroy(string $id)
    {
        $institute = Institute::findOrFail($id);
        $institute->delete();

        return redirect()->route('institutes.index')->with('success', 'Institute deleted successfully!');
    }
}
