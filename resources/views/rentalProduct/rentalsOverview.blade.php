<x-app-layout>
    @if ($activeRentOrders->isNotEmpty())
        <x-card-list :title="__('rentalProduct.activeRentOrders')" :items='$activeRentOrders' pageName="page">
            @foreach ($activeRentOrders as $order)
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
    @endif

    @if ($pastRentOrders->isNotEmpty())
        <x-card-list :title="__('rentalProduct.pastRentOrders')" :items='$pastRentOrders' pageName="page2">
            @foreach ($pastRentOrders as $order)
                <a href="{{ route('rentalProduct.show', $order->rentalProduct->id) }}">
                    <x-card :title='$order->rentalProduct->name'>
                        <p>{{ __('time.from') }} {{ $order->rent_start_date }} {{ __('time.to') }}
                            {{ $order->rent_end_date }}</p>
                        <p class="text-green-500">{{ __('rentalProduct.deliver') }}</p>
                    </x-card>
                </a>
            @endforeach
        </x-card-list>
    @endif

    @can('advertise', Auth::user())
        <x-card-list :title="__('rentalProduct.activeOwnedRentOrders')" :items='$activeOwnedRentOrders' pageName="ownedPage">
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
