<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RentalProduct;
use App\Models\AuctionProduct;
use Carbon\Carbon;

class AdvertiserController extends Controller
{
    public function index()
    {
        return view('advertiser.index');
    }

    public function show(Request $request, $advertiserName)
    {
        $possibleAdvertisers = ['personal_advertiser', 'business_advertiser'];
        $advertiser = User::where('name', $advertiserName)->whereIn('role', $possibleAdvertisers)->firstOrFail();

        $sortRental = request()->query('sort', 'newest');
        $filterRental = request()->query('filter', 'noFilter');

        $queryRental = RentalProduct::with('owner')
            ->where('owner_id', $advertiser->id);

        if ($sortRental === 'oldest') {
            $queryRental->orderBy('created_at', 'asc');
        } elseif ($sortRental === 'highest_rating') {
            $queryRental->withAvg('reviews', 'review_score')->orderBy('reviews_avg_review_score', 'desc');
        } elseif ($sortRental === 'lowest_rating') {
            $queryRental->withAvg('reviews', 'review_score')->orderBy('reviews_avg_review_score', 'asc');
        } else {
            $queryRental->orderBy('created_at', 'desc');
        }

        $products = $queryRental->get(); // no pagination yet (still need to filter)

        if ($filterRental === 'available') {
            $products = $products->filter(fn($product) => $product->availableTomorrow());
        } elseif ($filterRental === 'unavailable') {
            $products = $products->filter(fn($product) => !$product->availableTomorrow());
        }


        $rentalProducts = $queryRental
            ->paginate(5)
            ->appends([
                'sortAuction' => $sortRental,
                'filterAuction' => $filterRental,
            ]);

        $sortAuction = $request->query('sortAuction', 'noSort');
        $filterAuction = $request->query('filterAuction', 'noFilter');

        $queryAuction = AuctionProduct::query()
            ->where('owner_id', $advertiser->id);
        // $queryAuction = AuctionProduct::with('owner');

        $now = Carbon::now();
        if ($filterAuction === 'available') {
            $queryAuction->where('deadline', '>', $now);
        } elseif ($filterAuction === 'oneHourLeft') {
            $queryAuction->whereBetween('deadline', [$now, $now->copy()->addHour()]);
        } elseif ($filterAuction === 'oneDayLeft') {
            $queryAuction->whereBetween('deadline', [$now, $now->copy()->addDay()]);
        }

        if ($sortAuction === 'highestBid') {
            $queryAuction->withMax('bids', 'price')->orderByDesc('bids_max_price');
        } elseif ($sortAuction === 'lowestBid') {
            $queryAuction->withMax('bids', 'price')->orderBy('bids_max_price');
        } else {
            $queryAuction->orderBy('deadline');
        }

        $auctionProducts = $queryAuction
            ->paginate(5)
            ->appends([
                'sortAuction' => $sortAuction,
                'filterAuction' => $filterAuction,
            ]);

        return view('advertiser.show', ['advertiser' => $advertiser, 'rentalProducts' => $rentalProducts, 'auctionProducts' => $auctionProducts]);
    }

    public function edit() {}
    public function update() {}
}
