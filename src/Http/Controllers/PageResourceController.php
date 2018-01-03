<?php

namespace RonAppleton\Radmin\Pages\Http\Controllers;

use RonAppleton\Radmin\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use RonAppleton\Radmin\Pages\Models\PageCategory;
use RonAppleton\Radmin\Pages\Models\Page;
use Yajra\DataTables\Facades\DataTables;

class PageResourceController extends Controller
{
    public function handle($resource)
    {
        if(method_exists($this, $resource))
        {
            return $this->$resource();
        }

        throw new NotFoundHttpException();
    }

    private function pageCategoriesAll()
    {
        $pageCategories = PageCategory::orderBy('category', 'ASC')->get();
        return DataTables::collection($pageCategories)
            ->addColumn('action', function ($pageCategory) {
                $url = route('users.edit', $pageCategory->id);
                return "<a href=\"$url\" class=\"btn btn-xs btn-primary\"><i class=\"glyphicon glyphicon-edit\"></i> Edit</a>";
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    private function pagesAll()
    {
        $pages = Page::orderBy('name', 'ASC')->get();
        return DataTables::collection($pages)
            ->addColumn('action', function ($page) {
                $url = route('users.edit', $page->id);
                return "<a href=\"$url\" class=\"btn btn-xs btn-primary\"><i class=\"glyphicon glyphicon-edit\"></i> Edit</a>";
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }
}