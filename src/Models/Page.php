<?php

namespace RonAppleton\Radmin\Pages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'name', 'content_header', 'content', 'version', 'page_slug'];

    public $appends = ['category_name'];

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
        return $query->with('category')->select('id', 'name', 'category_id', 'updated_at', 'version', 'published', 'page_slug');
    }

    public function scopePageVersions($query, $page_slug)
    {
        return $query->where('page_slug', $page_slug)->orderBy('version', 'DESC');
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
