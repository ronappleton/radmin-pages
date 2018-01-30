<?php

namespace RonAppleton\Radmin\Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RonAppleton\Radmin\Pages\PageSnippetReader;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'name', 'content_header', 'content', 'version', 'page_slug'];

    public $appends = ['category_name', 'rendered_content'];

    public function getRenderedContentAttribute()
    {
        if(empty($this->attributes['content']))
        {
            return;
        }
        $value = $this->attributes['content'];

        $content = '';

        if (preg_match(PageSnippetReader::REGEX_PATTERN, $value, $matches)) {

            $content .= preg_replace_callback(PageSnippetReader::REGEX_PATTERN, function ($matches) use ($value) {
                return PageSnippetReader::handle($matches[1]);
            }, $value);
        }

        return empty($content) ? $value : $content;
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->category;
    }

    public function category()
    {
        return $this->hasOne(PageCategory::class, 'id', 'category_id');
    }

    public function scopePrepareForDataTable($query)
    {
        return $query->with('category')->select('id', 'name', 'category_id', 'updated_at', 'version', 'published');
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    public function scopeForCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeContentBySlug($query, $page_slug)
    {
        return $query->where('page_slug', $page_slug)->select('page_slug', 'content');
    }

    public function scopeContentByCategoryId($query, $category_id)
    {
        return $query->where('category_id', $category_id)->select('page_slug', 'content');
    }

    /**
     * Get the relationships for the entity.
     *
     * @return array
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
    }
}
