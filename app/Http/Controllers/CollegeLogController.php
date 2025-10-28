<?php

namespace App\Http\Controllers;

use App\Models\CollegeLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CollegeLogController extends Controller
{
    public function index()
    {
        $collegeLogs = CollegeLog::latest()->paginate(10);
        return view('college_logs.index', compact('collegeLogs'));
    }

    public function create()
    {
        return view('college_logs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        $data = $request->only('name', 'description');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('college_logs', 'public');
        }

        CollegeLog::create($data);

        return redirect()->route('college_logs.index')->with('success', 'College Log added successfully!');
    }

    public function edit(CollegeLog $collegeLog)
    {
        return view('college_logs.edit', compact('collegeLog'));
    }

    public function update(Request $request, CollegeLog $collegeLog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        $data = $request->only('name', 'description');

        if ($request->hasFile('image')) {
            if ($collegeLog->image) {
                Storage::disk('public')->delete($collegeLog->image);
            }
            $data['image'] = $request->file('image')->store('college_logs', 'public');
        }

        $collegeLog->update($data);

        return redirect()->route('college_logs.index')->with('success', 'College Log updated successfully!');
    }

    public function destroy(CollegeLog $collegeLog)
    {
        if ($collegeLog->image) {
            Storage::disk('public')->delete($collegeLog->image);
        }
        $collegeLog->delete();

        return redirect()->route('college_logs.index')->with('success', 'College Log deleted successfully!');
    }
}
