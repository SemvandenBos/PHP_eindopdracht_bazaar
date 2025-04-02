@props([
    'disabled' => false,
    'min' => null,
    'max' => null,
    'step' => '1',
])

<input 
    type="number"
    @if($disabled) disabled @endif
    @if(!is_null($min)) min="{{ $min }}" @endif
    @if(!is_null($max)) max="{{ $max }}" @endif
    step="{{ $step }}"
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}
>