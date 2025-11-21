<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopListController extends Controller
{
    public function index()
    {
        // Load all shops with their category
        $shops = Shop::with('category')->get();

        return view('components.shop-list', compact('shops'));
    }

}
