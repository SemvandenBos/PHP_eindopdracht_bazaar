<x-app-layout>
    <x-slot name="header">
        <x-title>{{ __('auctionProduct.history') }}</x-title>
    </x-slot>
    <x-card-list :items="$pastBoughtProducts">
        @foreach ($pastBoughtProducts as $product)
            <x-card title="{{ $product->name }}"
                description="{{ __('auctionProduct.price') }} €{{ $product->highestBid() }}">
                {{-- <x-auction-time-left :product="$product" /> --}}


                <p>{{ __('rentalProduct.supplier') }}: {{ $product->owner->name }}</p>

                <div class="flex justify-between">
                    <x-button-link
                        href="/auctionProduct/{{ $product->id }}">{{ __('auctionProduct.moreInfo') }}</x-button-link>
                    {{-- <x-availability-sign :available="$product->available()"></x-availability-sign> --}}
                </div>
            </x-card>
        @endforeach
    </x-card-list>
</x-app-layout>
