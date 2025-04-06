@extends('layouts.layout')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/index.css'); }}">
@endsection

@section('content')
<style>
    #output {
      height: 400px;
      width: 100%;
    }
  </style>
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
            <p class="salon-location"><i class="bi bi-geo-alt-fill"></i> Location 1 <a href=""><i class="bi bi-arrow-right-circle-fill"></i></a></p>
        </div>
        
        <div class="salon-card">
            <img src="{{URL::asset('images/salon_2.jpeg')}}" alt="">
            <h2 class="salon-title">Salón 2</h2>
            <p class="salon-location"><i class="bi bi-geo-alt-fill"></i> Location 2 <a href=""><i class="bi bi-arrow-right-circle-fill"></i></a></p>
        </div>
        
        <div class="salon-card">
            <img src="{{URL::asset('images/salon_3.jpg')}}" alt="">
            <h2 class="salon-title">Salón 3</h2>
            <p class="salon-location"><i class="bi bi-geo-alt-fill"></i> Location 3 <a href=""><i class="bi bi-arrow-right-circle-fill"></i></a></p>
            
        </div>
    </div>
    
    <button class="cta-button">Conocer más</button>
</div>


<div class="cualidades-container">
    <h1 class="cualidades-titulo">Nuestras mejores cualidades</h1>
    
    <div class="cualidades-grid">
        <div class="cualidad-card">
            <i class="bi bi-award"></i>
            <h2 class="cualidad-texto">Elegancia y exclusividad</h2>
        </div>
        
        <div class="cualidad-card mid-card">
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
        <div id="output"></div>
    </div>
</footer>

<script>
    function initMap() {
      // Verificar si el navegador soporta geolocalización
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          function (position) {
            const userLocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };

            const service = new google.maps.DistanceMatrixService();

            const destinos = [
              "Cedro 18, San Francisco Texcalpan, 62573 Jiutepec, Mor.",
              "C. Ciprés Manzana 20 Lote 2-A, San Francisco Texcalpan, 62573 Jiutepec, Mor."
            ];

            service.getDistanceMatrix(
              {
                origins: [userLocation],
                destinations: destinos,
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
              },
              (response, status) => {
                if (status !== "OK") {
                  console.error("Error con DistanceMatrixService:", status);
                  return;
                }

                const results = response.rows[0].elements;
                let minIndex = 0;
                let minDistance = results[0].distance.value;

                for (let i = 1; i < results.length; i++) {
                  if (results[i].distance.value < minDistance) {
                    minDistance = results[i].distance.value;
                    minIndex = i;
                  }
                }

                document.getElementById("output").innerText =
                  "La ubicación más cercana a ti es:\n" + destinos[minIndex] +
                  "\nDistancia: " + results[minIndex].distance.text +
                  "\nTiempo estimado: " + results[minIndex].duration.text;
              }
            );
          },
          function () {
            document.getElementById("output").innerText = "No se pudo obtener tu ubicación.";
          }
        );
      } else {
        document.getElementById("output").innerText = "Tu navegador no soporta geolocalización.";
      }
    }
</script>


    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
    </script>
@endsection