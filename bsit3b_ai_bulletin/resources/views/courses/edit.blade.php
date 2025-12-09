@extends('layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/input.css') }}" />
@endsection

@section('content')
<h1><i class="ri-edit-2-fill"></i> Edit Course</h1>

<form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="form-box">
    @csrf
    @method('PUT')

    <label>Course Code</label>
    <input type="text" name="code" class="input" value="{{ $course->code }}" required>

    <label>Course Title</label>
    <input type="text" name="title" class="input" value="{{ $course->title }}" required>

    <label>Instructor</label>
    <input type="text" name="instructor" class="input" value="{{ $course->instructor }}" required>

    <label>Course Image</label>
    <input type="file" name="image" class="input">

    @if($course->image)
        <p>Current Image:</p>
        <img src="{{ asset('storage/'.$course->image) }}" width="200" style="border-radius: 10px;">
    @endif

    <button type="submit" class="btn-save">Save Changes</button>
</form>

@endsection
