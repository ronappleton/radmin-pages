<?php

namespace RonAppleton\Radmin\Pages\Http\Controllers;

use RonAppleton\Radmin\Pages\Models\Page;
use RonAppleton\Radmin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RonAppleton\Radmin\Pages\Models\PageCategory;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    public function handle($page)
    {
        $pageToShow = Page::where('page_slug', $page)->orderBy('version', 'DESC')->first();

        if(empty($pageToShow))
        {
            throw new NotFoundHttpException();
        }

        return $this->show($pageToShow);
    }
    /**
     * Display a listing of the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('radmin-pages::page.index');
    }

    /**
     * Show the form for creating a new resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PageCategory::pluck('category', 'id');

        return view('radmin-pages::page.create', compact('categories'));
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
           'category' => 'required|integer',
           'title' => 'required|string|max:125',
            'content_header' => 'string|max:1024|nullable',
            'name' => 'required|string|max:125',
            'content' => 'required|string'
        ]);

        $version = $this->getVersion($request);

        if($version != -1)
        {
            $page = new Page();
            $page->fill($request->toArray());
            $page->category_id = $request->category;
            $page->version = $version;
            $page->save();
        }

        return view('radmin-pages::page.index');
    }

    /**
     * Display the specified resources.
     *
     * @param  \RonAppleton\Radmin\Pages\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        $model = $page;

        $layout = config("radmin-pages.page.{$model->page_slug}");

        if(empty($layout))
        {
            $category = strtolower($model->category()->category);
            $layout = config("radmin-pages.page_category.{$category}");
        }

        if(empty($layout))
        {
            $layout = config('radmin-pages.frontendLayout', 'layouts.master');
        }

        return view('radmin-pages::page.show', compact('model', 'layout'));
    }

    /**
     * Show the form for editing the specified resources.
     *
     * @param  \RonAppleton\Radmin\Pages\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $model = $page;
        $categories = PageCategory::pluck('category', 'id');

        return view('radmin-pages::page.edit', compact('model', 'categories'));
    }

    /**
     * Update the specified resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \RonAppleton\Radmin\Pages\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $this->validate($request, [
            'page_slug' => 'required|string',
            'category' => 'required|integer',
            'title' => 'required|string|max:125',
            'content_header' => 'string|max:1024|nullable',
            'name' => 'required|string|max:125',
            'content' => 'required|string'
        ]);

        $version = $this->getVersion($request);

        if($version != -1)
        {
            $page->version = $version;
        }

        $page->save();

        return view('radmin-pages::page.index');
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param  \RonAppleton\Radmin\Pages\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }

    private function getVersion(Request $request)
    {
        $existing = Page::where('name', $request->name)->orderBy('version', 'DESC')->first();

        //If it doesnt exist, we need to save it.
        if(empty($existing)) {
            return 0;
        }

        //If it does exist we need to check something has changed before saving
        if($request->category == $existing->category_id &&
            $request->title == $existing->title &&
            $request->content_header == $existing->content_header &&
            $request->name == $existing->name &&
            $request->content == $existing->content &&
            $request->page_slug == $existing->page_slug)
        {
            return -1;
        }
        return $existing->version + 1;
    }
}
