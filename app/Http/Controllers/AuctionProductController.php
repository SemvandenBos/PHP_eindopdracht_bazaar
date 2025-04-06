<?php

namespace App\Http\Controllers;

use App\Models\AuctionProduct;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AuctionProductController extends Controller
{
    public function index()
    {
        $auctionProducts = AuctionProduct::with('owner')->paginate(5);
        return view('auctionProduct.index', compact('auctionProducts'));
    }

    public function show($id)
    {
        $product = AuctionProduct::with('bids')->findOrFail($id);

        $qrcode = QrCode::generate(url('auctionProduct/show/' . $id));

        return view('auctionProduct.show', compact('product', 'qrcode'));
    }

    public function create()
    {
        return view('auctionProduct.create');
    }

    public function store()
    {
        dd("store auctionproduct");
    }
}
