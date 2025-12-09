<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Course;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // STORE
    public function store(Request $request, Course $course)
    {
        // Validate inputs
        $validated = $request->validate([
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'building' => 'nullable|string',
            'room' => 'nullable|string',
        ]);

        // Reformat time
        $startFormatted = date("g:i A", strtotime($validated['start_time']));
        $endFormatted = date("g:i A", strtotime($validated['end_time']));
        $time = $startFormatted . ' - ' . $endFormatted;

        // Create the schedule
        Schedule::create([
            'course_id'    => $course->id,
            'day'          => $request->day,
            'time'         => $time,
            'building'     => $request->building,
            'room'         => $request->room,

            // AUTO-FILL from course
            'course_code'  => $course->code,
            'course_name'  => $course->title,
            'instructor'   => $course->instructor,
        ]);

        return back()->with('success', 'Schedule added successfully!');
    }


    // UPDATE
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        // Validate inputs
        $validated = $request->validate([
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'building' => 'nullable|string',
            'room' => 'nullable|string',
        ]);

        // Reformat time
        $startFormatted = date("g:i A", strtotime($validated['start_time']));
        $endFormatted = date("g:i A", strtotime($validated['end_time']));

        $validated['time'] = $startFormatted . ' - ' . $endFormatted;

        // Remove temporary fields
        unset($validated['start_time'], $validated['end_time']);

        // Update the record
        $schedule->update($validated);

        return redirect()->back()->with('success', 'Schedule updated successfully.');
    }

    // DELETE
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return back()->with('success', 'Schedule deleted.');
    }
}
