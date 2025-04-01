<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 m-3">
        {{ $slot }}
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>
</div>