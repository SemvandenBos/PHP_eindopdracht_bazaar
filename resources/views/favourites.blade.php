<x-app-layout>
    <x-card-list :items='$rentalFavourites'>
        @foreach ($rentalFavourites as $rentalFavourite)
            <x-card :title='$rentalFavourite->name'>
                <x-favourite-button :productId='$rentalFavourite->id' :isActive="Auth::user()->hasFavourite($rentalFavourite)"></x-favourite-button>
            </x-card>
        @endforeach
    </x-card-list>
</x-app-layout>
