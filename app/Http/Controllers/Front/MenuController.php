<?php

namespace App\Http\Controllers\Front;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function index(string $slug, Request $request)
    {
        $account = Account::query()->where('slug',$slug)->firstOrFail();
        
        $search = $request->get('search');

    if (!empty($search)) {
        $products = Product::query()->where('account_id',$account->id)->where('name', 'like', '%' . $search . '%')->get();
        return view('front.pages.search',compact('products'));
    }

        
        return view('front.pages.index');
    }

    public function category(string $accountSlug, string $slug)
{
    $account = Account::query()->where('slug', $accountSlug)->firstOrFail();
    
    if(!$account->status)
    {
        return redirect()->route('menu',$accountSlug);
    }
    
    try {
        $categorie = Categorie::query()
            ->where('account_id', $account->id)
            ->where('slug', $slug)
            ->where('status', 1)
            ->with(['products' => function($query) {
                $query->where('status', 1)
                      ->orderBy('order_id', 'asc');
            }])
            ->firstOrFail();
        
        UserActivity::create([
            'account_id' => $account->id,
            'category_id' => $categorie->id,
            'viewed_at' => now()
        ]);
        
        return view('front.pages.category', compact('account', 'categorie'));
    } catch (ModelNotFoundException $exception) {
        return redirect()->route('menu', ['accountSlug' => $accountSlug])
            ->with('error', 'Kategoriye erişilemedi.');
    }
}

}
