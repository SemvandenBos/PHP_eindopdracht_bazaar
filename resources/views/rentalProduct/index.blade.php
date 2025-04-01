<x-app-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 m-3">
        @foreach ($rentalProducts as $product)
        <x-card title="{{ $product->name }}" description="{{ $product->price_per_day }}">
            <x-button-link href="/rentalProduct/{{ $product->id }}">More Info</x-button-link>
        </x-card>
        @endforeach
    </div>
    <div>
        {{ $rentalProducts->links() }}
    </div>
</x-app-layout>
