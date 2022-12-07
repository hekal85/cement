<?php

namespace App\Http\Controllers;

use App\Models\CementType;
use App\Models\Company;
use App\Models\Coupon;
use App\Models\Person;
use App\Models\Shipment;
use App\Models\ShipmentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['shipments'] = Shipment::all()->sortByDesc('created_at');
        $data['manufactories'] = Company::has('manufactory')->orderBy('name')->get(["name", "id"]);
        $data['transportations'] = Company::has('transportation')->orderBy('name')->get(["name", "id"]);
        return view('shipments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['manufactories'] = Company::has('manufactory')->orderBy('name')->get(["name", "id"]);
        $data['transportations'] = Company::has('transportation')->orderBy('name')->get(["name", "id"]);
        $data['drivers'] = Person::has('driver')->orderBy('name')->get(["name", "id"]);
        $data['representatives'] = Person::has('representative')->orderBy('name')->get(["name", "id"]);
        $data['cement_types'] = CementType::orderBy('name')->get(["name", "id"]);
        return view('shipments.create', $data);
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
            'tons' => 'required | integer | min:0 | max: 120',
            'sacks' => 'required | integer | min:0 | max: 19',
            'coupons.*' => 'required | distinct',
            ]);

        $data = $request->validate([
            'manufactory_id' => 'required | integer | min:1 | max: 100',
            'transportation_id' => 'required |integer |  min:1 | max: 200',
            'created_at' => 'nullable | date',
            'driver' => 'required |integer |  min:1',
            'trans' => 'required | integer | min:0 ',
            'notes' => 'nullable',
        ]);

        $payload = $request->sacks + $request->tons * 20;
        $data['payload'] = $payload;
        $data['remaining'] = $payload;

        foreach ($request->coupons as $cost){
            $cop = Coupon::find($cost);
            if($cop->used == 1)
                return redirect()->route('shipment.create')->with(['process'=> 'البون تم استخدامه من قبل: ' . $cop->used]);
            $data['cost'] = $cop->cost;
            $data['notes'] .= "\n". $cop->coupon .' : '. $cop->value.'طن بـ: '. $cop->cost;
        }

        $data['total'] =  $request->trans * $request->tons + $data['cost'] * ($request->tons + ($request->sacks / 20));
        //$total = $request->trans * ($request->tons + ($request->sacks / 20)) + $request->cost * ($request->tons + ($request->sacks / 20));
        //$data['total'] = $total;

        $shipment = Shipment::create($data);
        foreach ($request->coupons as $coupon)
           DB::table('coupons')->where('id', $coupon)->update(['shipment_id' => $shipment->id, 'used' => 1]);
        return redirect()->route('shipment.index')->with(['process'=> 'تم إثبات تحميل السيارة التى تحمل الشحنة رقم: ' . $shipment->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        //DB::enableQueryLog();dd(DB::getQueryLog());
        $shipment_details = ShipmentDetails::where(['shipment_id' => $shipment->id])->get();
        return view('shipments.show',compact('shipment_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipment $shipment)
    {
        //
    }
}
