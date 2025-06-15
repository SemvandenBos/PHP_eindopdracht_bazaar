<div class="bg-white shadow-md rounded-lg p-6">
    @isset($title)
        <x-title>{{ $title }}</x-title>
    @endisset

    @isset($description)
        <p class="mt-2">{{ $description }}</p>
    @endisset

    <div class="mt-4">
        {{ $slot }} {{-- This allows passing anything like links, buttons, arbitrary HTML --}}
    </div>
</div>
