<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['offer_id', 'email', 'mbr_status', 'name', 'phone', 'pickup_option', 'customernote', 'internalnote'];

    /* *
     * Get the user that owns the order.

    public function user()
    {
        return $this->belongsTo('App\User');
    }
     */

    /**
     * Get the fulfillment status for the order. May need to delete
     */
    public function fulfillment()
    {
        return $this->belongsTo('App\Fulfillment');
    }

    /**
     * Get the line items for this order.
     */
    public function lineItems()
    {
        return $this->hasMany('App\LineItem');
    }

    /**
    * Get the offer related to this order.
    */
   public function offer()
   {
       return $this->belongsTo('App\Offer');
   }

}
