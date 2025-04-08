@extends('layouts.layout') {{-- O el layout que uses --}}

@section('header')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        @foreach ($publicacions as $publicacion)
            <div class="col-md-6 mb-4">
                <div class="card shadow rounded-4 overflow-hidden">
                    <img src="{{ asset('images/salon_general.jpeg') }}" alt="Imagen" class="card-img-top" style="object-fit: cover; height: 250px;">

                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $publicacion->titulo }}</h5>
                        <p class="text-success fw-semibold fs-5">${{ number_format(rand(1000000, 9999999), 2) }}</p>

                        <p class="card-text">{{ Str::limit($publicacion->descripcion, 150) }}</p>

                        <p class="text-muted mb-1"><i class="bi bi-geo-alt-fill"></i> {{ $publicacion->nombre }}</p>

                            <a href="{{route('reservas.create')}}" >
                            <button class="btn btn-success rounded-pill">Reservar</button>
                            </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection




