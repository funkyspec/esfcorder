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
}
