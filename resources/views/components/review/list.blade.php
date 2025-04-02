<div class="flex flex-col gap-2 my-5">
    <h2 class="md:text-2xl font-bold">Reviews</h2>
    <div class="flex gap-2">
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">Newest</a>|
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">Oldest</a>| 
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'highest_rating']) }}">Highest Rating</a>|
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'lowest_rating']) }}">Lowest Rating</a> 
    </div>

    @foreach ($reviews as $review)
        <x-review :review="$review" />
    @endforeach
    <div class="mt-4">
        {{ $reviews->links() }}
    </div>
</div>
