@extends('layout')

@section('title', 'BSIT 3B Announcements')

@section('css')
<link rel="stylesheet" href="{{ asset('contactus.css') }}" />
@endsection

@section('contactus_active')
class="active"
@endsection

@section('content')
<header class="page-header">
    <h1><span class="icon"><i class="ri-contacts-fill"></i></span> Contact Us</h1>
    <p>Class Officers</p>
</header>

<section class="officer-grid">
    <div class="officer-card">
        <img src="{{ asset('jp.jpg') }}" alt="John Paul Caigas" />
        <h3>John Paul Caigas</h3>
        <p class="position">Mayor</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('nald.jpg') }}" alt="Ronald Francis Andalís" />
        <h3>Ronald Francis Andalís</h3>
        <p class="position">Vice Mayor</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('tin1.jpeg') }}" alt="Cristine Tabuete" />
        <h3>Cristine Tabuete</h3>
        <p class="position">Secretary</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('law.jpg') }}" alt="Mark Lawrence Bernas" />
        <h3>Mark Lawrence Bernas</h3>
        <p class="position">Treasurer</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('profile.jpg') }}" alt="Mark Gian Cortero" />
        <h3>Mark Gian Cortero</h3>
        <p class="position">Auditor</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('profile.jpg') }}" alt="Mark Denver Regaspi" />
        <h3>Mark Denver Regaspi</h3>
        <p class="position">Public Information Officer</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('profile.jpg') }}" alt="Maria Ivy Pentecostes" />
        <h3>Maria Ivy Pentecostes</h3>
        <p class="position">Ethical Standards Officer</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('meek.jpg') }}" alt="Daniel Meek Caralian" />
        <h3>Daniel Meek Caralian</h3>
        <p class="position">Business Manager</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('erika.jpg') }}" alt="Erika Joyce Valenzuela" />
        <h3>Erika Joyce Valenzuela</h3>
        <p class="position">Business Manager</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('bat.jpg') }}" alt="Adrian Bataller" />
        <h3>Adrian Bataller</h3>
        <p class="position">Sports Coordinator</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('joven.jpg') }}" alt="Joven Tale" />
        <h3>Joven Tale</h3>
        <p class="position">Cultural Coordinator</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('profile.jpg') }}" alt="Kristine Mae Salcedo" />
        <h3>Kristine Mae Salcedo</h3>
        <p class="position">CHRE</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('dave.jpg') }}" alt="Dave Leonardo Boroc" />
        <h3>Dave Leonardo Boroc</h3>
        <p class="position">Escort</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>

    <div class="officer-card">
        <img src="{{ asset('profile.jpg') }}" alt="May Ann Belmonte" />
        <h3>May Ann Belmonte</h3>
        <p class="position">Muse</p>
        <div class="icons">
            <a href="#"><i class="ri-phone-fill"></i></a>
            <a href="#"><i class="ri-message-fill"></i></a>
        </div>
    </div>
</section>
@endsection