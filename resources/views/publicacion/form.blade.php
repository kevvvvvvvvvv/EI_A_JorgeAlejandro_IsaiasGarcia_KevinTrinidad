<div class="space-y-6">
    
    <div>
        <x-input-label for="titulo" :value="__('Titulo')"/>
        <x-text-input id="titulo" name="titulo" type="text" class="mt-1 block w-full" :value="old('titulo', $publicacion?->titulo)" autocomplete="titulo" placeholder="Titulo"/>
        <x-input-error class="mt-2" :messages="$errors->get('titulo')"/>
    </div>
    <div>
        <x-input-label for="descripcion" :value="__('Descripcion')"/>
        <x-text-input id="descripcion" name="descripcion" type="text" class="mt-1 block w-full" :value="old('descripcion', $publicacion?->descripcion)" autocomplete="descripcion" placeholder="Descripcion"/>
        <x-input-error class="mt-2" :messages="$errors->get('descripcion')"/>
    </div>
    <div>
        <x-input-label for="fecha_p" :value="__('Fechap')"/>
        <x-text-input id="fecha_p" name="fechaP" type="text" class="mt-1 block w-full" :value="old('fechaP', $publicacion?->fechaP)" autocomplete="fechaP" placeholder="Fechap"/>
        <x-input-error class="mt-2" :messages="$errors->get('fechaP')"/>
    </div>
    <div>
        <x-input-label for="contacto" :value="__('Contacto')"/>
        <x-text-input id="contacto" name="contacto" type="text" class="mt-1 block w-full" :value="old('contacto', $publicacion?->contacto)" autocomplete="contacto" placeholder="Contacto"/>
        <x-input-error class="mt-2" :messages="$errors->get('contacto')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>