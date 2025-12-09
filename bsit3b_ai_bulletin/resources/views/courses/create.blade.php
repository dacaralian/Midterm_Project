@extends('layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/input.css') }}" />
@endsection

@section('content')
<h1><i class="ri-add-circle-fill"></i> Add New Course</h1>

<form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="form-box">
    @csrf

    <label>Course Code</label>
    <input type="text" name="code" class="input" required>

    <label>Course Title</label>
    <input type="text" name="title" class="input" required>

    <label>Instructor</label>
    <input type="text" name="instructor" class="input" required>

    <label>Course Image</label>
    <input type="file" name="image" class="input">

    <button type="submit" class="btn-save">Save Course</button>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>

@endsection
