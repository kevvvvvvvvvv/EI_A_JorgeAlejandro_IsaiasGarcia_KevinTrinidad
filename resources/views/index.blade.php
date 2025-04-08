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
            <p class="salon-location"><i class="bi bi-geo-alt-fill"></i> Location 1 <a href="{{route('publicacion.general')}}"><i class="bi bi-arrow-right-circle-fill"></i></a></p>
        </div>
        
        <div class="salon-card">
            <img src="{{URL::asset('images/salon_2.jpeg')}}" alt="">
            <h2 class="salon-title">Salón 2</h2>
            <p class="salon-location"><i class="bi bi-geo-alt-fill"></i> Location 2 <a href="{{route('publicacion.general')}}"><i class="bi bi-arrow-right-circle-fill"></i></a></p>
        </div>
        
        <div class="salon-card">
            <img src="{{URL::asset('images/salon_3.jpg')}}" alt="">
            <h2 class="salon-title">Salón 3</h2>
            <p class="salon-location"><i class="bi bi-geo-alt-fill"></i> Location 3 <a href="{{route('publicacion.general')}}"><i class="bi bi-arrow-right-circle-fill"></i></a></p>
            
        </div>
    </div>
    
    <a href="{{ route('salon.general') }}"><button class="cta-button">Conocer más</button></a>
</div>


<div class="cualidades-container">
    <h1 class="cualidades-titulo">Nuestras mejores cualidades</h1>
    
    <div class="cualidades-grid">
        <div class="cualidad-card">
            <i class="bi bi-award"></i>
            <h2 class="cualidad-texto">Elegancia y exclusividad</h2>
        </div>
        
        <div class="mid-card">
            <i class="bi bi-patch-check-fill"></i>
            <h2 class="cualidad-texto mid-card">Servicio integral y profesionalismo</h2>
        </div>
        
        <div class="cualidad-card">
            <i class="bi bi-boxes"></i>
            <h2 class="cualidad-texto">Versatilidad y adaptabilidad</h2>
        </div>
    </div>
</div>
@endsection
