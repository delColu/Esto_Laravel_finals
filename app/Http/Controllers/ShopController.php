<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Category;
use App\Models\SubCategory;

class ShopController extends Controller
{
    // SHOW ADD SHOP PAGE + LIST
    public function create()
    {
        $shops = Shop::all();
        $categories = Category::all();

        return view('components.shop-add', [
            'shops' => $shops,
            'categories' => $categories,
            'subcategories' => [] // empty on create
        ]);
    }


    // STORE NEW SHOP
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Owner_fname'   => 'required|string|max:255',
            'Owner_lname'   => 'required|string|max:255',
            'shopname'      => 'required|string|max:255',
            'catID'         => 'required|exists:categories,catID',
            'subCatID'      => 'nullable|exists:sub_categories,SubCatID',
        ]);

        // Store category name
        $category = Category::find($validated['catID']);
        $validated['Item_category'] = $category->name;

        // Store subcategory name (if selected)
        if (!empty($validated['SubCatID'])) {
            $sub = SubCategory::find($validated['SubCatID']);
            $validated['subcat'] = $sub->name;
        }


        Shop::create($validated);

        return redirect()->route('AddShop')
            ->with('success', 'Shop added successfully.')
            ->with('clear_form', true);
    }


    // SHOW EDIT FORM
    public function edit(Shop $shop)
    {
        return view('components.shop-add', [
            'shop' => $shop,
            'shops' => Shop::all(),
            'categories' => Category::all(),
            'subcategories' => SubCategory::where('catID', $shop->catID)->get()
        ]);
    }


    // UPDATE SHOP
    public function update(Request $request, Shop $shop)
    {
        $validated = $request->validate([
            'Owner_fname'   => 'required|string|max:255',
            'Owner_lname'   => 'required|string|max:255',
            'shopname'      => 'required|string|max:255',
            'catID'         => 'required|exists:categories,catID',
            'SubCatID'      => 'nullable|exists:sub_categories,SubCatID',
        ]);

        // category name
        $category = Category::find($validated['catID']);
        $validated['Item_category'] = $category->name;

        // sub category name
        if (!empty($validated['SubCatID'])) {
            $sub = SubCategory::find($validated['SubCatID']);
            $validated['subCat'] = $sub->name;
        } else {
            $validated['subCat'] = null;
        }

        $shop->update($validated);

        return redirect()->route('AddShop')
            ->with('success', 'Shop updated successfully.')
            ->with('clear_form', true);
    }


    // DELETE
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return redirect()->route('AddShop')
            ->with('success', 'Shop deleted successfully.');
    }
}
