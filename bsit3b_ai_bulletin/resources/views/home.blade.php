@extends('layout')

@section('title', 'BSIT 3B Dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}" />
@endsection

@section('home_active')
class="active"
@endsection

@section('content')
<header class="header">
    <div class="date"><i class="ri-calendar-line"></i> {{ date('l, F j, Y') }}</div>
    <br><br><br><br>
    <h1>Welcome BSIT 3B</h1>
    <p>Your one-stop portal for all academic updates.</p>
</header>

<section class="status">
    <div class="card">--<br><span class="label">Projects</span></div>
    <div class="card">--<br><span class="label">Activities</span></div>
    <div class="card">--<br><span class="label">Quizzes</span></div>
    <div class="card">--<br><span class="label">Announcements</span></div>
</section>

<section class="schedule">
    <h2><i class="ri-time-line"></i> Schedule</h2>
    <br>
    <img src="{{ asset('schedule.png') }}" alt="Schedule" class="schedule-img">
</section>
@endsection