<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Offer;
use App\DisplayCategory;
use App\LineItem;
use App\ProducerPrice;
use App\User;
use App\Order;
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

            $producerprices = ProducerPrice::where('offer_id', $offer->id)->join('items', 'items.id', '=', 'producer_prices.item_id')
            ->orderBy('items.name')
            ->get();

            /* $producerprices = ProducerPrice::where('offer_id', $offer->id)->with(['item'=> function ($q) {
                $q->orderBy('name');
              }])->get(); */

            $dispcats = DisplayCategory::whereIn('id', $producerprices->pluck('display_category_id'))->get();

            return view('offers.latest', ['offer' => $offer, 'producerprices' => $producerprices, 'dispcats' => $dispcats, 'wrongEmail' => 0]);

        } else {

            $offer = Offer::orderBy('pickup_date', 'desc')->first();

            return redirect("offers/$offer->id");
            /*
            $producerprices = ProducerPrice::where('offer_id', $offer->id)->with(['item', 'sellUnit', 'producer'])->get();
            $dispcats = DisplayCategory::whereIn('id', $producerprices->pluck('display_category_id'))->get();

            return view('offers.offer', ['offer' => $offer, 'producerprices' => $producerprices, 'dispcats' => $dispcats]);
            */
        }
    }

    public function checkMember(Request $request)
    {
        //need to use proper user/role ACL but for now do simple

        $validatedEmail = $request->validate([
            'orderEmail' => 'bail|required|email',
        ], ['email' => 'Your email address must be in proper email address format: xxxx@xxxx.xxx']);

        $orderEmail = $request->input('orderEmail');

        $offerId = $request->input('offer_id');

        $esfcMbr = User::where('email', $orderEmail)->where('role_id', '<=', 3)->first();

        if($esfcMbr) {
            //set member status to member
            $mbr = 1;
            session(['customername' => $esfcMbr->name]);
            session(['orderemail' => $orderEmail]);
            session(['mbr' => $mbr]);

        return redirect("orders/create/$offerId");
        } else {
            //set member status to non
            $mbr = 0;
            /* return view("offers.checkemailagain", ['offerId' => $offerId, 'entemail'=>$orderEmail]); */

            return redirect()->back()->withInput();
        }

        /* session(['orderemail' => $orderEmail]);
        session(['mbr' => $mbr]);

        return redirect("orders/create/$offerId"); */

    }

    //need show method for displaying previous weeks' offers
    //use standard laravel resource/CRUD conventions

    //show offer - display orders placed for this offer - if active display link to edit item availability

    public function show($id)
    {
        // get offer and orders for this offer

        $offer = Offer::findOrFail($id);

        $orders = Order::where('offer_id', $id)->with('lineItems.producerPrice.item')->get();

        return view('offers.order', ['offer'=>$offer, 'orders'=>$orders]);


    }

    public function producerTotal($id)
    {
        // show all items ordered for this offer, by producer

        $offer = Offer::findOrFail($id);

        $orders = Order::where('offer_id', $id)->get();

        $orderIds = $orders->pluck('id');

        $producerPrices = ProducerPrice::with(['producer', 'item'])->where('offer_id', $id)->get();

        //$lineItems = LineItem::


        return view('offers.producer', ['offer'=>$offer, 'orders'=>$orders, 'producerPrices' => $producerPrices]);

    }
}
