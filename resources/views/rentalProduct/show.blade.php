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


        <form method="POST" action="{{ route('order.store') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <x-primary-button>
                Rent
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
