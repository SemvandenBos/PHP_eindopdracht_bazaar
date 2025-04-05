<x-app-layout>
    @if ($activeRentOrders)
        @foreach ($activeRentOrders as $order)
            <p>{{ $order->rentalProduct->name }}</p>
        @endforeach
    @endif

    @can('advertise', Auth::user())
        <div class="grid grid-cols-1 md:grid-cols-2 md:mx-[10%]">
            <div class="m-4">
                <x-title>start</x-title>
                @foreach ($activeOwnedRentOrders as $order)
                    <a href="{{ route('rentalProduct.show', $order->rentalProduct->id) }}">
                        <x-card :title='$order->rentalProduct->name'>
                            {{ $order->rent_start_date }}
                        </x-card>
                    </a>
                @endforeach
            </div>
            <div>
                <x-title>end</x-title>
                @foreach ($activeOwnedRentOrders as $order)
                    <x-card :title='$order->rentalProduct->name'>
                        {{ $order->rent_end_date }}
                    </x-card>
                @endforeach
            </div>
        </div>
    @endcan
</x-app-layout>
