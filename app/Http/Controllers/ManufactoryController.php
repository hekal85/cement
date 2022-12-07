<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Manufactory;
use Illuminate\Http\Request;

class ManufactoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufactories = Manufactory::all()->sortBy('name');
        return view('manufactories.index', ['manufactories' => $manufactories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['states'] = City::orderBy('state')->distinct()->get(["state", "state_id"]);
        return view('manufactories.create', $data);
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
            'director' => 'required | min:5',
            'mobile' => 'required | min:11 | max:16',
            'phone' => 'nullable | min:7 | max:16',
            'address' => 'nullable',
            'email' => 'email | nullable',
            'state_id' => 'required',
            'city_id' => 'required',
            'cash' => 'required | integer | min:0 | max: 9999999',
        ]);
       // $data['state_id'] = City::whereSId($request->state)->first()->state;
        $company = Company::create($data);

        $manufactory = new Manufactory(['id' => $company->id]);
        $manufactory->save();
        return redirect()->route('manufactory.index')->with(['process'=> 'تم إضافة مصنع: ', 'name' => $request->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manufactory  $Manufactory
     * @return \Illuminate\Http\Response
     */
    public function show(Manufactory $Manufactory)
    {
        return view('manufactories.show', compact('Manufactory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manufactory  $Manufactory
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufactory $Manufactory)
    {
        $states = City::orderBy('state_id')->distinct()->get(["state", "state_id"]);
        return view('manufactories.edit', compact('Manufactory', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manufactory  $Manufactory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufactory $Manufactory)
    {
        $data = $request->validate([
            'name' => 'required | min:3',
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
       // $data['state_id'] = City::whereSId($request->state)->first()->state;
        $company = Company::find($Manufactory->id);
        $company->update($data);
        return redirect()->route('manufactory.index')->with(['process'=> 'تم تعديل بيانات المصنع: ', 'name' => $request->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufactory  $Manufactory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufactory $Manufactory)
    {
        //
    }
}
