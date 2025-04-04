<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 md:mx-[10%]">
        <div class="m-4">
            <x-title>start</x-title>
            @foreach ($activeRentOrders as $order)
                <x-card :title='$order->rentalProduct->name'>
                    {{ $order->rent_start_date }}
                </x-card>
            @endforeach
        </div>
        <div>
            <x-title>end</x-title>
            @foreach ($activeRentOrders as $order)
                <x-card :title='$order->rentalProduct->name'>
                    {{ $order->rent_end_date }}
                </x-card>
            @endforeach
        </div>
    </div>
</x-app-layout>
