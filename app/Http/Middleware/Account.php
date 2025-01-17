<?php

namespace App\Http\Middleware;

use App\Models\Account as ModelsAccount;
use App\Models\Categorie;
use App\Models\Locale as ModelsLocale;
use Closure;
use Illuminate\Http\Request;
use Locale;
use Symfony\Component\HttpFoundation\Response;

class Account
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accountSlug = $request->route("accountSlug");

        $account = ModelsAccount::query()
            ->where("slug", $accountSlug)
            ->first();

        if (!$account) {
            return redirect()->to("https://diyezmenu.com");
        }

        $locales = ModelsLocale::query()->where('account_id',$account->id)->where('status',true)->get();

        $categories = Categorie::query()
            ->where("account_id", $account->id)
            ->where("status", 1)
            ->where(function ($query) {
                $query
                    ->whereHas("products", function ($subQuery) {
                        $subQuery
                            ->where("status", 1)
                            ->orderBy("order_id", "asc");
                    })
                    ->orWhereHas("childs");
            })
            ->with([
                "products" => function ($subQuery) {
                    $subQuery->where("status", 1)->orderBy("order_id", "asc");
                },
                "childs" => function ($subQuery) {
                    $subQuery->where("status", 1)->orderBy("order_id", "asc");
                },
            ])
            ->orderBy("order_id", "asc")
            ->get();

        if (!$account->status) {
            $categories = [];
        }

        view()->share("account", $account);
        view()->share("categories", $categories);
        view()->share("locales",$locales);

        return $next($request);
    }
}
