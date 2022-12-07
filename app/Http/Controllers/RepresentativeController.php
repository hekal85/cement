<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Itinerary;
use App\Models\Person;
use App\Models\Representative;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RepresentativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $representatives = Representative::all()->sortBy('name');
        return view('representatives.index', ['representatives' => $representatives]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data['states'] = City::orderBy('state')->distinct()->get(["state", "state_id"]);
        return view('representatives.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
        $person = Person::create($data);
        if($request->has('image')){
            $person->addMediaFromRequest('image')->toMediaCollection('image');
        }
        Representative::create(['id' => $person->id]);

        return redirect()->route('representative.index')->with(['process'=> 'تم إضافة', 'name' => $request->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Http\Response
     */
    public function show(Representative $representative) {
        return view('representatives.show', compact('representative'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Http\Response
     */
    public function edit(Representative $representative) {
        $states = City::orderBy('state_id')->distinct()->get(["state", "state_id"]);
        return view('representatives.edit', compact('representative', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Representative $representative) {
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
        //$data['state_id'] = City::whereSId($request->state)->first()->state;
        $person = Person::find($representative->id);
        $person->update($data);
        return redirect()->route('representative.index')->with(['process'=> 'تم تعديل بيانات المندوب: ', 'name' => $request->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Representative $representative) {
        $name = $representative->person->name;
        $id = $representative->id;
        $representative->delete();
        Person::find($id)->delete();
        return redirect()->route('representative.index')->with(['process'=> 'تم حذف المندوب بنجاح', 'name' => $name]);
    }


    public function itinerary_of_representative(Representative $representative)
    {
        return view('representatives.itinerary_of_representative', compact('representative'));
    }


}
