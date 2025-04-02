<x-app-layout>
    <div class="max-w-sm mx-auto mt-5">
        <x-card title="{{ $product->name }}" description="€{{ $product->price_per_day }} per day">
            <div class="flex justify-between">
                <p>{{ $product->owner->name }}</p>
                <x-availability-sign :available="$product->available()" />
                ★{{ $product->reviewScore() }}
            </div>
        </x-card>

        @can('manageUsers')
            <div class="flex flex-col gap-2 mt-5">
                @foreach ($product->orders as $order)
                    <div class="bg-white shadow-md rounded-lg p-2">
                        {{ $order->user->name }} rented at {{ $order->rented_at }}
                    </div>
                @endforeach
            </div>
        @endcan

        <form method="POST" action="{{ route('order.store') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <x-primary-button>
                Rent
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('order.storeReview') }}" class="my-5">
            @csrf
            <h2 class="md:text-2xl font-bold">Leave review</h2>
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            {{-- review text --}}
            <div>
                <x-input-label for="review_text" :value="__('Review:    ')" />
                <x-text-input id="review_text" name="review_text" :value="old('review_text')" placeholder="review here" />
                <x-input-error :messages="$errors->get('review_text')" class="mt-2" />
            </div>

            {{-- review score --}}
            <div>
                <x-input-label for="review_score" :value="__('Score:')" />
                <x-number-input name="score" min="1" max="5" step="0.5" class="w-24" />
                <x-input-error :messages="$errors->get('review_score')" class="mt-2" />
            </div>

            <x-primary-button>
                Post review
            </x-primary-button>
        </form>

        <x-review.list :reviews="$reviews" />
    </div>
</x-app-layout>
