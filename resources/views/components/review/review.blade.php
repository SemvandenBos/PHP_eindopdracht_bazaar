<div class="bg-white shadow-md rounded-lg p-2">
    <p>{{ $review->created_at->toDateString() }}</p>
    <div class="flex justify-between">
        @isset($review->reviewer->name)
            <h3 class="font-bold">{{ $review->reviewer->name }}</h3>
        @else
            <h3 class="font-bold">{{__('review.anonymous')}}</h3>
        @endisset
        <p>★{{ $review->review_score }}</p>
    </div>
    <p>{{ $review->review_text }}</p>
</div>
