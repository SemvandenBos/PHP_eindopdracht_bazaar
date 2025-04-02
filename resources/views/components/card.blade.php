<div class="bg-white shadow-md rounded-lg p-6">
    @isset($title)
        <h2 class="text-xl font-semibold">{{ $title }}</h2>
    @endisset

    @isset($description)
        <p class="mt-2">{{ $description }}</p>
    @endisset

    <div class="mt-4">
        {{ $slot }} {{-- This allows passing anything like links, buttons, arbitrary HTML --}}
    </div>
</div>