@if ($available)
    <span class="inline-flex items-center px-2 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
        ✅ {{ __('time.available') }}
    </span>
@else
    <span class="inline-flex items-center px-2 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">
        ❌ {{ __('time.unavailable') }}
    </span>
@endif
