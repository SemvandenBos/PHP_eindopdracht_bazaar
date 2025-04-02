<div class="flex flex-col gap-2 my-5">
    <h2 class="md:text-2xl font-bold">Reviews</h2>
    <div class="flex gap-2">
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">{{ __('sorting.newest') }}</a>|
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">{{ __('sorting.oldest') }}</a>|
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'highest_rating']) }}">{{ __('sorting.highestRating') }}</a>|
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'lowest_rating']) }}">{{ __('sorting.lowestRating') }}</a>
    </div>

    @foreach ($reviews as $review)
        <x-review :review="$review" />
    @endforeach
    <div class="mt-4">
        {{ $reviews->links() }}
    </div>
</div>
