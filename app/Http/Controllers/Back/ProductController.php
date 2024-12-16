<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\ImportProductRequest;
use App\Http\Requests\Back\UpdateProductRequest;
use App\Http\Requests\Back\StoreProductRequest;
use App\Imports\ProductImport;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()
            ->with("category")
            ->account();

        if ($request->has("category") && $request->category) {
            $query->whereHas("category", function ($q) use ($request) {
                $q->where("id", $request->category);
            });
        }

        if ($request->has("status") && $request->status) {
            $query->where("status", $request->status == 2 ? 0 : 1);
        }

        if ($request->has("price_filter") && $request->price_filter) {
            $priceFilter = $request->price_filter;

            switch ($priceFilter) {
                case "big":
                    $query->orderBy("price", "desc");
                    break;
                case "small":
                    $query->orderBy("price", "asc");
                    break;
            }
        }

        $products = $query->orderBy("order_id", "asc")->get();

        $categories = Categorie::query()
            ->account()
            ->where("status", 1)
            ->where("categorie_id", null)
            ->orderBy("order_id", "asc")
            ->with("childs")
            ->get();
        $modals = [
            "create" => [
                "name",
                "images",
                "price",
                "currency",
                "variant_name_1",
                "variant_price_1",
                "variant_name_2",
                "variant_price_2",
                "variant_name_3",
                "variant_price_3",
                "variant_name_4",
                "variant_price_4",
                "variant_name_5",
                "variant_price_5",
                "categorie_id",
            ],
            "edit" => [
                "update_name",
                "update_images",
                "update_price",
                "update_currency",
                "update_variant_name_1",
                "update_variant_price_1",
                "update_variant_name_2",
                "update_variant_price_2",
                "update_variant_name_3",
                "update_variant_price_3",
                "update_variant_name_4",
                "update_variant_price_4",
                "update_variant_name_5",
                "update_variant_price_5",
                "update_categorie_id",
            ],
            "import" => ["xlsx"],
            "update_prices" => [
                "update_type",
                "operation_type",
                "dynamic_input",
                "categorie_ids",
                "rounding_option",
                "rounding_amount",
            ],
        ];

        return view(
            "back.pages.products.index",
            compact("products", "categories", "modals")
        );
    }

    public function store(StoreProductRequest $request)
    {
        $images = $request->file("images") ?? [];
        $imagePaths = [];

        foreach ($images as $file) {
            if ($file->isValid()) {
                $file_name =
                    Str::slug($request->name . uniqid()) .
                    "." .
                    $file->getClientOriginalExtension();
                Storage::putFileAs("products", $file, $file_name);
                $imagePaths[] = "products/" . $file_name;
            }
        }

        Product::query()->create([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
            "contents" => $request->contents,
            "allergens" => $request->allergens,
            "images" => json_encode($imagePaths),
            "price" => $request->price,
            "currency" => $request->currency,
            "variant_name_1" => $request->variant_name_1,
            "variant_price_1" => $request->variant_price_1,
            "variant_name_2" => $request->variant_name_2,
            "variant_price_2" => $request->variant_price_2,
            "variant_name_3" => $request->variant_name_3,
            "variant_price_3" => $request->variant_price_3,
            "variant_name_4" => $request->variant_name_4,
            "variant_price_4" => $request->variant_price_4,
            "variant_name_5" => $request->variant_name_5,
            "variant_price_5" => $request->variant_price_5,
            "variant_name_6" => $request->variant_name_6,
            "variant_price_6" => $request->variant_price_6,
            "variant_name_7" => $request->variant_name_7,
            "variant_price_7" => $request->variant_price_7,
            "variant_name_8" => $request->variant_name_8,
            "variant_price_8" => $request->variant_price_8,
            "variant_name_9" => $request->variant_name_9,
            "variant_price_9" => $request->variant_price_9,
            "variant_name_10" => $request->variant_name_10,
            "variant_price_10" => $request->variant_price_10,
            "variant_name_11" => $request->variant_name_11,
            "variant_price_11" => $request->variant_price_11,
            "variant_name_12" => $request->variant_name_12,
            "variant_price_12" => $request->variant_price_12,
            "variant_name_13" => $request->variant_name_13,
            "variant_price_13" => $request->variant_price_13,
            "variant_name_14" => $request->variant_name_14,
            "variant_price_14" => $request->variant_price_14,
            "variant_name_15" => $request->variant_name_15,
            "variant_price_15" => $request->variant_price_15,
            "status" => $request->status ? 1 : 0,
            "categorie_id" => $request->categorie_id,
            "account_id" => Auth::user()->account->id
        ]);

        return redirect()
            ->back()
            ->with("success", "Ürün başarıyla eklendi.");
    }

    public function show(string $id)
    {
        $product = Product::query()
            ->account()
            ->where("id", $id)
            ->first();
        return response()->json(
            [
                "product" => $product,
            ],
            200
        );
    }

    public function list(int $id)
    {
        $categorie = Categorie::query()
            ->account()
            ->where("id", $id)
            ->firstOrFail();
        $products = Product::query()
            ->account()
            ->where("categorie_id", $categorie->id)
            ->orderBy("order_id", "asc")
            ->get();

        return view(
            "back.pages.products.list",
            compact("categorie", "products")
        );
    }

    public function sorting(Request $request)
    {
        $data = $request->input("products");

        $this->updateSort($data);

        return response()->json(["success" => true]);
    }

    private function updateSort($products, $position = 0)
    {
        foreach ($products as $product) {
            Product::query()
                ->account()
                ->where("id", $product["id"])
                ->update([
                    "order_id" => $position,
                ]);

            $position++;
        }
    }

    public function update(string $id, UpdateProductRequest $request)
    {
        $product = Product::query()
            ->account()
            ->where("id", $id)
            ->firstOrFail();
        $images = $product->images;
        $imagePaths = [];

        $updateImages = $request->file("update_images");

        if ($updateImages) {
            foreach ($updateImages as $file) {
                if ($file->isValid()) {
                    $file_name =
                        Str::slug($request->name . uniqid()) .
                        "." .
                        $file->getClientOriginalExtension();
                    Storage::putFileAs("products", $file, $file_name);
                    $imagePaths[] = "products/" . $file_name;
                }
            }
        }

        $product->update([
            "name" => $request->update_name,
            "slug" => Str::slug($request->update_name),
            "contents" => $request->update_contents,
            "allergens" => $request->update_allergens,
            "images" => count($imagePaths) > 0 ? json_encode($imagePaths) : $images,
            "price" => $request->update_price,
            "currency" => $request->update_currency,
            "variant_name_1" => $request->update_variant_name_1,
            "variant_price_1" => $request->update_variant_price_1,
            "variant_name_2" => $request->update_variant_name_2,
            "variant_price_2" => $request->update_variant_price_2,
            "variant_name_3" => $request->update_variant_name_3,
            "variant_price_3" => $request->update_variant_price_3,
            "variant_name_4" => $request->update_variant_name_4,
            "variant_price_4" => $request->update_variant_price_4,
            "variant_name_5" => $request->update_variant_name_5,
            "variant_price_5" => $request->update_variant_price_5,
            "variant_name_6" => $request->update_variant_name_6,
            "variant_price_6" => $request->update_variant_price_6,
            "variant_name_7" => $request->update_variant_name_7,
            "variant_price_7" => $request->update_variant_price_7,
            "variant_name_8" => $request->update_variant_name_8,
            "variant_price_8" => $request->update_variant_price_8,
            "variant_name_9" => $request->update_variant_name_9,
            "variant_price_9" => $request->update_variant_price_9,
            "variant_name_10" => $request->update_variant_name_10,
            "variant_price_10" => $request->update_variant_price_10,
            "variant_name_11" => $request->update_variant_name_11,
            "variant_price_11" => $request->update_variant_price_11,
            "variant_name_12" => $request->update_variant_name_12,
            "variant_price_12" => $request->update_variant_price_12,
            "variant_name_13" => $request->update_variant_name_13,
            "variant_price_13" => $request->update_variant_price_13,
            "variant_name_14" => $request->update_variant_name_14,
            "variant_price_14" => $request->update_variant_price_14,
            "variant_name_15" => $request->update_variant_name_15,
            "variant_price_15" => $request->update_variant_price_15,
            "status" => $request->update_status ? 1 : 0,
            "categorie_id" => $request->update_categorie_id
        ]);

        return redirect()
            ->back()
            ->with("success", "Ürün başarıyla güncellendi.");
    }

    public function sort(Request $request)
    {
        $products = Product::query()
            ->account()
            ->get();
        foreach ($products as $product) {
            foreach ($request->order as $order) {
                if ($order["id"] == $product->id) {
                    $product->update(["order_id" => $order["position"]]);
                }
            }
        }
    }

    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            "price" => "required|numeric|min:0",
        ]);

        $product = Product::query()
            ->account()
            ->findOrFail($id);

        $product->price = $request->input("price");
        $product->save();

        return response()->json([
            "success" => true,
            "message" => "Fiyat başarıyla güncellendi.",
            "product" => $product,
        ]);
    }

    public function updateName(Request $request, $id)
    {
        $request->validate([
            "name" => "required|string|max:255",
        ]);

        $product = Product::query()
            ->account()
            ->findOrFail($id);
        $product->name = $request->input("name");
        $product->save();

        return response()->json([
            "success" => true,
            "message" => "Ürün adı başarıyla güncellendi.",
            "product" => $product,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            "status" => "required|integer|in:0,1",
        ]);

        $product = Product::query()
            ->account()
            ->findOrFail($id);
        $product->status = $request->input("status");
        $product->save();

        return response()->json([
            "success" => true,
            "message" => "Ürün durumu başarıyla güncellendi.",
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        $product = Product::query()
            ->account()
            ->findOrFail($id);
        $category = Categorie::query()
            ->account()
            ->where("id", $request->category_id)
            ->firstOrFail();
        $product->update([
            "categorie_id" => $category->id,
        ]);

        return response()->json([
            "success" => true,
            "category" => $category,
        ]);
    }

    public function import(ImportProductRequest $request)
    {

        Excel::import(new ProductImport(), $request->file("xlsx"));

        return back()->with(
            "success",
            "Excel dosyası başarıyla içe aktarıldı!"
        );
    }

    public function updatePrices(Request $request)
    {
        $request->validate([
            "update_type" => "required|in:amount,percentage",
            "operation_type" => "required|in:increase,decrease",
            "dynamic_input" => "required|numeric|min:0",
            "categorie_ids" => "nullable|array",
            "categorie_ids.*" => "exists:categories,id",
            "rounding_option" => "nullable",
            "rounding_amount" => "nullable|numeric|min:0",
        ]);

        $updateType = $request->input("update_type");
        $operationType = $request->input("operation_type");
        $value = $request->input("dynamic_input");
        $categoryIds = $request->input("categorie_ids", []);
        $roundingOption = $request->boolean("rounding_option");
        $roundingAmount = $request->input("rounding_amount");

        $query = Product::query()->account();
        if (!empty($categoryIds)) {
            $query->whereIn("categorie_id", $categoryIds);
        }

        $products = $query->get();

        foreach ($products as $product) {
            $originalPrice = $product->price;

            if ($updateType === "amount") {
                $adjustedPrice =
                    $operationType === "increase"
                        ? $originalPrice + $value
                        : $originalPrice - $value;
            } elseif ($updateType === "percentage") {
                $adjustedPrice =
                    $operationType === "increase"
                        ? $originalPrice * (1 + $value / 100)
                        : $originalPrice * (1 - $value / 100);
            }

            if ($roundingOption && $roundingAmount > 0) {
                $adjustedPrice =
                    round($adjustedPrice / $roundingAmount) * $roundingAmount;
            }

            $product->price = max($adjustedPrice, 0);

            for ($i = 1; $i <= 15; $i++) {
                $variantPriceField = "variant_price_$i";

                if (!is_null($product->$variantPriceField)) {
                    $originalVariantPrice = $product->$variantPriceField;

                    if ($updateType === "amount") {
                        $adjustedVariantPrice =
                            $operationType === "increase"
                                ? $originalVariantPrice + $value
                                : $originalVariantPrice - $value;
                    } elseif ($updateType === "percentage") {
                        $adjustedVariantPrice =
                            $operationType === "increase"
                                ? $originalVariantPrice * (1 + $value / 100)
                                : $originalVariantPrice * (1 - $value / 100);
                    }

                    if ($roundingOption && $roundingAmount > 0) {
                        $adjustedVariantPrice =
                            round($adjustedVariantPrice / $roundingAmount) *
                            $roundingAmount;
                    }

                    $product->$variantPriceField = max(
                        $adjustedVariantPrice,
                        0
                    );
                }
            }

            $product->save();
        }

        return redirect()
            ->back()
            ->with("success", "Fiyatlar başarıyla güncellendi.");
    }

    public function destroy(string $id)
    {
        $product = Product::query()
            ->account()
            ->where("id", $id)
            ->firstOrFail();
        $product->delete();

        return redirect()
            ->back()
            ->with("success", "Ürün başarıyla silindi.");
    }
}
