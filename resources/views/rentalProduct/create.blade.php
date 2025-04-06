<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="max-w-md p-6 bg-white shadow-md rounded-lg">
            @if (session('success'))
                <div class="mb-4 p-2 text-green-700 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{ __('rentalProduct.createTitle') }}</h2>
            <form action="{{ route('rentalProduct.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('rentalProduct.productName')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="price_per_day" :value="__('rentalProduct.pricePerDay')" />
                    <x-text-input id="price_per_day" name="price_per_day" type="number" step="0.01"
                        class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('price_per_day')" class="mt-2" />
                </div>
                <div class="flex justify-end">
                    <x-primary-button type="submit">
                        {{ __('rentalProduct.save') }}
                    </x-primary-button>
                </div>
            </form>

            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{ __('rentalProduct.createBulk') }}</h2>

            <form action="{{ route('rentalProduct.storeBulk') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-input-label for="price_per_day" value="csv" />
                <input class="m-2" type="file" name="file" accept=".csv">
                <x-primary-button type="submit">
                    {{ __('rentalProduct.importCSV') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
