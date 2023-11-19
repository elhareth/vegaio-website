<x-filament-panels::page>
    @foreach ($this->getForms() as $form)
        <form>
            {{ $this->{$form} }}
        </form>
    @endforeach
</x-filament-panels::page>
