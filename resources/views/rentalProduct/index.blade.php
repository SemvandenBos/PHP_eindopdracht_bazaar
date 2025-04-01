<x-app-layout>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach ($rentalProducts as $product)
            <div class="bg-white shadow-md rounded-lg p-6 mx-auto">
                <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
                <p class="text-gray-600 mt-2">{{ $product->price_per_day }}</p>
                <div class="mt-4">
                    <x-button-link href="/rentalProduct/{{ $product->id }}">
                        more info
                    </x-button-link>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
