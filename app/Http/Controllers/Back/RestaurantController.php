<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\StoreRestaurantRequest;
use App\Http\Requests\Back\UpdateRestaurantRequest;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $modals = ['create' => ['name','slug'],'edit' => ['update_name','update_slug']];
        return view('back.pages.restaurant.index',compact('modals'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {

        return redirect()->back()->with('success','Restaurant başarıyla eklendi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

       
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, string $id)
    {

        return redirect()->back()->with('success','Restaurant başarıyla güncellendi.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        return redirect()->back()->with('success','Restaurant başarıyla silindi.');
    }
}
