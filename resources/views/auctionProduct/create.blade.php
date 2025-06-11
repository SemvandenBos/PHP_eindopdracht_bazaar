<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="max-w-md p-6 bg-white shadow-md rounded-lg">
            <x-error-success />
            <x-title>{{ __('auctionProduct.createTitle') }}</x-title>
            <form action="{{ route('auctionProduct.store') }}" method="POST" class="space-y-4">
                @csrf
                {{-- name --}}
                <div>
                    <x-input-label for="name" :value="__('rentalProduct.productName')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                {{-- deadline --}}
                <div>
                    <x-input-label for="deadline" :value="__('auctionProduct.deadline')" />
                    <input type="datetime-local" id="deadline" name="deadline"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required />
                    <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                </div>
                <div class="flex justify-end">
                    <x-primary-button type="submit">
                        {{ __('rentalProduct.save') }}
                    </x-primary-button>
                </div>
            </form>
</x-app-layout>
