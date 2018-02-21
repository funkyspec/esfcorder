<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //not sure if order_id should be fillable
    protected $fillable = ['order_id', 'producerprice_id', 'quantity'];

    /**
     * Get the order for this line item.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }



    /**
     * Get the producer price for this line item.
     */
    public function producerPrice()
    {
        return $this->belongsTo('App\ProducerPrice', 'producerprice_id');
    }

    public function getMbrLinePriceAttribute() {
        return number_format(($this->quantity * $this->producerPrice->mbr_price), 2);
    }


}
