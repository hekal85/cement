<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use App\Models\Person;
use App\Models\Representative;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class ClientController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $clients = Client::all();
        return view('clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data['states'] = City::orderBy('state_id')->distinct()->get(["state", "state_id"]);
        $data['representatives'] = Person::has('representative')->orderBy('name')->get(["name", "id"]);
        return view('clients.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([ 'representative' => 'required | integer | min:1' ]);
        $representative = $request->representative;
        $data = $request->validate([
            'name' => 'required | min:8',
            'mobile' => 'required | min:11 | max:16',
            'email' => 'email | nullable',
            'state_id' => 'required',
            'city_id' => 'required',
            'cash' => 'required | integer | min:0 | max: 9999999',
            'address' => 'nullable | min:3',
            'notes' => 'min:5 | max: 200 | nullable',
        ]);
        //$data['state_id'] = City::whereSId($request->state)->first()->state;
        $person = Person::create($data);
        if($request->has('image')){
            $person->addMediaFromRequest('image')->toMediaCollection('image');
        }
        $client = new Client(['id' => $person->id, 'representative_id' => $representative]);
        $client->save();

        return redirect()->route('client.index')->with(['process'=> 'تم إضافة العميل: ', 'name' => $request->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client) {
        $states = City::orderBy('state_id')->distinct()->get(["state", "state_id"]);
        $representatives = Person::has('representative')->orderBy('name')->get(["name", "id"]);
        return view('clients.edit', compact('client', 'states', 'representatives'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client) {
        $request->validate([ 'representative' => 'required | integer | min:1' ]);
        $data = $request->validate([
            'name' => 'required | min:5',
            'mobile' => 'required | min:11',
            'email' => 'email | nullable',
            'state_id' => 'required',
            'city_id' => 'required',
            'cash' => 'required | integer | min:0 | max: 9999999',
            'address' => 'nullable | min:3',
            'notes' => 'min:5 | max: 200 | nullable',
        ]);
        //$data['state_id'] = City::whereSId($request->state)->first()->state;
        Person::find($client->id)->update($data);
        Client::find($client->id)->update(['representative_id' => $request->representative]);
        return redirect()->route('client.index')->with(['process'=> 'تم تعديل بيانات العميل : ', 'name' => $request->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client) {
        $name = $client->person->name;
        $id = $client->id;
        $client->delete();
        Person::find($id)->delete();
        return redirect()->route('client.index')->with(['process'=> 'تم حذف العميل', 'name' => $name]);
    }

}
