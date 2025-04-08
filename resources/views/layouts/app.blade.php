<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<style>
    .footer-container {
    background-color: #000000;
    color: white;
    padding: 40px 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    font-family: 'Arial', sans-serif;
}

.footer-column {
    flex: 1;
    min-width: 250px;
    margin: 15px;
    padding: 0 20px;
}

.footer-title {
    color: #ffffff;
    font-size: 1.5rem;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.footer-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 3px;
    background-color: #ffffff;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.contact-item, .address {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1rem;
    line-height: 1.5;
}

.contact-item i, .address i {
    font-size: 1.2rem;
    width: 25px;
    text-align: center;
    color: #ffffff;
}

.mid-card {
    background-color: #2e8b29;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .footer-column {
        margin-bottom: 30px;
        padding: 0;
    }
    
    .footer-title::after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .contact-item, .address {
        justify-content: center;
    }
}
</style>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    @stack('scripts')
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
    
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
    </script>
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
    

</html>
