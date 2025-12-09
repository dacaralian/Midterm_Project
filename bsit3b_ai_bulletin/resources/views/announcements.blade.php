@extends('layout')

@section('title', 'BSIT 3B Announcements')

@section('css')
<link rel="stylesheet" href="{{ asset('css/announcements.css') }}" />
@endsection

@section('announcement_active')
class="active"
@endsection

@section('content')
<header class="page-header">
    <h1><span class="icon"><i class="ri-megaphone-fill"></i></span> Announcements</h1>
    <p>News and Updates</p>
</header>

<section class="announcement-grid">
  <div class="announcement-card">
    <div class="info">
      <div class="fb-post-container">
        <iframe
          src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fcspcofficial%2Fposts%2Fpfbid02Uwfdd53EmKUzQgTu1mG27ngZ17oGeYBYSUrsMG4xsrGHXtATsbEPkn8GrsLFAvDsl&show_text=true&width=500"
          scrolling="no" frameborder="0" allowfullscreen="true"
          allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
        </iframe>
      </div>
    </div>
  </div>

  <div class="announcement-card">
    <div class="info">
      <div class="fb-post-container">
        <iframe
          src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fcspcofficial%2Fposts%2Fpfbid02ErZFUi7UhmZEBRRVA6JaqJcAtwpz8qcVCnSZdn849teDoDJ7gdMFqcVtGXzfNnCpl&show_text=true&width=500"
          scrolling="no" frameborder="0" allowfullscreen="true"
          allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
        </iframe>
      </div>
    </div>
  </div>

  <div class="announcement-card">
    <div class="info">
      <div class="fb-post-container">
        <iframe
          src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fcspcofficial%2Fposts%2Fpfbid025iT7LxdSQ9S9H6xfd8LdMMgfqpWKViVG4Z5dTaceFGJrFGXiz9mCs1dBdTeS5KRtl&show_text=true&width=500"
          scrolling="no" frameborder="0" allowfullscreen="true"
          allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
        </iframe>
      </div>
    </div>
  </div>
</section>
@endsection