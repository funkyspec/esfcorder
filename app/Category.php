<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    /**
     * Get the items in this category.
     */
    public function items()
    {
        return $this->hasMany('App\Item');
    }

    /**
     * Get the child categories for this category.
     */
    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    /**
     * Get the parent category for this category.
     */
    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }
}
