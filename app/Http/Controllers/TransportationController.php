<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Shipment;
use App\Models\ShipmentDetails;
use App\Models\Transportation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TransportationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $transportations = Transportation::all()->sortBy('name');
        return view('transportations.index', ['transportations' => $transportations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data['states'] = City::orderBy('state_id')->distinct()->get(['state', 'state_id']);
        return view('transportations.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required | min:3',
            'director' => 'required | min:5',
            'mobile' => 'required | min:11 | max:16',
            'phone' => 'nullable | min:7 | max:16',
            'email' => 'email | nullable',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'nullable',
            'cash' => 'required | integer | min:0 | max: 9999999',
        ]);

//$data['state_id'] = City::whereSId($request->state)->first()->state;
        $company = Company::create($data);

        $transportation = new Transportation(['id' => $company->id]);
        $transportation->save();

        return redirect()->route('transportation.index')->with(['success' => 'تم إضافة', 'name' => $request->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param Transportation $transportation
     * @return Response
     */
    public function show(Transportation $transportation)
    {
        return view('transportations.show', compact('transportation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transportation $transportation
     * @return Response
     */
    public function edit(Transportation $transportation)
    {
        $states = City::orderBy('state_id')->distinct()->get(['state', 'state_id']);
        return view('transportations.edit', compact('transportation', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transportation $transportation
     * @return Response
     */
    public function update(Request $request, Transportation $transportation)
    {
        $data = $request->validate([
            'name' => 'required | min:8',
            'email' => 'email | nullable',
            'mobile' => 'required | min:11 | max:16',
            'phone' => 'nullable',
            'director' => 'required | min:5',
            'cash' => 'required | integer | min:0 | max: 9999999',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'nullable',
            'notes' => 'min:5 | max: 200 | nullable',
        ]);
//$data['state_id'] = City::whereSId($request->state)->first()->state;
        $company = Company::find($transportation->id);
        $company->update($data);
        return redirect()->route('transportation.index')->with(['success' => 'تم تعديل بيانات الشركة: ', 'name' => $request->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transportation $transportation
     * @return Response
     */
    public function destroy(Transportation $transportation)
    {
//
    }

    public function transportation_movements($id)
    {
        $shipments = Shipment::whereTransportationId($id)->orderBy('id', 'DESC')->get();
        $transportation = Company::find($id)->name;
        return view('transportations.transportation_movements', compact('shipments', 'transportation'));
    }
}
