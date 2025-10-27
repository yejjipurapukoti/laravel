<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{


    public function __construct()
    {
        
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                abort(403, 'Unauthorized access.');
            }
            return $next($request);
        });
    }
    
    public function index()
    {
        $students = User::latest()->paginate(10);
        // dd($students);
        return view('students.index', compact('students'));
    }

    
    public function create()
    {
        return view('students.create');
    }


    
  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);
    // dd($request->all());

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images/students', 'public');
    }

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'image' => $imagePath,
    ]);

    return redirect()->route('students.index')
        ->with('success', 'Student created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $student = User::findOrFail($id);
    return view('students.show', compact('student'));
}


    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
{
    $student = User::findOrFail($id);
    return view('students.edit', compact('student'));
}

public function update(Request $request, string $id)
{
    $student = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $student->id,
        'password' => 'nullable|string|min:8|confirmed',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = $student->image; // keep old image if not updated

    if ($request->hasFile('image')) {
      
        if ($student->image && Storage::disk('public')->exists($student->image)) {
            Storage::disk('public')->delete($student->image);
        }

        // store new image
        $imagePath = $request->file('image')->store('images/students', 'public');
    }

    $student->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->filled('password') ? bcrypt($request->password) : $student->password,
        'image' => $imagePath,
    ]);

    return redirect()->route('students.index')
        ->with('success', 'Student updated successfully.');
}

public function destroy(string $id)
{
    $student = User::findOrFail($id);

  
    if ($student->image && Storage::disk('public')->exists($student->image)) {
        Storage::disk('public')->delete($student->image);
    }

    $student->delete();

    return redirect()->route('students.index')
        ->with('success', 'Student deleted successfully.');
}

}
