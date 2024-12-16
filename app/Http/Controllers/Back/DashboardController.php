<?php

namespace App\Http\Controllers\Back;

use App\Models\Market;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Categorie;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->roles->first()->name;

        switch ($role) {
            case 'root':
                return $this->root();
                break;
            default:
                return $this->admin();
                break;
        }
    }

    public function root()
    {
        $totalAccountCount = Account::query()->count();
        $totalCategoryCount = Categorie::query()->count();
        $totalProductCount = Product::query()->count();
        return view('back.pages.dashboard.index',compact('totalAccountCount','totalCategoryCount','totalProductCount'));
    }

    public function admin()
    {
       $startDate = request()->input('start');
       $endDate = request()->get('end');

       $startDate = $startDate ? Carbon::parse($startDate) : null;
       $endDate = $endDate ? Carbon::parse($endDate) : null;

       $totalCategoryCount = Categorie::query()->account()->count();
       $totalProductCount = Product::query()->account()->count();

       $today = Carbon::today();
       $yesterday = Carbon::yesterday();
       $startOfWeek = Carbon::today()->startOfWeek();
       $endOfWeek = Carbon::today()->endOfWeek();
       $startOfLastWeek = $startOfWeek->copy()->subWeek();
       $endOfLastWeek = $endOfWeek->copy()->subWeek();
       $startOfMonth = Carbon::today()->startOfMonth();
       $endOfMonth = Carbon::today()->endOfMonth();
       $startOfLastMonth = $startOfMonth->copy()->subMonth();
       $endOfLastMonth = $endOfMonth->copy()->subMonth();

       $userActivityQuery = UserActivity::query()->account();

       if ($startDate && $endDate) {
           $userActivityQuery->whereBetween('viewed_at', [$startDate, $endDate]);
       } elseif ($startDate) {
           $userActivityQuery->where('viewed_at', '>=', $startDate);
       } elseif ($endDate) {
           $userActivityQuery->where('viewed_at', '<=', $endDate);
       }

      $todayViews = $userActivityQuery->clone()->whereDate('viewed_at', $today)->count();
      $yesterdayViews = $userActivityQuery->clone()->whereDate('viewed_at', $yesterday)->count();
      $weeklyViews = $userActivityQuery->clone()->whereBetween('viewed_at', [$startOfWeek, $endOfWeek])->count();
      $lastWeekViews = $userActivityQuery->clone()->whereBetween('viewed_at', [$startOfLastWeek, $endOfLastWeek])->count();
      $monthlyViews = $userActivityQuery->clone()->whereBetween('viewed_at', [$startOfMonth, $endOfMonth])->count();
      $lastMonthViews = $userActivityQuery->clone()->whereBetween('viewed_at', [$startOfLastMonth, $endOfLastMonth])->count();

      $todayChange = $todayViews - $yesterdayViews;
      $weeklyChange = $weeklyViews - $lastWeekViews;
      $monthlyChange = $monthlyViews - $lastMonthViews;

      $categoryViews = $userActivityQuery->select('category_id', DB::raw('count(*) as total_views'))
      ->groupBy('category_id')
      ->orderBy('total_views', 'desc')
      ->get();

      $categoryViews = $categoryViews->map(function ($item) {
      $categoryName = Categorie::query()->account()->find($item->category_id)->name ?? 'Unknown';
        return [
          $categoryName => $item->total_views
        ];
     });

     $formattedItems = [];
    foreach ($categoryViews as $item) {
        foreach ($item as $key => $value) {
              $formattedItems[$key] = $value;
        }
    }

        return view('back.pages.dashboard.index',compact('totalCategoryCount','totalProductCount','todayViews', 'yesterdayViews','todayChange','weeklyViews','weeklyChange','monthlyViews','monthlyChange','formattedItems'));
    }
}
