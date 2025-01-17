<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\ImportProductRequest;
use App\Http\Requests\Back\UpdateProductRequest;
use App\Http\Requests\Back\StoreProductRequest;
use App\Imports\ProductImport;
use App\Models\Categorie;
use App\Models\Locale;
use App\Models\Product;
use App\Services\PriceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    protected $priceService;

    public function __construct(PriceService $priceService)
    {
        $this->priceService = $priceService;
    }

    public function index(Request $request)
    {
        $locale = app()->getLocale();

        $query = Product::query()
            ->with("category")
            ->account();

        $filterMap = [
            "category" => fn($q, $val) => $q->whereHas(
                "category",
                fn($q) => $q->where("id", $val)
            ),
            "status" => fn($q, $val) => $q->where("status", $val == 2 ? 0 : 1),
            "price_filter" => fn($q, $val) => $q->orderBy(
                "price",
                $val === "big" ? "desc" : "asc"
            ),
        ];

        foreach ($filterMap as $key => $callback) {
            if ($request->has($key) && $request->$key) {
                $callback($query, $request->$key);
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

        $baseFields = ["name", "images", "price", "currency", "categorie_id"];

        $variantFields = [];
        for ($i = 1; $i <= 15; $i++) {
            $variantFields[] = "variant_name_{$i}";
            $variantFields[] = "variant_price_{$i}";
        }

        $modals = [
            "create" => array_merge(
                array_map(
                    fn($field) => "{$locale}_{$field}",
                    array_merge($baseFields, $variantFields)
                ),
                ["status"]
            ),
            "edit" => array_map(
                fn($field) => "update_{$field}",
                array_map(
                    fn($field) => "{$locale}_{$field}",
                    array_merge($baseFields, $variantFields)
                )
            ),
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
            compact("products", "categories", "modals", "locale")
        );
    }

    public function store(StoreProductRequest $request)
    {
        $images = $request->file("images") ?? [];

        $locales = Locale::query()
            ->account()
            ->pluck("language_code")
            ->toArray();

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

        $fields = [
            "name",
            "slug",
            "price",
            "currency",
            "contents",
            "allergens",
        ];

        $variants = array_merge(
            array_map(fn($i) => "variant_name_$i", range(1, 15)),
            array_map(fn($i) => "variant_price_$i", range(1, 15))
        );

        $data = [];
        $defaults = array_fill_keys($fields, null);

        $trData = [];
        foreach ($fields as $field) {
            $trData[$field] = $request->input("tr_{$field}");
        }

        $trSlug = $trData["slug"] ?: Str::slug($trData["name"]);

        $trVariants = [];
        foreach ($variants as $variant) {
            $value = $request->input("tr_{$variant}");
            if (!empty($value)) {
                $trVariants[$variant] = $value;
            }
        }

        foreach ($locales as $locale) {
            foreach ($fields as $field) {
                $value = $request->input("{$locale}_{$field}");

                if ($field === "slug") {
                    $data[$field][$locale] = $trSlug;
                } else {
                    $data[$field][$locale] = $value ?: $trData[$field];
                }
            }
        }

        foreach ($variants as $variant) {
            if (isset($trVariants[$variant])) {
                $data[$variant] = array_fill_keys(
                    $locales,
                    $trVariants[$variant]
                );
            }
        }

        Product::query()->create(
            array_merge($data, [
                "images" => json_encode($imagePaths),
                "status" => $request->status ? 1 : 0,
                "categorie_id" => $request->categorie_id,
                "account_id" => Auth::user()->account->id,
            ])
        );

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

        $images = $request->file("update_images") ?? [];
        $locales = Locale::query()
            ->account()
            ->pluck("language_code")
            ->toArray();

        $existingImages = json_decode($product->images, true) ?? [];
        $imagePaths = $existingImages;

        foreach ($images as $file) {
            if ($file->isValid()) {
                $file_name =
                    Str::slug(
                        $request->input(
                            "update_" . app()->getLocale() . "_name"
                        ) . uniqid()
                    ) .
                    "." .
                    $file->getClientOriginalExtension();
                Storage::putFileAs("products", $file, $file_name);
                $imagePaths[] = "products/" . $file_name;
            }
        }

        $fields = ["name", "price", "currency", "contents", "allergens"];
        $variants = array_merge(
            array_map(fn($i) => "variant_name_$i", range(1, 15)),
            array_map(fn($i) => "variant_price_$i", range(1, 15))
        );

        $data = [];
        $currentData = $product->toArray();

        foreach ($fields as $field) {
            $data[$field] = $currentData[$field];
        }

        $data["slug"] = $currentData["slug"] ?? array_fill_keys($locales, "");

        foreach ($locales as $locale) {
            foreach ($fields as $field) {
                $value = $request->input("update_{$locale}_{$field}");
                if ($value !== null) {
                    if (!isset($data[$field])) {
                        $data[$field] = [];
                    }
                    $data[$field][$locale] = $value;

                    if ($field === "name") {
                        $data["slug"][$locale] = Str::slug($value);
                    }
                }
            }
        }

        foreach ($variants as $variant) {
            if (isset($currentData[$variant])) {
                $data[$variant] = $currentData[$variant];
            }
        }

        foreach ($locales as $locale) {
            foreach ($variants as $variant) {
                $value = $request->input("update_{$locale}_{$variant}");
                if ($value !== null) {
                    if (str_contains($variant, "price")) {
                        $value = (float) $value;
                    }
                    if (!isset($data[$variant])) {
                        $data[$variant] = [];
                    }
                    $data[$variant][$locale] = $value;
                }
            }
        }

        $product->update(
            array_merge($data, [
                "images" => json_encode($imagePaths),
                "status" => $request->update_status ? 1 : 0,
                "categorie_id" => $request->update_categorie_id,
            ])
        );

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

        $prices = $product->getTranslations('price');
        


        if (!is_array($prices)) {
            $prices = []; 
        }
            
        $locale = app()->getLocale();
        $newPrice = $request->input("price");
            
        if ($newPrice) {
            $prices[$locale] = $newPrice;
        }

        $product->update([
            'price' => $prices
        ]);


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

        $names = json_decode($product->name, true) ?? [];
        $slugs = json_decode($product->slug, true) ?? [];

        $locale = app()->getLocale();
        $newName = $request->input("name");

        if ($newName) {
            $names[$locale] = $newName;
            $slugs[$locale] = Str::slug($newName);
        }

        $product->update([
            "name" => $names,
            "slug" => $slugs,
        ]);

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

        $updateParams = $this->getUpdateParameters($request);
        
        $products = Product::query()
            ->account()
            ->filterByCategories($request->input("categorie_ids", []))
            ->get();

        foreach ($products as $product) {
            // Update main price
            $product->price = $this->priceService->updatePrice(
                $product->price,
                $updateParams['updateType'],
                $updateParams['operationType'],
                $updateParams['value'],
                $updateParams['roundingOption'],
                $updateParams['roundingAmount']
            );

            // Update only non-empty variant prices
            foreach ($product->getVariantPriceFields() as $variantField) {
                $product->$variantField = $this->priceService->updatePrice(
                    $product->$variantField,
                    $updateParams['updateType'],
                    $updateParams['operationType'],
                    $updateParams['value'],
                    $updateParams['roundingOption'],
                    $updateParams['roundingAmount']
                );
            }

            $product->save();
        }


        return redirect()
            ->back()
            ->with("success", "Fiyatlar başarıyla güncellendi.");
    }


    private function getUpdateParameters(Request $request): array
    {
        return [
            'updateType' => $request->input("update_type"),
            'operationType' => $request->input("operation_type"),
            'value' => $request->input("dynamic_input"),
            'roundingOption' => $request->boolean("rounding_option"),
            'roundingAmount' => $request->input("rounding_amount"),
        ];
    }

    public function deleteImage(string $id)
    {
        $product = Product::query()->account()->findOrFail($id);
        
        $product->update([
            'images' => null
        ]);
        
        return redirect()->back()->with('success', 'Ürün resmi başarıyla silindi.');
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
