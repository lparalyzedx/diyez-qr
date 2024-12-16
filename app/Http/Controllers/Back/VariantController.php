<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\StoreVariantRequest;
use App\Http\Requests\Back\UpdateVariantRequest;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index(int $productID)
    {
        $product = Product::query()->account()->where('id',$productID)->firstOrFail();
        $variants = Variant::query()->where('product_id',$productID)->get();
        $modals = ['create' => ['size', 'price'], 'edit' => ['update_size', 'update_price']];

        return view('back.pages.products.variant',compact('product','variants','modals'));
    }

    public function store(int $productID, StoreVariantRequest $request)
    {
        $product = Product::query()->account()->where('id',$productID)->firstOrFail();

        Variant::query()->create([
            'size' => $request->size,
            'price' => $request->price,
            'product_id' => $product->id
        ]);

        return redirect()->back()->with(['success' => 'Varyant başarıyla eklendi.']);
    }

    public function show(int $productID, int $variantID)
    {
        $product = Product::query()->account()->where('id',$productID)->firstOrFail();
        $variant = Variant::query()->where('product_id',$product->id)->where('id',$variantID)->first();

        return response()->json([
            'variant' => $variant
        ],200);
    }

    public function update(int $productID, int $variantID, UpdateVariantRequest $request)
    {
        $product = Product::query()->account()->where('id',$productID)->firstOrFail();
        $variant = Variant::query()->where('product_id',$product->id)->where('id',$variantID)->firstOrFail();

        $variant->update([
            'size' => $request->update_size,
            'price' => $request->update_price,
            'stock' => $request->update_stock
        ]);

        return redirect()->back()->with(['success' => 'Varyant başarıyla güncellendi.']);
    }

    public function destroy(int $productID, int $variantID)
    {
        $product = Product::query()->account()->where('id',$productID)->firstOrFail();
        $variant = Variant::query()->where('product_id',$product->id)->where('id',$variantID)->firstOrFail();
        $variant->delete();

        return redirect()->back()->with(['success' => 'Varyant başarıyla silindi.']);
    }
}
