<?php

namespace App\Http\Controllers;

use App\Order;
use App\Offer;
use App\ProducerPrice;
use App\DisplayCategory;
use App\LineItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    /**
     * First step of ordering online - check membership
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function startOrder()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($offer_id)
    {
        //
        $offer = Offer::findOrFail($offer_id);

        if($offer->active_flag == 1) {
            $producerprices = ProducerPrice::where('offer_id', $offer_id)->with(['item', 'sellUnit', 'producer'])->get();
            $dispcats = DisplayCategory::whereIn('id', $producerprices->pluck('display_category_id'))->get();

            return view('orders.orderform', ['offer' => $offer, 'producerprices' => $producerprices, 'dispcats' => $dispcats]);
        } else {
            return redirect("offers/$offer_id");

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        //create new order record
        //create related line item records



       $neworder = Order::create(['offer_id'=>request('offer_id'), 'email'=>request('order_email'), 'mbr_status'=>session('mbr'), 'name'=>request('customer_name'), 'phone'=>request('phone'),  'pickup_option'=>request('pickup_option'), 'customernote'=>request('customer_note')]);

       //do while there are non-0 request items
       //dd($neworder->id);
       foreach ($request->except(['_token', 'offer_id', 'order_email', 'customer_name', 'phone', 'pickup_option', 'customer_note']) as $key => $val) {
           if($val > 0) {
           LineItem::create(['order_id'=>$neworder->id, 'producerprice_id'=>$key, 'quantity' => $val]);
           }
       }

       $lineItems = LineItem::where('order_id', $neworder->id)->with('producerPrice.item')->get();

       $orderTotal = 0;
       foreach($lineItems as $lineItem) {
           if( session('mbr') == 1) {
               if (isset($lineItem->producerPrice->mbr_price)) {
                $lineprice = $lineItem->producerPrice->mbr_price * $lineItem->quantity;
               } else {
                $lineprice = 0;
               }
           } else {
            if (isset($lineItem->producerPrice->non_mbr_price)) {
                $lineprice = $lineItem->producerPrice->non_mbr_price * $lineItem->quantity;
               } else {
                $lineprice = 0;
               }
           }

           $orderTotal += $lineprice;
       }


       return view('orders.confirm', ['order' => $neworder, 'lineItems'=> $lineItems, 'orderTotal' => $orderTotal]);
    }

     /**
     * Confirm a recently created order
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm()
    {
        $email = session('orderemail');
        //check if session order email set
        if($email != null) {
            $order = Order::find(request('order_id'));
            $order->order_status = 'Confirmed';
            $order->save();
            return view('orders.thanks');
        } else {
            return view('welcome');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
        $email = session('orderemail');
        //check if session order email set
        if($email != null) {
            $offer = Offer::findOrFail($order->offer_id);
            $lineItems = LineItem::where('order_id', $order->id)->get();
            $producerprices = ProducerPrice::where('offer_id', $offer->id)->with(['item', 'sellUnit', 'producer'])->get();
            $dispcats = DisplayCategory::whereIn('id', $producerprices->pluck('display_category_id'))->get();

            return view('orders.editorder', ['order'=>$order, 'offer'=>$offer, 'lineItems'=>$lineItems,'producerprices' => $producerprices, 'dispcats' => $dispcats]);
        } else {
            //return latest offer?? or home page
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //retrieve lineItems for this order
        //change lineItems quantities if different (consider deleting 0 quant lineItems)
        //add new lineItems to order
        // return confirmation page view
        $lineItems = LineItem::where('order_id', $order->id)->get();

        //case for member

        foreach ($request->except(['_token', 'offer_id', 'phone', 'pickup_option', 'customer_note']) as $key => $val) {
            //check to see if lineitem exists for this key
            //if yes, update line item, if no create
            if($val > 0) {
                //update line item

            } else {
                LineItem::create(['order_id'=>$neworder->id, 'producerprice_id'=>$key, 'quantity' => $val]);
            }
        }




        //case for non-member

        foreach ($request->except(['_token', 'offer_id', 'order_email', 'customer_name', 'phone', 'pickup_option', 'customer_note']) as $key => $val) {
            if($val > 0) {
            LineItem::create(['order_id'=>$neworder->id, 'producerprice_id'=>$key, 'quantity' => $val]);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
