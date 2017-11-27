<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //


    /**
     * Get the weekly producer prices for this producer.
     */
    public function producers()
    {
        return $this->hasMany('App\Producer');
    }
}
