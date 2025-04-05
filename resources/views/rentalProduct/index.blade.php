<x-app-layout>
    @can('advertise', Auth::user())
        <a href="{{ route('rentalProduct.create') }}">CreateAdvertisementTODO</a>
    @endcan
    <x-card-list :items="$rentalProducts">
        @foreach ($rentalProducts as $product)
            <x-card title="{{ $product->name }}"
                description="€{{ $product->price_per_day }} {{ __('rentalProduct.perDay') }}">
                <div class="flex justify-between">
                    <p>{{ $product->owner->name }}</p>
                    ★{{ $product->reviewScore() }}
                </div>
                <div class="flex justify-between">
                    <x-button-link
                        href="/rentalProduct/{{ $product->id }}">{{ __('rentalProduct.moreInfo') }}</x-button-link>
                    <x-availability-sign :available="$product->availableTomorrow()" />
                </div>
            </x-card>
        @endforeach
    </x-card-list>
</x-app-layout>
