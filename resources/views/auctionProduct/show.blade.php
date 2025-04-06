<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 md:mx-[10%]">
        <div class="m-4">

            <x-card title="{{ $product->name }}">
                <p>{{ __('auctionProduct.highestBid') }} €{{ $product->highestBid() }}</p>
                <div class="flex justify-between">
                    <p>{{ __('time.timeLeft') }} {{ $product->timeLeft() }}</p>
                </div>
                <div class="flex justify-between">
                    <a href="/todo"
                        class="underline text-blue-600 hover:text-blue-800">{{ __('rentalProduct.supplier') }}:
                        {{ $product->owner->name }}</a>
                    {{ $qrcode }}
                </div>
            </x-card>
        </div>
        <div>
            asdf
        </div>
    </div>
</x-app-layout>
