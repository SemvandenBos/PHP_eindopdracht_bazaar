<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 md:mx-[10%]">
        <div class="m-4">

            <x-card title="{{ $product->name }}">
                <p>{{ __('auctionProduct.highestBid') }} €{{ $product->highestBid() }}</p>
                <div class="flex justify-between">
                    <x-auction-time-left :product="$product" />
                </div>
                <div class="flex justify-between">
                    <a href="/todo"
                        class="underline text-blue-600 hover:text-blue-800">{{ __('rentalProduct.supplier') }}:
                        {{ $product->owner->name }}</a>
                    {{ $qrcode }}
                </div>
            </x-card>

            <form method="POST" action="{{ route('bid.store') }}">
                @csrf

                <x-title>{{ __('auctionProduct.placeBid') }}</x-title>
                <x-error-success />
                <input type="hidden" name="product_id" value="{{ $product->id }}" />

                {{-- bid value --}}
                <div>
                    <x-input-label for="price" :value="__('auctionProduct.price')" />
                    <x-number-input :min="$product->highestBid()" step="0.01" id="price" name="price" :value="old('price')"
                        placeholder="€{{ $product->highestBid() + 1 }}" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <x-primary-button>
                    {{ __('auctionProduct.place') }}
                </x-primary-button>
            </form>
        </div>
        <div>
        </div>
    </div>
</x-app-layout>
