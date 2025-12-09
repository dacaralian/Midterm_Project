@extends('layout')

@section('title', 'BSIT 3B Course Details')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}" />
@endsection

@section('courses_active')
class="active"
@endsection

@section('content')
<div class="content-wrapper">

    <a href="{{ route('courses.index') }}" class="back-btn">
        <i class="ri-arrow-left-line"></i> Back to Courses
    </a>

    <br><br>

    <div class="course-banner">
        <img src="{{ $course->image ? asset('storage/'.$course->image) : asset('default-course.png') }}">
    </div>

    <div class="course-info">
        <h2>{{ $course->title }}</h2>
        <p><i class="ri-user-fill"></i> {{ $course->instructor }}</p>
    </div>

    <hr class="divider">

    <div class="section">
        <h3><i class="ri-information-line"></i> Course Code</h3>
        <p>{{ $course->code }}</p>
    </div>

    <hr class="divider">

    <!-- SCHEDULE SECTION -->
    <div class="section">
        <h3><i class="ri-calendar-check-fill"></i> Schedule</h3>

        @if($course->schedules->count())
        <ul class="schedule-list">
            @foreach($course->schedules as $sched)
                <li>
                    <div>
                        <strong>{{ $sched->day }}</strong> —
                        {{ $sched->time }}  
                        <br>
                        <small>{{ $sched->building }} • {{ $sched->room }}</small>
                    </div>

                    <div class="actions">

                        <!-- Edit Button -->
                        <button onclick="document.getElementById('editSched{{ $sched->id }}').showModal()"
                                class="btn-action edit">
                            <i class="ri-edit-2-line"></i> Edit
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('schedules.destroy', $sched->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this schedule?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-action delete">
                                <i class="ri-delete-bin-line"></i> Delete
                            </button>
                        </form>

                    </div>

                    <!-- Edit Modal -->
                    <dialog id="editSched{{ $sched->id }}">
                        <form method="POST" action="{{ route('schedules.update', $sched->id) }}">
                            @csrf
                            @method('PUT')

                            <h3>Edit Schedule</h3>

                            <!-- Day Dropdown -->
                            <label>Day</label>
                            <select name="day" required>
                                <option {{ $sched->day == 'Monday' ? 'selected' : '' }}>Monday</option>
                                <option {{ $sched->day == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                <option {{ $sched->day == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                <option {{ $sched->day == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                <option {{ $sched->day == 'Friday' ? 'selected' : '' }}>Friday</option>
                                <option {{ $sched->day == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                <option {{ $sched->day == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                            </select>

                            @php
                                // Convert "8:00 AM - 10:30 AM" → time inputs
                                $timeParts = explode(' - ', $sched->time);
                                $start = date("H:i", strtotime($timeParts[0]));
                                $end = date("H:i", strtotime($timeParts[1]));
                            @endphp

                            <!-- Time Inputs -->
                            <label>Start Time</label>
                            <input type="time" name="start_time" value="{{ $start }}" required>

                            <label>End Time</label>
                            <input type="time" name="end_time" value="{{ $end }}" required>

                            <!-- Building Dropdown -->
                            <label>Building</label>
                            <select name="building">
                                <option {{ $sched->building == '' ? 'selected' : '' }}>None</option>
                                <option {{ $sched->building == 'Acad. Building 4' ? 'selected' : '' }}>Acad. Building 4</option>
                                <option {{ $sched->building == 'Main Building' ? 'selected' : '' }}>Main Building</option>
                                <option {{ $sched->building == 'CS Building' ? 'selected' : '' }}>CS Building</option>
                                <option {{ $sched->building == 'Engineering Building' ? 'selected' : '' }}>Engineering Building</option>
                                <option {{ $sched->building == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>

                            <!-- Room Dropdown -->
                            <label>Room</label>
                            <select name="room">
                                <option {{ $sched->room == '' ? 'selected' : '' }}>None</option>
                                <option {{ $sched->room == 'Room 1' ? 'selected' : '' }}>Room 1</option>
                                <option {{ $sched->room == 'Room 2' ? 'selected' : '' }}>Room 2</option>
                                <option {{ $sched->room == 'Room 3' ? 'selected' : '' }}>Room 3</option>
                                <option {{ $sched->room == 'Room 4' ? 'selected' : '' }}>Room 4</option>
                                <option {{ $sched->room == 'Room 5' ? 'selected' : '' }}>Room 5</option>
                                <option {{ $sched->room == 'IT Lab 1' ? 'selected' : '' }}>IT Lab 1</option>
                                <option {{ $sched->room == 'IT Lab 2' ? 'selected' : '' }}>IT Lab 2</option>
                                <option {{ $sched->room == 'CS LAB' ? 'selected' : '' }}>CS LAB</option>
                                <option {{ $sched->room == 'OPEN LAB' ? 'selected' : '' }}>OPEN LAB</option>
                                <option {{ $sched->room == 'MAC LAB' ? 'selected' : '' }}>MAC LAB</option>
                                <option {{ $sched->room == 'ERP LAB' ? 'selected' : '' }}>ERP LAB</option>
                            </select>

                            <button type="submit">Save</button>
                            <button type="button" onclick="this.closest('dialog').close()">Cancel</button>
                        </form>
                    </dialog>

                </li>
            @endforeach
        </ul>
        @else
        <p>No schedule added yet.</p>
        @endif

        <!-- Add Schedule Button -->
        <button class="btn-add" onclick="document.getElementById('addScheduleModal').showModal()">
            <i class="ri-add-line"></i> Add Schedule
        </button>

        <!-- ADD SCHEDULE MODAL -->
        <dialog id="addScheduleModal">
            <form method="POST" action="{{ route('courses.schedules.store', $course->id) }}">
                @csrf

                <h3>Add Schedule</h3>

                <!-- Day Dropdown -->
                <label>Day</label>
                <select name="day" required>
                    <option value="" disabled selected>Select a day</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                    <option>Saturday</option>
                    <option>Sunday</option>
                </select>

                <!-- Time Picker -->
                <label>Start Time</label>
                <input type="time" name="start_time" required>

                <label>End Time</label>
                <input type="time" name="end_time" required>

                <!-- Building Dropdown -->
                <label>Building</label>
                <select name="building">
                    <option value="">None</option>
                    <option>Acad. Building 1</option>
                    <option>Acad. Building 2</option>
                    <option>Acad. Building 3</option>
                    <option>Acad. Building 4</option>
                    <option>Other</option>
                </select>

                <!-- Room Dropdown -->
                <label>Room</label>
                <select name="room">
                    <option value="">None</option>
                    <option>Room 1</option>
                    <option>Room 2</option>
                    <option>Room 3</option>
                    <option>Room 4</option>
                    <option>Room 5</option>
                    <option>IT Lab 1</option>
                    <option>IT Lab 2</option>
                    <option>CS LAB</option>
                    <option>OPEN LAB</option>
                    <option>MAC LAB</option>
                    <option>ERP LAB</option>
                </select>

                <button type="submit">Save</button>
                <button type="button" onclick="this.closest('dialog').close()">Cancel</button>
            </form>
        </dialog>
    </div>

    <hr class="divider">

    <!-- ACTIVITIES SECTION -->
    <div class="section">
        <h3><i class="ri-clipboard-line"></i> Activities</h3>

        <!-- Add Activity Button -->
        <button class="btn-add" onclick="document.getElementById('addActivityModal').showModal()">
            <i class="ri-add-line"></i> Add Activity
        </button>

        <!-- Add Activity Modal -->
        <dialog id="addActivityModal">
            <form method="POST" action="{{ route('courses.activities.store', $course->id) }}">
                @csrf

                <h3>Add Activity</h3>

                <label>Category</label>
                <select name="category" required>
                    <option value="Activity">Activity</option>
                    <option value="Quiz">Quiz</option>
                    <option value="Announcement">Announcement</option>
                    <option value="Project">Project</option>
                </select>

                <label>Title</label>
                <input type="text" name="title" required>

                <label>Due Date</label>
                <input type="datetime-local" name="due_date">

                <button type="submit">Save</button>
                <button type="button" onclick="this.closest('dialog').close()">Cancel</button>
            </form>
        </dialog>

        <!-- Display Activities -->
        @if($course->activities->count())
            <ul class="activity-list">
                @foreach($course->activities as $activity)
                    <li>
                        <strong>{{ $activity->category }}:</strong> {{ $activity->title }}

                        @if($activity->due_date)
                            <small>Due {{ \Carbon\Carbon::parse($activity->due_date)->format('M d, h:i A') }}</small>
                        @endif

                        <!-- Edit Button -->
                        <button class="btn-action edit" onclick="document.getElementById('editActivity{{ $activity->id }}').showModal()">
                            <i class="ri-edit-2-line"></i> Edit
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('activities.delete', $activity->id) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-action delete"><i class="ri-delete-bin-line"></i> Delete</button>
                        </form>

                        <!-- Edit Modal -->
                        <dialog id="editActivity{{ $activity->id }}">
                            <form method="POST" action="{{ route('activities.update', $activity->id) }}">
                                @csrf
                                @method('PUT')

                                <h3>Edit Activity</h3>

                                <label>Category</label>
                                <select name="category" required>
                                    <option value="Activity" {{ $activity->category == 'Activity' ? 'selected' : '' }}>Activity</option>
                                    <option value="Quiz" {{ $activity->category == 'Quiz' ? 'selected' : '' }}>Quiz</option>
                                    <option value="Announcement" {{ $activity->category == 'Announcement' ? 'selected' : '' }}>Announcement</option>
                                    <option value="Project" {{ $activity->category == 'Project' ? 'selected' : '' }}>Project</option>
                                </select>

                                <label>Title</label>
                                <input type="text" name="title" value="{{ $activity->title }}" required>

                                <label>Due Date</label>
                                <input type="datetime-local" name="due_date"
                                       value="{{ $activity->due_date ? \Carbon\Carbon::parse($activity->due_date)->format('Y-m-d\TH:i') : '' }}">

                                <button type="submit">Update</button>
                                <button type="button" onclick="this.closest('dialog').close()">Cancel</button>
                            </form>
                        </dialog>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No activities yet.</p>
        @endif

    </div>

</div>
@endsection
