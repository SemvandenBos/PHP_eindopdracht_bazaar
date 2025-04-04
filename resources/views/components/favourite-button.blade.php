<div class="flex justify-between my-2">
    <form method="POST" action="{{ route('order.toggleFavourite') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $productId }}">
        <button
            {{ $attributes->merge([
                'type' => 'submit',
                'class' =>
                    'inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm focus:outline-none transition ease-in-out duration-150 ' .
                    ($isActive
                        ? 'bg-yellow-500 border-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-500'
                        : 'bg-gray-300 border-gray-400 text-gray-700 hover:bg-gray-400 focus:ring-indigo-500'),
            ]) }}>
            ★ {{ __('rentalProduct.favourite') }}
        </button>

    </form>
</div>
