<?php

namespace RonAppleton\Radmin\Pages\Http\Controllers;

use RonAppleton\Radmin\Pages\Models\PageCategory;
use RonAppleton\Radmin\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageCategoryController extends Controller
{
    /**
     * Display a listing of the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('radmin-pages::page-category.index');
    }

    /**
     * Show the form for creating a new resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('radmin-pages::page-category.create');
    }

    /**
     * Store a newly created resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|string|max:125|unique:page_categories,category'
        ]);

        PageCategory::create([
            'category' => $request->category
        ]);

        return view('radmin-pages::page-category.index');
    }

    /**
     * Display the specified resources.
     *
     * @param  \RonAppleton\Radmin\Pages\Models\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PageCategory $pageCategory)
    {
        $model = $pageCategory;
        return view('radmin-pages::page-category.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resources.
     *
     * @param  \RonAppleton\Radmin\Pages\Models\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PageCategory $pageCategory)
    {
        $model = $pageCategory;
        return view('radmin-pages::page-category.edit', compact('model'));
    }

    /**
     * Update the specified resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \RonAppleton\Radmin\Pages\Models\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageCategory $pageCategory)
    {
        $this->validate($request, [
            'category' => 'required|string|max:125|unique:page_categories,category'
        ]);

        $pageCategory->update(['category' => $request->category]);

        return view('radmin-pages::page-category.index');
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param  \RonAppleton\Radmin\Pages\Models\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageCategory $pageCategory)
    {
        $model = $pageCategory;
        $model->delete();
    }
}
