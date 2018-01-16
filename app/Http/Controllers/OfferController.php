<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Offer;
use App\DisplayCategory;
use App\ProducerPrice;
use App\User;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Show the profile for the given offer.
     * Need to change this method name to conventional resource/CRUD
     * @param  int  $id
     * @return Response
     */

    //this method is not good anymore - modify and use it for show method
    public function available($id)
    {
        $offer = Offer::findOrFail($id);
        $producerprices = ProducerPrice::where('offer_id', $id)->with(['item', 'sellUnit', 'producer'])->get();
        $dispcats = DisplayCategory::whereIn('id', $producerprices->pluck('display_category_id'))->get();

        return view('offer', ['offer' => $offer, 'producerprices' => $producerprices, 'dispcats' => $dispcats]);
    }

    public function latest()
    {
        $offer = Offer::where('active_flag', 1)->orderBy('pickup_date', 'desc')->first();

        if (!empty($offer)) {

            $producerprices = ProducerPrice::where('offer_id', $offer->id)->with(['item', 'sellUnit', 'producer'])->get();
            $dispcats = DisplayCategory::whereIn('id', $producerprices->pluck('display_category_id'))->get();

            return view('offers.latest', ['offer' => $offer, 'producerprices' => $producerprices, 'dispcats' => $dispcats]);

        } else {

            $offer = Offer::orderBy('pickup_date', 'desc')->first();

            $producerprices = ProducerPrice::where('offer_id', $offer->id)->with(['item', 'sellUnit', 'producer'])->get();
            $dispcats = DisplayCategory::whereIn('id', $producerprices->pluck('display_category_id'))->get();

            return view('offers.offer', ['offer' => $offer, 'producerprices' => $producerprices, 'dispcats' => $dispcats]);
        }
    }

    public function checkMember(Request $request) {
        //need to use proper user/role ACL but for now do simple

        $orderEmail = $request->input('orderEmail');

        $offerId = $request->input('offer_id');

        $esfcEmail = User::where('email', $orderEmail)->where('role_id', '<=', 3)->first();

        if($esfcEmail) {
            //set member status to member
            $mbr = 1;
        } else {
            //set member status to non
            $mbr = 0;
        }

        return redirect("order/create/$offerId/$orderEmail/$mbr");

    }

    //need show method for displaying previous weeks' offers
    //use standard laravel resource/CRUD conventions
}
