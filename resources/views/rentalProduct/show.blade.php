<x-app-layout>
    <div class="max-w-sm mx-auto mt-5">
        <x-card title="{{ $product->name }}">
            <p>€{{ $product->price_per_day }} {{ __('rentalProduct.perDay') }}</p>
            <div class="flex justify-between">
                <x-availability-sign :available="$product->availableTomorrow()" />
                ★{{ $product->reviewScore() }}
            </div>
            <a href="/todo" class="underline text-blue-600 hover:text-blue-800">{{ __('rentalProduct.supplier') }}:
                {{ $product->owner->name }}</a>
        </x-card>

        <div class="flex justify-between my-2">
            <form method="POST" action="{{ route('order.toggleFavourite') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <x-favourite-button :isActive="Auth::user()->hasFavourite($product)">
                    ★ {{ __('rentalProduct.favourite') }}
                </x-favourite-button>

            </form>
        </div>

        <form method="POST" action="{{ route('order.store') }}">
            @csrf
            <h2 class="md:text-2xl font-bold">{{ __('rentalProduct.rent') }}</h2>
            <input type="hidden" name="product_id" value="{{ $product->id }}" />

            {{-- start date --}}
            <div>
                <x-input-label for="rent_start_date" :value="__('rentalProduct.startDate')" />
                <x-date-input id="rent_start_date" name="rent_start_date" :value="old('rent_start_date')" />
                <x-input-error :messages="$errors->get('rent_start_date')" class="mt-2" />
            </div>

            {{-- end date --}}
            <div>
                <x-input-label for="rent_end_date" :value="__('rentalProduct.endDate')" />
                <x-date-input id="rent_end_date" name="rent_end_date" :value="old('rent_end_date')" />
                <x-input-error :messages="$errors->get('rent_end_date')" class="mt-2" />
            </div>


            <x-primary-button>
                {{ __('rentalProduct.rent') }}
            </x-primary-button>
        </form>

        {{-- @can('manageUsers') --}}
        <div class="flex flex-col gap-2 mt-5">
            @foreach ($product->orders as $order)
                <div class="bg-white shadow-md rounded-lg p-2">
                    {{ $order->user->name }} {{ __('rentalProduct.rentedAt') }} {{ $order->rent_start_date }} to
                    {{ $order->rent_end_date }}
                </div>
            @endforeach
        </div>
        {{-- @endcan --}}

        <form method="POST" action="{{ route('order.storeReview') }}" class="my-5">
            @csrf
            <h2 class="md:text-2xl font-bold">{{ __('review.leaveReview') }}</h2>
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            {{-- review text --}}
            <div>
                <x-input-label for="review_text" :value="__('review.review')" />
                <x-text-input id="review_text" name="review_text" :value="old('review_text')"
                    placeholder="{{ __('review.reviewPlaceholder') }}" />
                <x-input-error :messages="$errors->get('review_text')" class="mt-2" />
            </div>

            {{-- review score --}}
            <div>
                <x-input-label for="review_score" :value="__('review.score')" />
                <x-number-input name="score" min="1" max="5" step="0.5" class="w-24" />
                <x-input-error :messages="$errors->get('review_score')" class="mt-2" />
            </div>

            <x-primary-button>
                {{ __('review.postReview') }}
            </x-primary-button>
        </form>

        <x-review.list :reviews="$reviews" />
    </div>
</x-app-layout>
