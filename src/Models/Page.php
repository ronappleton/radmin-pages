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
        return $query->with('category')->select('id', 'name', 'category_id', 'updated_at', 'created_at', 'version', 'published');
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
