<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProducerPrice extends Model
{
    //

    /**
     * Get the item for this producer price.
     */
    public function item()
    {
        return $this->belongsTo('App\Item');
    }


    /**
     * Get the unit for this producer price.
     */
    public function sellUnit()
    {
        return $this->belongsTo('App\Unit', 'sell_unit_id');
    }

    /**
     * Get the producer for this producer price.
     */
    public function producer()
    {
        return $this->belongsTo('App\Producer');
    }

    /**
     * Get the offer for this producer price.
     */
    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }

    /**
     * Get the display category for this producer price.
     */
    public function displayCategory()
    {
        return $this->belongsTo('App\DisplayCategory');
    }

    /**
     * Get the line items for this producer price.
     */
    public function lineItems()
    {
        return $this->hasMany('App\LineItem', 'producerprice_id');
    }



}
