<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Driver;
use App\Models\Person;
use App\Models\Transportation;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::all()->sortBy('name');
        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['states'] = City::orderBy('state_id')->distinct()->get(["state", "state_id"]);
        $data['transportations'] = Company::has('Transportation')->orderBy('name')->distinct()->get(["name", "id"]);
        return view('drivers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required | min:3',
            'mobile' => 'required | min:11 | max:16',
            'phone' => 'nullable | min:7 | max:16',
            'email' => 'email | nullable',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'nullable | min:3',
            'cash' => 'required | integer | min:0 | max: 9999999',
            'notes' => 'min:5 | max: 200 | nullable',
        ]);
        $request->validate(['transportation_id' => 'required | integer | min:1']);
       // $data['state_id'] = City::whereSId($request->state)->first()->state;
        $person = Person::create($data);

        if($request->has('image')){
            $person->addMediaFromRequest('image')->toMediaCollection('image');
        }
        Driver::create(['id' => $person->id, 'transportation_id' => $request->transportation_id]);

        return redirect()->route('driver.index')->with(['process'=> 'تم إضافة السائق: ', 'name' => $request->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        $states = City::orderBy('state_id')->distinct()->get(["state", "state_id"]);
        $transportations = Company::has('Transportation')->orderBy('name')->distinct()->get(["name", "id"]);
        return view('drivers.edit', compact('driver', 'states', 'transportations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'name' => 'required | min:3',
            'mobile' => 'required | min:11 | max:16',
            'phone' => 'nullable | min:7 | max:16',
            'email' => 'email | nullable',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'nullable | min:3',
            'cash' => 'required | integer | min:0 | max: 9999999',
            'notes' => 'min:5 | max: 200 | nullable',
        ]);
       // $data['state_id'] = City::whereSId($request->state)->first()->state;
        $person = Person::find($driver->id);
        $person->update($data);
        $person = Driver::find($driver->id);
        $person->update(['transportation_id' => $request->transportation_id]);
        return redirect()->route('driver.index')->with(['process'=> 'تم تعديل بيانات السائق: ', 'name' => $request->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $name = $driver->person->name;
        $id = $driver->id;
        $driver->delete();
        Person::find($id)->delete();
        return redirect()->route('driver.index')->with(['process'=> 'تم حذف السائق بنجاح', 'name' => $name]);
    }
}
