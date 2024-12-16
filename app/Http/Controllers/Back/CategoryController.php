<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\ImportCategoryRequest;
use App\Http\Requests\Back\StoreCategoryRequest;
use App\Http\Requests\Back\UpdateCategoryRequest;
use App\Imports\CategorieImport;
use Illuminate\Support\Str;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categorie::query()->account()->withCount('products')->orderBy('order_id','asc')->get();

        $modals = ['create' => ['name','image','categorie_id'],'edit' => ['update_name','update_image','update_categorie_id'],'import' => ['xlsx']];

        return view('back.pages.categories.index',compact('categories','modals'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        $image = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = Str::slug($request->name . uniqid()) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('categories', $file, $file_name);
            $image = 'categories/' . $file_name;
        }

        Categorie::query()->create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $image,
            'status' => $request->status ? 1 : 0,
            'categorie_id' => $request->categorie_id == 0 ? null : $request->categorie_id,
            'width' => intval($request->width),
            'account_id' => $request->user()->account->id
        ]);

        return redirect()->back()->with('success','Kategori başarıyla eklendi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $category = Categorie::query()->account()->where('id',$id)->first();

       return response()->json([
         'category' => $category
       ],200);
    }
    
    
    public function json()
    {
       $categories = Categorie::query()->account()->get();

       return response()->json([
         'categories' => $categories
       ],200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Categorie::query()->account()->where('id',$id)->firstOrFail();

        $image = $category->image;

        if ($request->hasFile('update_image')) {
            $file = $request->file('update_image');
            $file_name = Str::slug($request->update_name . uniqid()) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('categories', $file, $file_name);
            $image = 'categories/' . $file_name;
        }

        $category->update([
            'name' => $request->update_name,
            'slug' => Str::slug($request->update_name),
            'image' => $image,
            'status' => $request->update_status ? 1 : 0,
            'categorie_id' => ($request->update_categorie_id == 0 ? null : ($request->update_categorie_id != $category->id ? $request->update_categorie_id : null)),
            'width' => intval($request->update_width)
        ]);

        return redirect()->back()->with('success','Kategori başarıyla güncellendi.');
    }

     /**
     * Listing the specified resource from database.
     */

    public function list()
    {
        $categories = Categorie::query()->account()->with('childs')->where('categorie_id',NULL)->orderBy('order_id','asc')->withCount('products')->get();
        return view('back.pages.categories.list',compact('categories'));
    }

     /**
     * Sorting the specified resource from database.
     */

    public function sort(Request $request)
    {
       $categories = Categorie::query()->account()->get();
        foreach ($categories as $categorie) {
           foreach ($request->order as $order) {
              if ($order['id'] == $categorie->id) {
                 $categorie->update(['order_id' => $order['position']]);
              }
            }
        }

        return response()->json([
            'status' => true
        ],200);
    }

    /**
     * Sorting the specified resource from database.
     */

    public function sorting(Request $request)
    {
        $data = $request->input('categories');
    
        $this->updateSort($data);
        
        return response()->json(['success' => true]);
    }

    /**
     * Sorting the specified save from database.
     */

    private function updateSort($categories, $parentId = null, $position = 0)
    {
        foreach ($categories as $category) {
            
            Categorie::query()->account()->where('id', $category['id'])->update([
                'categorie_id' => $parentId,
                'order_id' => $position
            ]);
    
            
            if (!empty($category['children'])) {
                $this->updateSort($category['children'], $category['id'], $position + 1);
            }
    
            $position++;
        }
    }

    public function updateName(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Categorie::query()->account()->findOrFail($id);
        $category->name = $request->input('name');
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Kategori adı başarıyla güncellendi.',
            'category' => $category
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|in:0,1',
        ]);

        $category = Categorie::query()->account()->findOrFail($id);
        $category->status = $request->input('status');
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Kategori durumu başarıyla güncellendi.'
        ]);
    }

    public function import(ImportCategoryRequest $request)
    {
        Excel::import(new CategorieImport, $request->file('xlsx'));
        return back()->with('success', 'Excel dosyası başarıyla içe aktarıldı!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categorie::query()->account()->where('id',$id)->firstOrFail();
        
        if($category->childs->isNotEmpty() || $category->products->isNotEmpty())
        {
            return redirect()->back()->withErrors(['warning' => 'Kategori içinde ürün veya kategoriler var.']);
        }
        
        $category->delete();
        return redirect()->back()->with('success','Kategori başarıyla silindi.');
    }
}
