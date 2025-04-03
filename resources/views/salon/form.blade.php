<div class="space-y-6">
    
    <div>
        <x-input-label for="nombre" :value="__('Nombre')"/>
        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $salon?->nombre)" autocomplete="nombre" placeholder="Nombre"/>
        <x-input-error class="mt-2" :messages="$errors->get('nombre')"/>
    </div>
    <div>
        <x-input-label for="direccion" :value="__('Direccion')"/>
        <x-text-input id="direccion" name="direccion" type="text" class="mt-1 block w-full" :value="old('direccion', $salon?->direccion)" autocomplete="direccion" placeholder="Direccion"/>
        <x-input-error class="mt-2" :messages="$errors->get('direccion')"/>
    </div>
    <div>
        <x-input-label for="precio" :value="__('Precio')"/>
        <x-text-input id="precio" name="precio" type="text" class="mt-1 block w-full" :value="old('precio', $salon?->precio)" autocomplete="precio" placeholder="Precio"/>
        <x-input-error class="mt-2" :messages="$errors->get('precio')"/>
    </div>
    <div>
        <x-input-label for="capacidad" :value="__('Capacidad')"/>
        <x-text-input id="capacidad" name="capacidad" type="text" class="mt-1 block w-full" :value="old('capacidad', $salon?->capacidad)" autocomplete="capacidad" placeholder="Capacidad"/>
        <x-input-error class="mt-2" :messages="$errors->get('capacidad')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>