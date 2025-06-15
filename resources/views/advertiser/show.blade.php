<x-app-layout>
    <x-slot name="header">
        <x-title>{{ $advertiser->name }}</x-title>
    </x-slot>

    {{-- TODO: huurproducten van adverteerder,
    TODO: veilingsproducten van adverteerder,
    TODO: review (op adverteerder, niet op de spullen)
    Eigen look en view (misschien background colors, dat is makkelijk)
    Een component kan zijn: Uitgelichte advertenties, een introductie tekst, afbeelding. Zie het als een pagina layout creator. --}}

    {{-- rentalProducts --}}
    @php
        $sortOptions = [
            'newest' => __('sorting.newest'),
            'oldest' => __('sorting.oldest'),
            'highest_rating' => __('sorting.highestRating'),
            'lowest_rating' => __('sorting.lowestRating'),
        ];
        $filterOptions = [
            'noFilter' => __('sorting.noFilter'),
            'available' => __('time.tomorrow') . ' ' . __('time.available'),
        ];
    @endphp
    <x-card-list :items="$rentalProducts" :sort-options="$sortOptions" :filter-options="$filterOptions" pageName="rental" sortingId="Rental">
        @foreach ($rentalProducts as $product)
            <x-card title="{{ $product->name }}"
                description="€{{ $product->price_per_day }} {{ __('rentalProduct.perDay') }}">
                {{-- <div class="flex justify-between">
                    <p>{{ $product->owner->name }}</p>
                    ★{{ $product->reviewScore() }}
                </div> --}}
                <div class="flex justify-between">
                    <x-button-link
                        href="/rentalProduct/{{ $product->id }}">{{ __('rentalProduct.moreInfo') }}</x-button-link>
                </div>
            </x-card>
        @endforeach
    </x-card-list>


    {{-- AuctionProducts --}}
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

    <x-card-list :items="$auctionProducts" :sort-options="$sortOptions" :filter-options="$filterOptions" pageName="auction" sortingId="Auction">
        @foreach ($auctionProducts as $product)
            <x-card title="{{ $product->name }}"
                description="{{ __('auctionProduct.highestBid') }}: €{{ $product->highestBid() }}">
                <x-auction-time-left :product="$product" />

                <div class="flex justify-between">
                    <x-button-link
                        href="/auctionProduct/{{ $product->id }}">{{ __('auctionProduct.moreInfo') }}</x-button-link>
                    <x-availability-sign :available="$product->available()"></x-availability-sign>
                </div>
            </x-card>
        @endforeach
    </x-card-list>

</x-app-layout>
