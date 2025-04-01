<div class="bg-white shadow-md rounded-lg p-6">
    @isset($title)
        <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
    @endisset

    @isset($description)
        <p class="text-gray-600 mt-2">{{ $description }}</p>
    @endisset

    <div class="mt-4">
        {{ $slot }} {{-- This allows passing anything like links, buttons, arbitrary HTML --}}
    </div>
</div>