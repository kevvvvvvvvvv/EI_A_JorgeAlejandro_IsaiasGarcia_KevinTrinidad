@extends('layouts.layout')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/index.css'); }}">
@endsection

@section('content')
<div class="banner-outer-container">
    <div class="banner-inner-container">
        <div class="image-container">
            <img class="banner-image" src="{{ URL::asset('images/banner.jpg'); }}" alt="Salón Imperial Hall">
            <div class="overlay"></div>
        </div>
        <div class="text-container">
            <div class="text-wrapper">
                <h2 class="banner-heading">¡Encuentra el salón de tus <span class="highlight-text">sueños</span>!</h2>
            </div>
        </div>
    </div>
</div>

<div class="salones-container">
    <h1 class="main-title">¡Salones <span class="highlight-text">disponibles</span>!</h1>
    
    <div class="salon-grid">
        <div class="salon-card">
            <img src="{{URL::asset('images/salon_1.jpeg')}}" alt="">
            <h2 class="salon-title">Salón 1</h2>
            <p class="salon-location"><i class="bi bi-geo-alt-fill"></i> Location 1</p>
        </div>
        
        <div class="salon-card">
            <img src="{{URL::asset('images/salon_2.jpeg')}}" alt="">
            <h2 class="salon-title">Salón 2</h2>
            <p class="salon-location"><i class="bi bi-geo-alt-fill"></i> Location 2</p>
        </div>
        
        <div class="salon-card">
            <img src="{{URL::asset('images/salon_3.jpg')}}" alt="">
            <h2 class="salon-title">Salón 3</h2>
            <p class="salon-location"><i class="bi bi-geo-alt-fill"></i> Location 3</p>
        </div>
    </div>
    
    <button class="cta-button">Conocer más</button>
</div>


<div class="cualidades-container">
    <h1 class="cualidades-titulo">Nuestras mejores cualidades</h1>
    
    <div class="cualidades-grid">
        <div class="cualidad-card">
            <h2 class="cualidad-texto">Elegancia y exclusividad</h2>
        </div>
        
        <div class="cualidad-card mid-card">
            <h2 class="cualidad-texto mid-card">Servicio integral y profesionalismo</h2>
        </div>
        
        <div class="cualidad-card">
            <h2 class="cualidad-texto">Versatilidad y adaptabilidad</h2>
        </div>
    </div>
</div>
@endsection


@section('footer')
<footer class="footer-container">
    <div class="footer-column">
        <h3 class="footer-title">¡Contáctanos!</h3>
        <div class="contact-info">
            <p class="contact-item">
                <i class="bi bi-whatsapp"></i> 1234567890
            </p>
            <p class="contact-item">
                <i class="bi bi-facebook"></i> salon_eventos
            </p>
            <p class="contact-item">
                <i class="bi bi-instagram"></i> salon_eventos
            </p>
        </div>
    </div>
    
    <div class="footer-column">
        <h3 class="footer-title">¡Conócenos!</h3>
        <p class="address">
            <i class="bi bi-geo-alt-fill"></i> 10 Avenida Mexico, Morelos, Mexico
        </p>
    </div>
</footer>
@endsection