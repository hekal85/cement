<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Models\Bond;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\Itinerary;
use App\Models\ItineraryDetails;
use App\Models\Person;
use App\Models\Representative;
use App\Models\ShipmentDetails;
use App\Models\Transportation;
use Carbon\Carbon;
use DB;

use App\Models\City;
use Illuminate\Http\Request;


//DB::enableQueryLog(); dd(\DB::getQueryLog());

class HekalController extends Controller
{
    public function index(){
        $cities = City::where('state_id', 1)->orderBy('city')->get(["city", "id"]);
        dd($cities);
    }
    public function create(){}
    public function store(Request $request){}
    public function show($id){}
    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}

    public function couponsOfTransportation(Request $request) {
        $coupons = Coupon::where([
            "transportation_id" => $request->transportation,
            "packed" => $request->packed,
            "cement_type_id" => $request->cement,
            "used" => 0
        ])->orderBy('coupon')->get();
        return response()->json($coupons);
    }

    public function fetch_cities(Request $request) {
        $cities = City::where("state_id", $request->state_id)->orderBy('city')->get(["city", "id"]);
        return response()->json($cities);
    }

    public function clients_by_city(Request $request) {
        $clients = Person::has('client')->where("city", $request->city)->orderBy('name')->get(["name", "id"]);
        return response()->json($clients);
    }

    public function ClientsOfRepresentative(Request $request) {
        $rep = $_POST['id'];
        $clients = Client::where(['representative_id' => $rep])->get();
        $data = '';
        foreach ($clients as $c):
            $data.= "<option value='".$c->id."'>".$c->person->name."</option>";
        endforeach;
        return response()->json(['clients' => $data]);
    }

    public function ajaxGetClients (Request $request) {
        $rep = $_GET['clients'];
        $clients = Client::where(['representative_id' => $rep])->get();
        if (empty($clients))
            return false;

        $data = '';
        $no=1;
        $representative = '';
        foreach ($clients as $client):
            $representative  = $client->representative->person->name;
            $name = $client->person->name;
            $city = $client->person->city->city;
            $cash = $client->person->cash;

            $data.= "
            <tr>
                <th scope='row'>".$no++."</th>
                <td>$name</td>
                <td>$city</td>
                <td>$cash</td>
            </tr>";
        endforeach;
        return response()->json(['data' => $data, 'representative' => $representative]);
    }

    public function ClientsOfItinerary (Request $request) {
        $id = $_GET['itinerary'];
        $details = ItineraryDetails::where(['itinerary_id' => $id])->get();
        if (empty($details))
            return false;
        $representative = $details[0]->Itinerary->representative->person->name;
        $itinerary = $details[0]->Itinerary->name;
        $data = '';
        $no=1;
        foreach ($details as $d):
            foreach ($d->Client as $clients)
            $client = $clients->Person->name;
            $cash = $d->Itinerary->Representative->Person->cash;
            $city = $d->City->city;

            $data.= "
            <tr>
                <th scope='row'>".$no++."</th>
                <td>$client</td>
                <td>$city</td>
                <td>$cash</td>
            </tr>";
        endforeach;
        return response()->json(['data' => $data, 'representative' => $representative, 'itinerary' => $itinerary ]);
    }

    public function personBonds (Request $request) {
        $person = $_GET['person'];
        $bonds = Bond::where(['person_id' => $person])->orderByDesc('created_at')->get();
        $data = '';
        $no=1;
        $deposits = 0;
        $benefits = 0;
        foreach ($bonds as $bond):
            $name = $bond->person->name;
            $amount = $bond->amount;
            $created_at = $bond->created_at;
            $days = Carbon::now()->diffInDays($created_at);
            $benefit = round($days * 0.15 * $bond->amount / 365.25);
            $deposits += $amount;
            $benefits += $benefit;
            $active = @$bond->active ? 'نشط' : 'تم التسوية';
            $notes = $bond->notes;
            $data.= "
            <tr>
                <th scope='row'>$no</th>
                <th>$amount</th>
                <th>$created_at</th>
                <th>$days</th>
                <th>$benefit</th>
                <th>$active</th>
                <th>$notes</th>
            </tr>";
            $no++;
        endforeach;
        return response()->json(['data' => $data, 'name' => $name, 'deposits' => $deposits, 'benefits' => $benefits]);
    }

    public function GetClientsOFShipment (Request $request) {
        $shipment_id = $_GET['shipment'];
        $ShipmentDetails = ShipmentDetails::where(['shipment_id' => $shipment_id])->get();
        $shipment = '';
        $data = '';
        $no=1;
        foreach ($ShipmentDetails as $details):
            $client  = $details->client->person->name;
            $tons = (int)($details->payload / 20);
            $sacks  = $details->payload % 20;
            $cost  = $details->cost;
            $total  = $details->total;
            $discount  = $details->discount;
            $transportation  = $details->transportation;
            $paid  = $details->paid;
            $owed = $details->owed;
            $created_at = $details->created_at;
            $notes  = $details->notes;
            $shipment  = $details->shipment_id;
            $data.= "
            <tr>
                <th scope='row'>".$no++."</th>
                <td>$client</td>
                <td>$tons</td>
                <td>$sacks</td>
                <td>$cost</td>
                <td>$total</td>
                <td>$discount</td>
                <td>$transportation</td>
                <td>$paid</td>
                <td>$owed</td>
                <td>$created_at</td>
                <td>$notes</td>
            </tr>";
        endforeach;
        return response()->json(['data' => $data, 'shipment' => $shipment]);
    }

    public function ajaxGetCoupons (Request $request) {
        $id = $_GET['clients'];
        $coupons = Coupon::where(['transportation_id' => $id])->get();
        $data = '';
        $no=1;
        foreach ($coupons as $coupon):
            $transportation  = $coupon->transportation->company->name;
            $manufactory  = $coupon->manufactory->company->name;
            $created = $coupon->created_at;
            $value = $coupon->value;
            $coupon = $coupon->coupon;

            $data.= "
            <tr>
                <th scope='row'>".$no++."</th>
                <td>$manufactory</td>
                <td>$transportation</td>
                <td>$coupon</td>
                <td>$value</td>
                <td>$created</td>
            </tr>";
        endforeach;
        return response()->json(['data' => $data, 'transportation' => $transportation]);
    }

    public function test(){
        $representative = Representative::find(1);
        return view ('hekal.test', compact('representative'));
    }

    public function client_movements($id) {
        $shipmentDetails = ShipmentDetails::whereClientId(['shipment_id' => $id])->get();
        $client = Person::find($id)->get('name')->first();
        return view('clients.client_movements', compact('shipmentDetails', 'client'));
    }

    public function itinerary_collecting($id){
        $details = ItineraryDetails::where(['itinerary_id' => $id])->get();
        $rep_name = $details[0]->Itinerary->representative->person->name;
        $itr_name = $details[0]->Itinerary->name;
        return view('itineraries.itinerary_collecting', compact('rep_name', 'details', 'itr_name'));
    }

}

