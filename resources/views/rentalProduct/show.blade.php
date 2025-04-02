<x-app-layout>
    <div class="max-w-sm mx-auto">
        <x-card title="{{ $product->name }}" description="€{{ $product->price_per_day }} per day">
            <div class="flex justify-between">
                <p>{{ $product->owner->name }}</p>
                <x-availability-sign :available="$product->available()" />
            </div>
        </x-card>

        {{-- Niet voor iedereen ofc --}}
        <div class="flex flex-col gap-2 my-5">
            @foreach ($product->orders as $order)
                <div class="bg-white shadow-md rounded-lg p-2">
                    {{ $order->user->name }} rented at {{ $order->rented_at }}
                </div>
            @endforeach
        </div>

        {{-- Reviews: TODO lijst van maken met sortering!! --}}
        <div class="flex flex-col gap-2 my-5">
            <h2 class="md:text-2xl font-bold">Reviews</h2>
            @foreach ($product->reviews as $review)
                <div class="bg-white shadow-md rounded-lg p-2">
                    <h3 class="font-bold">{{ $review->reviewer->name }}</h3>
                    <p>{{ $review->review_text }}</p>
                </div>
            @endforeach
        </div>

        <form method="POST" action="{{ route('order.storeReview') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <x-input-label for="review_text" :value="__('Review product')" />
            <x-text-input id="review_text" name="review_text" :value="old('review_text')" placeholder="review here" />
            <x-input-error :messages="$errors->get('review_text')" class="mt-2" />
            <x-primary-button>
                Post review
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('order.store') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <x-primary-button>
                Rent
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
