<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SliderImage;
use Illuminate\Support\Facades\Storage;

class SliderImageController extends Controller
{
    
    public function index()
    {
        $images = SliderImage::orderBy('order_index', 'asc')->paginate(5);
        return view('slider.index', compact('images'));
    }

    
    public function create()
    {
        return view('slider.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'in:active,inactive'
        ]);

        $path = $request->file('image')->store('slider', 'public');

        SliderImage::create([
            'title' => $request->title,
            'image_path' => $path,
            'order_index' => SliderImage::max('order_index') + 1,
            'status' => $request->status ?? 'active'
        ]);

        return redirect()->route('slider.index')->with('success', 'Image added successfully!');
    }

    
    public function edit($id)
    {
        $image = SliderImage::findOrFail($id);
        return view('slider.edit', compact('image'));
    }

    
    public function update(Request $request, $id)
    {
        $image = SliderImage::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'in:active,inactive'
        ]);

        $updateData = [
            'title' => $request->title,
            'status' => $request->status
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $updateData['image_path'] = $request->file('image')->store('slider', 'public');
        }

        $image->update($updateData);

        return redirect()->route('slider.index')->with('success', 'Image updated successfully!');
    }

    
    public function destroy($id)
    {
        $image = SliderImage::findOrFail($id);

        // Delete file from storage
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()->route('slider.index')->with('success', 'Image deleted successfully!');
    }

    public function getActiveImages()
    {
        $images = SliderImage::active()
            ->orderBy('order_index', 'asc')
            ->get(['id', 'title', 'image_path', 'order_index', 'status']);

        return response()->json([
            'status' => true,
            'data' => $images->map(fn($img) => [
                'id' => $img->id,
                'title' => $img->title,
                'image_url' => asset('storage/' . $img->image_path),
                'order' => $img->order_index,
                'status' => $img->status
            ])
        ]);
    }
}
