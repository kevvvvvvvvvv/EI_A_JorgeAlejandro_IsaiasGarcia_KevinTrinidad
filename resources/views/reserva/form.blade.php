
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<style>
    #calendar-container {
        width: 100%;
        max-width: 400px;
        z-index: 50;
    }
    .fc {
        font-family: inherit;
        border: none;
    }
    .fc-toolbar-title {
        font-size: 1.1rem;
    }
</style>


<div class="space-y-6">
    <div>
        <x-input-label for="fecha_r" :value="__('Fechar')"/>
        <x-text-input id="fecha_r" 
                        name="fechaR" 
                        type="text" 
                        class="mt-1 block w-full cursor-pointer" 
                        :value="old('fechaR', $reserva?->fechaR)" 
                        autocomplete="off"
                        readonly
                        placeholder="Selecciona una fecha"/>
        <!-- Contenedor del calendario (oculto inicialmente) -->
        <div id="calendar-container" class="hidden mt-2 p-4 border rounded-lg shadow-lg bg-white">
            <div id="calendar-placeholder"></div>
        </div>
        
        <x-input-error class="mt-2" :messages="$errors->get('fechaR')"/>
    </div>
    <div>
        <x-input-label for="estado" :value="__('Estado')"/>
        <select id="estado" name="estado" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">Seleccione un estado</option>
            <option value="pendiente" {{ old('estado', $reserva?->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="confirmado" {{ old('estado', $reserva?->estado) == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
            <option value="cancelado" {{ old('estado', $reserva?->estado) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('estado')"/>
    </div>
    <div>
        <x-input-label for="correo" :value="__('Correo usuario')"/>
        <x-text-input id="correo" name="correo" type="text" class="mt-1 block w-full" :value="old('correo', $reserva?->correo)" autocomplete="correo" placeholder="Correo usuario"/>
        <x-input-error class="mt-2" :messages="$errors->get('correo')"/>
    </div>
    <div>
        <x-input-label for="nombre" :value="__('Nombre salon')"/>
        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $reserva?->nombre)" autocomplete="nombre" placeholder="Nombre salon"/>
        <x-input-error class="mt-2" :messages="$errors->get('nombre')"/>
    </div>
    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>

<!-- En la sección de scripts -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fechaInput = document.getElementById('fecha_r');
    const calendarContainer = document.getElementById('calendar-container');
    const eventos = @json($eventos);
    let calendar = null;

    function initializeCalendar() {
        calendar = new FullCalendar.Calendar(document.getElementById('calendar-placeholder'), {
            initialView: 'dayGridMonth',
            locale: 'es',
            events: eventos.map(evento => ({
                title: evento.title,
                start: evento.start,
                color: evento.color,
                display: 'background'
            })),
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
            },
            dateClick: function(info) {
                const fechaSeleccionada = info.dateStr; // Formato YYYY-MM-DD local
                console.log('Fecha seleccionada (raw):', fechaSeleccionada);
                
                const existeEvento = eventos.some(e => e.start === fechaSeleccionada);
                
                if (!existeEvento) {
                    fechaInput.value = formatDate(fechaSeleccionada);
                    calendarContainer.classList.add('hidden');
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Fecha ocupada',
                        text: 'Esta fecha ya tiene una reserva ' + eventos.find(e => e.start === fechaSeleccionada).title.toLowerCase()
                    });
                }
            },
            dayCellDidMount: function(info) {
                const fechaStr = info.dateStr; // Fecha local
                const evento = eventos.find(e => e.start === fechaStr);
                
                if (evento) {
                    info.el.style.backgroundColor = `${evento.color}20`;
                    info.el.style.border = `2px solid ${evento.color}`;
                    info.el.title = evento.title;
                }
            }
        });
        calendar.render();
    }

    function formatDate(dateString) {
        const [year, month, day] = dateString.split('-');
        return `${day.padStart(2, '0')}/${month.padStart(2, '0')}/${year}`;
    }

    fechaInput.addEventListener('click', () => {
        calendarContainer.classList.toggle('hidden');
        if (!calendar) initializeCalendar();
    });

    document.addEventListener('click', (event) => {
        if (!calendarContainer.contains(event.target) && event.target !== fechaInput) {
            calendarContainer.classList.add('hidden');
        }
    });
});
</script>
@endpush

