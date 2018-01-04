<?php

namespace RonAppleton\Radmin\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    protected $fillable = ['category'];
    //

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
