@extends('layout')

@section('title', 'BSIT 3B Course Details')

@section('css')
<link rel="stylesheet" href="{{ asset('show.css') }}" />
@endsection

@section('courses_active')
class="active"
@endsection

@section('content')
  <div class="content-wrapper">
    <a href="{{ route('courses.index') }}" class="back-btn">
      <i class="ri-arrow-left-line"></i> Back to Courses
    </a>

    <div class="course-banner">
      <img src="{{ asset($course['image']) }}" alt="{{ $course['code'] }}">
    </div>

    <div class="course-info">
      <h2>{{ $course['title'] }}</h2>
      <p><i class="ri-user-fill"></i> {{ $course['instructor'] }}</p>
    </div>

    <div class="course-details">
      <h3><i class="ri-calendar-2-fill"></i> Schedule</h3>
      <ul>
        @foreach ($course['schedule'] as $sched)
          <i class="ri-time-line"></i> 
          {{ $sched['day'] }} — {{ $sched['time'] }} 
          <i class="ri-map-pin-fill"></i> {{ $sched['room'] }}
          <br>
        @endforeach
      </ul>
    </div>

    <hr class="divider">

    <div class="section">
      <h3><i class="ri-clipboard-line" style="color:#F6AD55;"></i> Activities</h3>
      <ul class="activity-list">
        @forelse ($course['activities'] as $activity)
          <li>
            <i class="ri-file-list-line icon"></i>
            {{ $activity['title'] }}
            <small>Due {{ $activity['due'] }}</small>
          </li>
          @empty
          <li>No activities listed.</li>
        @endforelse
      </ul>
    </div>

    <div class="section">
      <h3><i class="ri-folder-2-line" style="color:#F6AD55;"></i> Projects</h3>
      <ul class="project-list">
        @forelse ($course['projects'] as $project)
          <li>
            <i class="ri-folder-fill icon"></i>
            {{ $project['title'] }}
            <small>Due {{ $project['due'] }}</small>
          </li>
          @empty
          <li>No projects listed.</li>
        @endforelse
      </ul>
    </div>
  </div>
@endsection