<?php

namespace App\Http\Controllers;

use App\Offer;
use App\DisplayCategory;
use App\ProducerPrice;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Show the profile for the given offer.
     *
     * @param  int  $id
     * @return Response
     */
    public function available($id)
    {
        $offer = Offer::findOrFail($id);
        $dispcats = DisplayCategory::whereHas('producerPrices', function ($query) {
            $query ->where('offer_id', 1);
            })->get();

        $producerprices = ProducerPrice::where('offer_id', $id)->with('item')->get();
        return view('offer', ['offer' => $offer, 'producerprices' => $producerprices, 'dispcats' => $dispcats]);
    }
}
