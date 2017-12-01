<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //


    /**
     * Get the producers in this state
     */
    public function producers()
    {
        return $this->hasMany('App\Producer');
    }
}
