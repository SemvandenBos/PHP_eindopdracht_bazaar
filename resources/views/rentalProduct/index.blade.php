<x-app-layout>
    <x-card-list :items="$rentalProducts" >
        @foreach ($rentalProducts as $product)
            <x-card title="{{ $product->name }}" description="€{{ $product->price_per_day }} per day">
                <p>{{$product->owner->name}}</p>
                <x-button-link href="/rentalProduct/{{ $product->id }}">More Info</x-button-link>
            </x-card>
        @endforeach
    </x-card-list>
</x-app-layout>
