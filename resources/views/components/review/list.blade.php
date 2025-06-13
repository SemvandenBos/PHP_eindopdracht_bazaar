<div class="flex flex-col gap-2 my-5">
    <x-title>Reviews</x-title>
    <div class="flex gap-2">
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">{{ __('sorting.newest') }}</a>|
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">{{ __('sorting.oldest') }}</a>|
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'highest_rating']) }}">{{ __('sorting.highestRating') }}</a>|
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'lowest_rating']) }}">{{ __('sorting.lowestRating') }}</a>
    </div>
    <div class="flex gap-2">
        <a href="{{ request()->fullUrlWithQuery(['filter' => 'all']) }}">{{ __('time.allTime') }}</a> |
        <a href="{{ request()->fullUrlWithQuery(['filter' => 'past_week']) }}">{{ __('time.pastWeek') }}</a> |
        <a href="{{ request()->fullUrlWithQuery(['filter' => 'past_month']) }}">{{ __('time.pastMonth') }}</a>
    </div>

    @if (sizeof($reviews) < 1)
        <x-title>{{ __('review.emptyState') }}</x-title>
    @else
        @foreach ($reviews as $review)
            <x-review :review="$review" />
        @endforeach
        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    @endif
</div>
