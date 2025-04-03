<x-app-layout>
    <x-card-list :items='$rentalFavourites'>
        @foreach ($rentalFavourites as $rentalFavourite)
            <a href="{{ route('rentalProduct.show', $rentalFavourite->id) }}">
                <x-card :title="$rentalFavourite->name">
                    <x-favourite-button :productId="$rentalFavourite->id" :isActive="Auth::user()->hasFavourite($rentalFavourite)"></x-favourite-button>
                </x-card>
            </a>
        @endforeach
    </x-card-list>
</x-app-layout>
