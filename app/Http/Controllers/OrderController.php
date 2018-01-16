<?php

namespace App\Http\Controllers;

use App\Order;
use App\Offer;
use App\ProducerPrice;
use App\DisplayCategory;
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
    public function create($offer_id, $orderemail, $mbr)
    {
        //
        $offer = Offer::findOrFail($offer_id);

        $producerprices = ProducerPrice::where('offer_id', $offer_id)->with(['item', 'sellUnit', 'producer'])->get();
        $dispcats = DisplayCategory::whereIn('id', $producerprices->pluck('display_category_id'))->get();

        return view('orders.orderform', ['offer' => $offer, 'orderemail'=>$orderemail, 'mbr'=>$mbr, 'producerprices' => $producerprices, 'dispcats' => $dispcats]);
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
        //
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
