<?php
/**
 * Created by PhpStorm.
 * User: ron
 * Date: 1/30/18
 * Time: 1:39 AM
 */

namespace RonAppleton\Radmin\Pages;


use RonAppleton\Radmin\Pages\Models\Page;
use RonAppleton\Radmin\Pages\Models\PageCategory;

class PageSnippetReader
{
    /**
     * snippet syntax = *[page:category]* / *[page:about-us]* / *[page:product-112]* etcetera
     */
    const REGEX_PATTERN = '/.*?\*\[(.+?)\]\*.*?/';

    public static function handle($snippet)
    {
        $snippet = str_replace(['page:'], '', $snippet);

        $parts = explode(':', $snippet);

        $category = self::getCategory($parts[0]);

        if(!empty($category))
        {
            $pages = self::getPagesByCategory($category->id);

            return self::getContents($pages);
        }

        $pages = self::getPages($parts);

        $content = self::getContents($pages);

        return $content;
    }

    private static function getCategory($category)
    {
        if(is_numeric($category))
        {
            return PageCategory::find($category);
        }

        return PageCategory::where('category', $category)->first();
    }

    private static function getPages($page_slugs)
    {
        $pages = [];

        foreach($page_slugs as $page_slug)
        {
            $pages[] = self::getSinglePageContent($page_slug);
        }

        return $pages;
    }

    private static function getSinglePageContent($page_slug)
    {
        return Page::contentBySlug($page_slug)->first();
    }

    private static function getPagesByCategory($category_id)
    {
        return Page::contentByCategoryId($category_id)->published()->get();
    }

    private static function getContents($pages)
    {
        $contents = '';

        foreach($pages as $page)
        {
            $contents .= $page->content;
        }

        return $contents;
    }
}