<div class="flex flex-col gap-2 my-5">
    <h2 class="md:text-2xl font-bold">Reviews</h2>
    @foreach ($reviews as $review)
        <x-review :name="$review->reviewer->name" :review="$review->review_text" />
    @endforeach
    <div class="mt-4">
        {{ $reviews->links() }}
    </div>
</div>