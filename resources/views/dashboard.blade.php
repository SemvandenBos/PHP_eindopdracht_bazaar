<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 flex justify-end">
                        <form method="GET" action="{{ route('dashboard') }}">
                            <select name="filter" onchange="this.form.submit()"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="new_to_old" {{ $currentFilter === 'new_to_old' ? 'selected' : '' }}>
                                    {{ __('Newest to Oldest') }}
                                </option>
                                <option value="old_to_new" {{ $currentFilter === 'old_to_new' ? 'selected' : '' }}>
                                    {{ __('Oldest to Newest') }}
                                </option>
                                <option value="seller_a_z" {{ $currentFilter === 'seller_a_z' ? 'selected' : '' }}>
                                    {{ __('Seller Name (A-Z)') }}
                                </option>
                                <option value="product_a_z" {{ $currentFilter === 'product_a_z' ? 'selected' : '' }}>
                                    {{ __('Product Name (A-Z)') }}
                                </option>
                            </select>
                        </form>
                    </div>

                    <!-- Regular Products Section -->
                    <div class="mb-12">
                        <h3 class="text-lg font-medium mb-4">{{ __('Products') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($products as $product)
                                <x-card class="flex flex-col h-full">
                                    <div class="flex-grow">
                                        <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                                        <p class="text-gray-600 mb-4">€{{ $product->price }}</p>
                                        <div class="flex justify-between items-center mb-4">
                                            <p class="text-sm text-gray-500">{{ $product->name }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-auto">
                                        <x-button-link href="/product/{{ $product->id }}" class="w-full">
                                            {{ __('purchasableProduct.moreInfo') }}
                                        </x-button-link>
                                    </div>
                                </x-card>
                            @endforeach
                        </div>
                    </div>

                    <!-- Rental Products Section -->
                    <div class="mb-12">
                        <h3 class="text-lg font-medium mb-4">{{ __('Rental Products') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($rentalProducts as $product)
                                <x-card class="flex flex-col h-full">
                                    <div class="flex-grow">
                                        <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                                        <p class="text-gray-600 mb-4">€{{ $product->price_per_day }}
                                            {{ __('rentalProduct.perDay') }}</p>
                                        <div class="flex justify-between items-center mb-4">
                                            <p class="text-sm text-gray-500">{{ $product->owner->name }}</p>
                                            @if(method_exists($product, 'reviewScore'))
                                                <span class="text-yellow-500">★{{ $product->reviewScore() }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-auto">
                                        <x-button-link href="/rentalProduct/{{ $product->id }}" class="w-full">
                                            {{ __('rentalProduct.moreInfo') }}
                                        </x-button-link>
                                    </div>
                                </x-card>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>