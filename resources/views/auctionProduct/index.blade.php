<x-app-layout>
    @can('advertise', Auth::user())
        <a href="{{ route('auctionProduct.create') }}">
            <x-card :title="__('auctionProduct.createTitle')" :description="__('auctionProduct.createDescription')"></x-card>
        </a>
    @endcan
    <x-card-list :items="$auctionProducts">
        @foreach ($auctionProducts as $product)
            <x-card title="{{ $product->name }}"
                description="{{ __('auctionProduct.highestBid') }} €{{ $product->highestBid() }}">
                <div class="flex justify-between">
                    <p>{{ __('rentalProduct.supplier') }}: {{ $product->owner->name }}</p>
                </div>
                <div class="flex justify-between">
                    <x-button-link
                        href="/auctionProduct/{{ $product->id }}">{{ __('auctionProduct.moreInfo') }}</x-button-link>
                </div>
            </x-card>
        @endforeach
    </x-card-list>
</x-app-layout>
