<div class="space-y-6">
    
    <div>
        <x-input-label for="fecha_r" :value="__('Fechar')"/>
        <x-text-input id="fecha_r" name="fechaR" type="text" class="mt-1 block w-full" :value="old('fechaR', $reserva?->fechaR)" autocomplete="fechaR" placeholder="Fechar"/>
        <x-input-error class="mt-2" :messages="$errors->get('fechaR')"/>
    </div>
    <div>
        <x-input-label for="estado" :value="__('Estado')"/>
        <x-text-input id="estado" name="estado" type="text" class="mt-1 block w-full" :value="old('estado', $reserva?->estado)" autocomplete="estado" placeholder="Estado"/>
        <x-input-error class="mt-2" :messages="$errors->get('estado')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>