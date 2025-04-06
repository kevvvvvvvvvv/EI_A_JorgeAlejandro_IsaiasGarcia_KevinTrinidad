@extends('layouts.layout')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('css/index.css'); }}">
@endsection

@section('content')
<style>
    #map {
      height: 500px;
      width: 100%;
    }
    #output {
      margin-top: 10px;
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
        <div id="map"></div>
    </div>
</footer>

<script>
  let map;
  let userMarker;
  let closestMarker;

  const destinos = [
    "Cedro 18, San Francisco Texcalpan, 62573 Jiutepec, Mor.",
    "C. Ciprés Manzana 20 Lote 2-A, San Francisco Texcalpan, 62573 Jiutepec, Mor."
  ];

  function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
      zoom: 14,
      center: { lat: 18.8829, lng: -99.1821 },
    });

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition((position) => {
        const userLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };

        // Marcador del usuario
        userMarker = new google.maps.Marker({
          position: userLocation,
          map: map,
          title: "Tu ubicación",
          icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
        });

        // Calcular distancias
        const service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
          {
            origins: [userLocation],
            destinations: destinos,
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
          },
          (response, status) => {
            if (status !== "OK") {
              document.getElementById("output").innerText = "Error: " + status;
              return;
            }

            const elements = response.rows[0].elements;
            let minIndex = -1;
            let minDistance = Infinity;

            for (let i = 0; i < elements.length; i++) {
              if (elements[i].status === "OK") {
                const dist = elements[i].distance.value;
                if (dist < minDistance) {
                  minDistance = dist;
                  minIndex = i;
                }
              }
            }

            if (minIndex === -1) {
              document.getElementById("output").innerText = "No se pudo calcular ninguna distancia válida.";
              return;
            }

            // Geocodificar la ubicación más cercana
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ address: destinos[minIndex] }, (geoResults, geoStatus) => {
              if (geoStatus === "OK" && geoResults[0]) {
                const closestLocation = geoResults[0].geometry.location;

                closestMarker = new google.maps.Marker({
                  position: closestLocation,
                  map: map,
                  title: "Ubicación más cercana",
                  icon: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
                });

                const bounds = new google.maps.LatLngBounds();
                bounds.extend(userLocation);
                bounds.extend(closestLocation);
                map.fitBounds(bounds);

                // Mostrar resultados
                document.getElementById("output").innerText =
                  "📍 Ubicación más cercana:\n" + destinos[minIndex] +
                  "\n📏 Distancia: " + elements[minIndex].distance.text +
                  "\n⏱ Tiempo estimado: " + elements[minIndex].duration.text;
              } else {
                document.getElementById("output").innerText = "Error al geocodificar la dirección: " + geoStatus;
              }
            });
          }
        );
      }, () => {
        document.getElementById("output").innerText = "No se pudo obtener tu ubicación.";
      });
    } else {
      document.getElementById("output").innerText = "Geolocalización no soportada por el navegador.";
    }
  }
</script>


    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
    </script>
@endsection