@if ($product->available())
    <p>{{ __('time.timeLeft') }} {{ $product->timeLeft() }}</p>
@else
    <p>{{ __('time.timeLeft') }} {{ __('time.tooLate') }}</p>
@endif
