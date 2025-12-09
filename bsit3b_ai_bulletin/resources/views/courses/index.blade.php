@extends('layout')

@section('title', 'BSIT 3B Courses')

@section('css')
<link rel="stylesheet" href="{{ asset('css/courses.css') }}" />
@endsection

@section('courses_active')
class="active"
@endsection

@section('content')
  <header class="page-header">
    <h1><span class="icon"><i class="ri-book-fill"></i></span> Courses</h1>
      <p>3rd Year, 2nd Semester (A.Y. 2025–2026)</p>
  </header>

  <br><br>

  <a href="{{ route('courses.create') }}" class="btn-add">
    <i class="ri-add-circle-fill"></i> Add Course
  </a>

  <br><br>

  <section class="courses-grid">
    @foreach($courses as $course)
      <div class="course-card">

        <a href="{{ route('courses.show', $course->id) }}" class="course-main">
          <div class="course-image">
            <img src="{{ $course->image ? asset('storage/'.$course->image) : asset('default-course.png') }}">
          </div>

          <div class="info">
            <h3>{{ $course->code }}</h3>
            <p><i class="ri-user-fill"></i> {{ $course->instructor }}</p>
          </div>
        </a>

        <div class="course-actions">
            <a href="{{ route('courses.edit', $course->id) }}" class="btn-edit">
              <i class="ri-edit-2-line"></i> Edit
            </a>

            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Delete this course?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-delete">
                <i class="ri-delete-bin-line"></i> Delete
              </button>
            </form>
        </div>

      </div>
    @endforeach
  </section>
@endsection