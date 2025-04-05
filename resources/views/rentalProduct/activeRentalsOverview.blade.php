<x-app-layout>
    @if ($activeRentOrders->isNotEmpty())
        <x-title>pastRentalOrders</x-title>
        @foreach ($pastRentOrders as $order)
            <p>{{ $order->rentalProduct->name }}</p>
        @endforeach

        {{-- <x-card-list :items='$activeRentOrders'>
            <x-title>activeRentalOrders</x-title>
            @foreach ($activeRentOrders as $order)
                <p>{{ $order->rentalProduct->name }}</p>
            @endforeach
        </x-card-list> --}}
    @endif

    @if ($pastRentOrders->isNotEmpty())
        <x-title>pastRentalOrders</x-title>
        @foreach ($pastRentOrders as $order)
            <p>{{ $order->rentalProduct->name }}</p>
        @endforeach
    @endif

    @can('advertise', Auth::user())
        <x-card-list :title="__('rentalProduct.activeOwnedRentOrders')" :items='$activeOwnedRentOrders'>
            @foreach ($activeOwnedRentOrders as $order)
                @if ($order->rent_start_date >= now())
                    <a href="{{ route('rentalProduct.show', $order->rentalProduct->id) }}">
                        <x-card :title='$order->rentalProduct->name' :description='$order->rent_start_date'>
                            <p class="text-green-500">{{ __('rentalProduct.deliver') }}</p>
                        </x-card>
                    </a>
                @endif
                <a href="{{ route('rentalProduct.show', $order->rentalProduct->id) }}">
                    <x-card :title='$order->rentalProduct->name' :description='$order->rent_end_date'>
                        <p class="text-red-500">{{ __('rentalProduct.collect') }}</p>
                    </x-card>
                </a>
            @endforeach
        </x-card-list>
    @endcan
</x-app-layout>
