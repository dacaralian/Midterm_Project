@extends('layout')

@section('title', 'BSIT 3B Courses')

@section('css')
<link rel="stylesheet" href="{{ asset('courses.css') }}" />
@endsection

@section('courses_active')
class="active"
@endsection

@section('content')
  <header class="page-header">
    <h1><span class="icon"><i class="ri-book-fill"></i></span> Courses</h1>
      <p>3rd Year, 2nd Semester (A.Y. 2025–2026)</p>
  </header>

  <section class="courses-grid">
    @foreach ($courses as $course)
    <a href="{{ route('courses.show', $course['id']) }}">
      <div class="course-card">
        <img src="{{ asset($course['image']) }}" alt="{{ $course['code'] }}">
        <div class="info">
          <h3><i class="ri-book-fill"></i> {{ $course['code'] }}</h3>
          <p><i class="ri-user-fill"></i> {{ $course['instructor'] }}</p>
        </div>
      </div>
    </a>
    @endforeach
  </section>
@endsection