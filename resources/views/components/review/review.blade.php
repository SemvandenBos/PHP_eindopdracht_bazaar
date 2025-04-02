<div class="bg-white shadow-md rounded-lg p-2">
    @isset($name)
        <h3 class="font-bold">{{ $name }}</h3>
    @else
        <h3 class="font-bold">Anonymous</h3>
    @endisset

    @isset($review)
        <p>{{ $review }}</p>
    @endisset
</div>
