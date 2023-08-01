<?php

namespace App\Admin\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsStockController extends Controller
{
    public function updateStockdetails(Request $request)
    {
        $request->validate([
            'price' => 'required|min:1',
            'available_stock_qty' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->available_stock_qty = $request->available_stock_qty;
        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', "Successfully updated product details");
    }
}
