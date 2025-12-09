<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Activity;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:courses,code',
            'title' => 'required',
            'instructor' => 'required',
            'image' => 'nullable|image|max:5000'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                                 ->store('course_images', 'public');
        }

        Course::create([
            'code' => strtoupper($request->code),
            'title' => $request->title,
            'instructor' => $request->instructor,
            'image' => $imagePath
        ]);

        return redirect()->route('courses.index')
                         ->with('success', 'Course created successfully.');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'code' => 'required|unique:courses,code,' . $id,
            'title' => 'required',
            'instructor' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = $course->image;

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }

            $imagePath = $request->file('image')
                                 ->store('course_images', 'public');
        }

        $course->update([
            'code' => strtoupper($request->code),
            'title' => $request->title,
            'instructor' => $request->instructor,
            'image' => $imagePath
        ]);

        return redirect()->route('courses.index')
                         ->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('courses.index')
                         ->with('success', 'Course deleted successfully.');
    }

    public function storeActivity(Request $request, Course $course)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'due_date' => 'nullable|date',
        ]);
    
        $course->activities()->create([
            'category' => $request->category,
            'title' => $request->title,
            'due_date' => $request->due_date,
        ]);
    
        return back()->with('success', 'Activity added!');
    }
    
    public function updateActivity(Request $request, Activity $activity)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'due_date' => 'nullable|date',
        ]);
    
        $activity->update($request->only('category','title','due_date'));
    
        return back()->with('success', 'Activity updated!');
    }
    
    public function deleteActivity(Activity $activity)
    {
        $activity->delete();
    
        return back()->with('success', 'Activity deleted!');
    }
}
