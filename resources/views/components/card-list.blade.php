@php
    $pageName = $pageName ?? 'page';
@endphp

<div class="m-4 md:m-10">
    @isset($title)
        <x-title class="m-3">{{ $title }}</x-title>
    @endisset
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 m-3">
        {{ $slot }}
    </div>

    <div class="m-3">
        {{ $items->appends(request()->except($pageName))->links() }}
    </div>
</div>
