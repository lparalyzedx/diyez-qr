<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Back\StoreStoryRequest;
use App\Http\Requests\Back\UpdateStoryRequest;

class StoryController extends Controller
{
    public function index()
    {
        $modals = ['create' => ['name', 'slug'], 'edit' => ['update_name', 'update_slug']];
        return view('back.pages.stories.index', compact('modals'));
    }

    public function create()
    {
        return view('back.pages.stories.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoryRequest $request)
    {
        return redirect()->back()->with('success', 'Kategori başarıyla eklendi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoryRequest $request, string $id)
    {
        return redirect()->back()->with('success', 'Kategori başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->back()->with('success', 'Kategori başarıyla silindi.');
    }
}
