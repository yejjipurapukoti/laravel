<?php

namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::orderBy('created_at', 'desc')->paginate(5);
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'exam_type' => 'nullable|string|max:100',
            'file' => 'nullable|mimes:pdf|max:5120',
            'link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);

        $path = $request->hasFile('file')
            ? $request->file('file')->store('materials', 'public')
            : null;

        StudyMaterial::create([
            'title' => $request->title,
            'exam_type' => $request->exam_type,
            'file_path' => $path,
            'link' => $request->link,
            'status' => $request->status,
        ]);

        return redirect()->route('materials.index')->with('success', 'Study material saved successfully!');
    }

    public function edit($id)
    {
        $material = StudyMaterial::findOrFail($id);
        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $material = StudyMaterial::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'exam_type' => 'nullable|string|max:100',
            'file' => 'nullable|mimes:pdf|max:5120',
            'link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only(['title', 'exam_type', 'link', 'status']);

        if ($request->hasFile('file')) {
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }
            $data['file_path'] = $request->file('file')->store('materials', 'public');
        }

        $material->update($data);

        return redirect()->route('materials.index')->with('success', 'Study material updated successfully!');
    }

    public function destroy($id)
    {
        $material = StudyMaterial::findOrFail($id);
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Study material deleted successfully!');
    }
}
