<x-app-layout>
    <x-slot name="header">
        <x-title>{{ __('rentalProduct.name') }}</x-title>
    </x-slot>
    @can('advertise', Auth::user())
        <a href="{{ route('rentalProduct.create') }}">
            <x-card :title="__('rentalProduct.createTitle')" :description="__('rentalProduct.createDescription')"></x-card>
        </a>
    @endcan
    <x-card-list :items="$rentalProducts">
        @foreach ($rentalProducts as $product)
            <x-card title="{{ $product->name }}"
                description="€{{ $product->price_per_day }} {{ __('rentalProduct.perDay') }}">
                <div class="flex justify-between">
                    <p>{{ $product->owner->name }}</p>
                    ★{{ $product->reviewScore() }}
                </div>
                <div class="flex justify-between">
                    <x-button-link
                        href="/rentalProduct/{{ $product->id }}">{{ __('rentalProduct.moreInfo') }}</x-button-link>
                </div>
            </x-card>
        @endforeach
    </x-card-list>
</x-app-layout>
