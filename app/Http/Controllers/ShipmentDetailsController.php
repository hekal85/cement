<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Person;
use App\Models\Shipment;
use App\Models\ShipmentDetails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class ShipmentDetailsController extends Controller
{
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
    public function create(Request $request)
    {
        $representatives = Person::has('representative')->orderBy('name')->get(["name", "id"]);
        $id = $request->input('id');
        $shipment = Shipment::whereId($id)->get();
        return view('shipment_details.create', compact('shipment', 'representatives'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tons' => 'required | integer | min:0 | max:120',
            'sacks' => 'required | integer | min:0 | max:19',
        ]);
        $payload = $request->sacks + $request->tons * 20;
        $remaining = $request->remaining - $payload;
        if($remaining < 0){
            return back()->with(['process'=> 'الكمية على الشاحنة أقل من الكمية التى أدخلتها']);
        }

        $data = $request->validate([
            'shipment_id' => 'required | integer | min:1',
            'representative_id' => 'required | integer | min:1',
            'client_id' => 'required | integer | min:1',
            'cost' => 'required | integer | min:100 | max:99999',
            'total' => 'required | between:0,999999.99 | max:99999',
            'paid' => 'required | integer | min:0 | max:99999',
            'owed' => 'required | between:0,999999.99 | max:99999',
            'notes' => 'nullable',
            'discount' => 'required | integer | min:0 | max:99999',
            'transportation' => 'required | integer | min:0 | max:99999',
            'created_at' => 'nullable | date',
        ]);

        $total = ($request->tons * $request->cost) + ($request->sacks * $request->cost / 20);
        $data['total'] = $total;
        $data['remaining'] = $remaining;
        $data['payload'] = $payload;
        $data['owed'] = $total - $data['paid'] - $data['discount'] - $data['transportation'];

        $details = ShipmentDetails::create($data);
        $shipment = Shipment::find($details->shipment_id);
        $shipment->decrement('remaining',$payload);

        // Change status of the shipment
        if($shipment->remaining == 0)
            $shipment->increment('done');

        // calculate debit of client
        Person::find($details->client_id)->increment('cash',$details->owed);
        /*
         * Hekal is Here
         * اثبات المدفوعات لشركة النقل
         * خصم المبلغ من خزينة الشركة
         */

        return redirect()->route('shipment.index')->with([
            'process'=>
                ' تم إثبات تشوين كمية: ' .$request->tons. ' طن و '.$request->sacks. ' شيكارة '.
                ' للعميل: '. Person::find($request->client_id)->name .
                ' بالشحنة رقم: ' . $details->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShipmentDetails  $shipmentDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ShipmentDetails $shipmentDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShipmentDetails  $shipmentDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipmentDetails $shipmentDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShipmentDetails  $shipmentDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipmentDetails $shipmentDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShipmentDetails  $shipmentDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipmentDetails $shipmentDetails) {
        // test
    }

    public function last100(ShipmentDetails $shipmentDetails)
    {
        $details = ShipmentDetails::latest()->take(5)->get();
        return view('shipment_details.last100', compact('details'));
    }
}
