<x-app-layout>
    <x-card-list :items="$rentalProducts">
        @foreach ($rentalProducts as $product)
            <x-card title="{{ $product->name }}" description="€{{ $product->price_per_day }} {{__('rentalProduct.perDay')}}">
                <p>{{ $product->owner->name }}</p>
                <div class="flex justify-between">
                    <x-button-link href="/rentalProduct/{{ $product->id }}">{{__('rentalProduct.moreInfo')}}</x-button-link>
                    <x-availability-sign :available="$product->available()" />
                    ★{{ $product->reviewScore() }}
                </div>
            </x-card>
        @endforeach
    </x-card-list>
</x-app-layout>
