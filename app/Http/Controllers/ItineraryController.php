<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use App\Models\Itinerary;
use App\Models\ItineraryDetails;
use App\Models\Person;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itineraries = Itinerary::all();
        return view('itineraries.index', compact('itineraries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['states'] = City::orderBy('state_id')->distinct()->get(["state", "state_id"]);
        $data['representatives'] = Person::has('representative')->orderBy('name')->get(["name", "id"]);
        $data['days'] = [   'Saturday' => 'السبت', 'Sunday' => 'الأحد', 'Monday' => 'الإثنين', 'Tuesday' => 'الثلاثاء',
                            'Wednesday' => 'الأربعاء', 'Thursday' => 'الخميس', 'Friday' => 'الجمعة' ];
        return view('itineraries.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rep = $request->representative;

        $data = $request->validate([
            'representative_id' => 'required | integer | min:1',
            'name' => 'required | min:5',
            'day1' => 'required',
            'day2' => 'required',
            'notes' => 'nullable',
        ]);

        $itinerary = Itinerary::create($data);
        foreach ($request->city_id as $city){
            $details = ItineraryDetails::create(['itinerary_id' => $itinerary->id, 'city_id' => $city]);
           $persons = Person::whereHas('client',function ($q){
               $q->whereNull('itinerary_details_id');
           })->where(['city_id' => $city])->get();
           foreach ($persons as $person){
               $client = Client::find($person->id);
               $client->update(['itinerary_details_id' => $details->id]);
           }

          //  DB::enableQueryLog();
            //dd(\DB::getQueryLog());
         /*  $clients = Person::whereHas('client',function ($q) use ($rep){
                   $q->where('representative_id', $rep);
           })->whereCity($city)->orderBy('name')->get();

            foreach ($clients as $c){
                $client = Client::find($c->id);
                $client->update(['itinerary_details_id' => $rep]);
            }*/
        }

        return redirect()->route('itinerary.index')->with(['process'=> 'تم إضافة خط سير جديد وإضافة كل العملاء فى هذه المدن إلى المندوب']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function show(Itinerary $itinerary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function edit(Itinerary $itinerary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Itinerary $itinerary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Itinerary $itinerary)
    {
        //
    }
}
