<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fulfillment extends Model
{
    //


    /**
     * Get the orders for the fulfillment status.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }


}
