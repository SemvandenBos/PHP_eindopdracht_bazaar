<x-app-layout>
    <x-slot name="header">
        <x-title>{{ __('rentalProduct.favourites') }}</x-title>
    </x-slot>

    @if ($rentalFavourites->isEmpty())
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <x-title>{{ __('rentalProduct.favouriteEmpty') }}</x-title>
        </div>
    @else
        <x-card-list :items='$rentalFavourites'>
            @foreach ($rentalFavourites as $rentalFavourite)
                <a href="{{ route('rentalProduct.show', $rentalFavourite->id) }}">
                    <x-card :title="$rentalFavourite->name">
                        <div class="flex justify-between items-center">
                            <x-favourite-button :productId="$rentalFavourite->id" :isActive="Auth::user()->hasFavourite($rentalFavourite)"></x-favourite-button>
                            <p>{{ __('rentalProduct.moreInfo') }}</p>
                        </div>
                    </x-card>
                </a>
            @endforeach
        </x-card-list>
    @endif
</x-app-layout>
