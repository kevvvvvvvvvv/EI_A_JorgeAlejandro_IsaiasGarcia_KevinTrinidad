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
    <h1 class="main-title">¡Salones disponibles!</h1>
    
    <div class="salon-grid">
        <div class="salon-card">
            <h2 class="salon-title">Título 1</h2>
            <p class="salon-location">- Location 1</p>
        </div>
        
        <div class="salon-card">
            <h2 class="salon-title">Título 2</h2>
            <p class="salon-location">- Location 2</p>
        </div>
        
        <div class="salon-card">
            <h2 class="salon-title">Título 3</h2>
            <p class="salon-location">- Location 3</p>
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
        
        <div class="cualidad-card">
            <h2 class="cualidad-texto">Servicio integral y profesionalismo</h2>
        </div>
        
        <div class="cualidad-card">
            <h2 class="cualidad-texto">Versatilidad y adaptabilidad</h2>
        </div>
    </div>
</div>
@endsection