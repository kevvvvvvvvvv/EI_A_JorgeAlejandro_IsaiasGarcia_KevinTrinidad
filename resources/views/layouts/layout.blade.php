<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imperial Hall</title>
    <link rel="stylesheet" href="{{ URL::asset('css/layaout.css'); }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @yield('header')
</head>
<body>
    <style>
        #map {
          height: 500px;
          width: 100%;
        }
        #output {
          margin-top: 10px;
        }
    </style>
    <nav class="navbar">
        <div class="logo-container">
            <a href="/">
                <img src="{{ URL::asset('images/logo.png'); }}" alt="Imperial Hall Logo">
            </a>
            <span class="logo-text">Imperial Hall</span>
        </div>

        <div class="nav-links" id="navLinks">

            @if (!Auth::check())

            <div class="auth-buttons">
                <a class="btn btn-primary" href="{{ route('login') }}">Iniciar sesión</a>
                <a class="btn btn-secondary" href="{{ route('register') }}">Registrarse</a>
            </div>

            @else

            <div class="dropdown">
                <button class="dropdown-btn">Salones</button>
                <div class="dropdown-content">
                    <a href="{{ route('salons.index') }}">Salones</a>
                    <a href="{{ route('reservas.index')}}">Reservas</a>
                    <a href="{{ route('publicacions.index')}}">Publicaciones</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-btn">{{ auth()->user()->name }}</button>
                <div class="dropdown-content">
                    <a href="{{route('profile.edit')}}">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
        
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>

            @endif
        </div>
    </nav>

    @yield('content')


    <script src="{{ URL::asset('js/layout.js'); }}"></script>
    @yield('footer')
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
</body>
</html>