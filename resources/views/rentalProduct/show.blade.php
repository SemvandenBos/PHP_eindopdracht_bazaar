<x-app-layout>
    <div class="bg-white shadow-md rounded-lg p-6 max-w-sm mx-auto">
        <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
        <p class="text-gray-600 mt-2">{{ $product->price_per_day }}</p>
        <div class="mt-4">
            <x-button-link href="/rentalProduct/{{ $product->id }}">
                {{-- {{__('rentalProduct.buttonText')}} --}}
                more info
            </x-button-link>
        </div>
    </div>
</x-app-layout>