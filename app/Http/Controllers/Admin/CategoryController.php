<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withCount('publishedQuestion')->with('category')->get();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::doesntHave('category')->get();
        return view('admin.categories.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        unset($data['file']);

        if ($request->hasFile(('file'))) {
            $data['photo'] = Storage::disk('categories')->put('', $request->file('file'));
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'تم إضافة التنصيف بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::doesntHave('category')->get();
        return view('admin.categories.edit', ['category' => $category, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        unset($data['file']);

        if ($request->hasFile(('file'))) {
            $data['photo'] = Storage::disk('categories')->put('', $request->file('file'));
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'تم تعديل التنصيف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'تم حذف التنصيف بنجاح');
    }
}
