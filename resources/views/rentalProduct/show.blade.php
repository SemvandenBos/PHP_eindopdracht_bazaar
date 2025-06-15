<x-app-layout>
    <x-error-success />
    <div class="grid grid-cols-1 md:grid-cols-2 md:mx-[10%]">
        <div class="m-4">
            <x-card title="{{ $product->name }}">
                <p>€{{ $product->price_per_day }} {{ __('rentalProduct.perDay') }}</p>
                <div class="flex justify-between">
                    ★{{ $product->reviewScore() }}
                </div>
                <div class="flex justify-between">
                    <a href="{{ route('advertiser.show', ['advertiserName' => $product->owner->name]) }}"
                        class="underline text-blue-600 hover:text-blue-800">{{ __('rentalProduct.supplier') }}:
                        {{ $product->owner->name }}</a>
                    {{ $qrcode }}
                </div>
            </x-card>

            <x-favourite-button :productId='$product->id' :isActive="Auth::user()->hasFavourite($product)"></x-favourite-button>
            <form method="POST" action="{{ route('order.store') }}">
                @csrf
                <x-title>{{ __('rentalProduct.rent') }}</x-title>
                <input type="hidden" name="product_id" value="{{ $product->id }}" />

                {{-- start date --}}
                <div>
                    <x-input-label for="rent_start_date" :value="__('time.startDate')" />
                    <x-date-input id="rent_start_date" name="rent_start_date" :value="old('rent_start_date')" />
                    <x-input-error :messages="$errors->get('rent_start_date')" class="mt-2" />
                </div>

                {{-- end date --}}
                <div>
                    <x-input-label for="rent_end_date" :value="__('time.endDate')" />
                    <x-date-input id="rent_end_date" name="rent_end_date" :value="old('rent_end_date')" />
                    <x-input-error :messages="$errors->get('rent_end_date')" class="mt-2" />
                </div>


                <x-primary-button>
                    {{ __('rentalProduct.rent') }}
                </x-primary-button>
            </form>

            <div class="flex flex-col gap-2 mt-5">
                <x-title>{{ __('rentalProduct.alreadyBookedDates') }}</x-title>
                @foreach ($product->orders as $order)
                    <div class="bg-white shadow-md rounded-lg p-2">
                        @can('manageUsers')
                            {{ $order->user->name }} {{ __('rentalProduct.rentedAt') }}
                        @endcan
                        {{ $order->rent_start_date }} to
                        {{ $order->rent_end_date }}
                    </div>
                @endforeach
            </div>

        </div>
        <div class="m-4">
            <form method="POST" action="{{ route('order.storeReview') }}" class="my-5">
                @csrf
                <x-title class="md:text-2xl font-bold">{{ __('review.leaveReview') }}</x-title>
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
                    <x-number-input name="review_score" min="1" max="5" step="0.1" class="w-24"
                        :value="old('review_score')" />
                    <x-input-error :messages="$errors->get('review_score')" class="mt-2" />
                </div>

                <x-primary-button>
                    {{ __('review.postReview') }}
                </x-primary-button>
            </form>

            <x-review.list :reviews="$reviews" />
        </div>
    </div>
</x-app-layout>
