<x-app-layout>
    <x-slot name="header">
        <x-title>{{ __('auctionProduct.indexPage') }}</x-title>
    </x-slot>

    @can('advertise', Auth::user())
        <a href="{{ route('auctionProduct.create') }}">
            <x-card :title="__('auctionProduct.createTitle')" :description="__('auctionProduct.createDescription')"></x-card>
        </a>
    @endcan

    @php
        $sortOptions = [
            'noSort' => __('sorting.noSort'),
            'highestBid' => __('auctionProduct.highestBid'),
            'lowestBid' => __('auctionProduct.lowestBid'),
        ];
        $filterOptions = [
            'noFilter' => __('sorting.noFilter'),
            'available' => __('time.available'),
            'oneHourLeft' => __('time.oneHourLeft'),
            'oneDayLeft' => __('time.oneDayLeft'),
        ];
    @endphp

    <x-card-list :items="$auctionProducts" :sort-options="$sortOptions" :filter-options="$filterOptions">
        @foreach ($auctionProducts as $product)
            <x-card title="{{ $product->name }}"
                description="{{ __('auctionProduct.highestBid') }}: €{{ $product->highestBid() }}">
                <x-auction-time-left :product="$product" />


                <p>{{ __('rentalProduct.supplier') }}: {{ $product->owner->name }}</p>

                <div class="flex justify-between">
                    <x-button-link
                        href="/auctionProduct/{{ $product->id }}">{{ __('auctionProduct.moreInfo') }}</x-button-link>
                    <x-availability-sign :available="$product->available()"></x-availability-sign>
                </div>
            </x-card>
        @endforeach
    </x-card-list>
</x-app-layout>
