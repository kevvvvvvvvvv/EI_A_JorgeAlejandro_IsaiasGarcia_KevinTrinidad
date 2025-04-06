@extends('layouts.layout')


@section('content')
<div class="salones-grid">
    @foreach($salones as $salon)
    <div class="salon-card">
        <div class="salon-header">
            <h3 class="salon-title">{{ $salon->nombre }}</h3>
            <span class="salon-price">${{ number_format($salon->precio, 2) }}</span>
        </div>
        
        <!-- Mapa mini -->
        <div class="salon-map" id="map-{{ $salon->id }}"></div>
        
        <div class="salon-body">
            <div class="salon-feature">
                <i class="bi bi-geo-alt"></i>
                <span>{{ $salon->direccion }}</span>
            </div>
            
            <div class="salon-feature">
                <i class="bi bi-people"></i>
                <span>Capacidad: {{ $salon->capacidad ?? 'N/A' }} personas</span>
            </div>
        </div>
        
        <div class="divider"></div>
        
        <div class="salon-footer">           
        </div>
    </div>
    @endforeach
</div>

<style>

    .salon-map {
        height: 150px;
        width: 100%;
        background-color: #f5f5f5;
        border-bottom: 1px solid #e2e8f0;
    }

    .salones-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        padding: 20px;
    }
    
    .salon-card {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .salon-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .salon-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        background-color: #f8fafc;
    }
    
    .salon-title {
        margin: 0;
        font-size: 1.2rem;
        color: #1e293b;
    }
    
    .salon-price {
        font-weight: bold;
        color: #2e8b29;
    }
    
    .salon-body {
        padding: 15px;
        flex-grow: 1;
    }
    
    .salon-feature {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        color: #64748b;
    }
    
    .salon-feature i {
        color: #94a3b8;
    }
    
    .divider {
        height: 1px;
        background-color: #e2e8f0;
        margin: 0 15px;
    }
    
    .salon-footer {
        padding: 15px;
        text-align: right;
    }
    
    .view-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
    }
    
    .view-link:hover {
        text-decoration: underline;
    }
</style>

<script>
// Función principal para cargar la API de Google Maps
function loadGoogleMapsAPI() {
  // Verificar si la API ya está cargada
  if (window.google && window.google.maps) {
    initMaps();
    return;
  }

  // Crear el script de la API
  const script = document.createElement('script');
  script.src = `https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMaps`;
  script.async = true;
  script.defer = true;
  script.onerror = () => {
    console.error('Error al cargar Google Maps API');
    // Ocultar todos los contenedores de mapa si falla la carga
    document.querySelectorAll('.salon-map').forEach(map => {
      map.style.display = 'none';
    });
  };
  document.head.appendChild(script);
}

// Función para inicializar todos los mapas
function initMaps() {
  // Seleccionar todas las cards de salones
  const cards = document.querySelectorAll('.salon-card');
  
  cards.forEach(card => {
    const mapContainer = card.querySelector('.salon-map');
    const address = card.querySelector('.salon-feature span').textContent;
    
    if (mapContainer && address) {
      initSingleMap(mapContainer.id, address);
    }
  });
}

// Función para inicializar un mapa individual
function initSingleMap(mapId, address) {
  const mapElement = document.getElementById(mapId);
  
  if (!mapElement) return;

  const geocoder = new google.maps.Geocoder();
  
  geocoder.geocode({ address: address }, (results, status) => {
    if (status === 'OK' && results[0]) {
      const mapOptions = {
        center: results[0].geometry.location,
        zoom: 15,
        disableDefaultUI: true,
        gestureHandling: 'none',
        styles: [
          {
            featureType: "poi",
            elementType: "labels",
            stylers: [{ visibility: "off" }]
          },
          {
            featureType: "transit",
            elementType: "labels",
            stylers: [{ visibility: "off" }]
          }
        ]
      };
      
      const map = new google.maps.Map(mapElement, mapOptions);
      
      new google.maps.Marker({
        position: results[0].geometry.location,
        map: map,
        icon: {
          url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
          scaledSize: new google.maps.Size(32, 32)
        }
      });
    } else {
      console.warn(`Geocoding falló para: ${address}`, status);
      mapElement.style.display = 'none';
    }
  });
}

// Manejo del menú móvil (opcional)
function setupMobileMenu() {
  const menuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  
  if (menuButton && mobileMenu) {
    menuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }
}

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
  // Cargar Google Maps
  loadGoogleMapsAPI();
  
  // Configurar menú móvil (si existe)
  setupMobileMenu();
});

// Manejo de redimensionamiento de ventana
window.addEventListener('resize', () => {
  if (window.google && window.google.maps) {
    // Re-centrar los mapas al redimensionar
    setTimeout(initMaps, 300);
  }
});
    </script>

@endsection