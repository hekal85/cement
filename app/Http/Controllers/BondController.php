<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use App\Models\Person;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BondController extends Controller
{
    public function __construct(){
       // UPDATE `bonds` SET `days`=DATEDIFF(now(), created_at);
      //  Bond::whereActive(1)->update(['days' => "DATEDIFF(now(),`created_at`)"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $bonds = Bond::selectRaw('person_id, sum(amount) as sum, count(*) no')
        ->groupBy('person_id')->get();
        return view('bonds.index', ['bonds' => $bonds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shareholders = Person::has('shareholder')->orderBy('name')->get(["name", "id"]);
        return view('bonds.create', compact('shareholders'));
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
            'person_id' => 'required | integer | min:1 | max:99',
            'amount' => 'required | min:3 | max:8',
            'created_at' => 'required',
        ]);
        $bond= Bond::create($data);
        $shareholder = Person::find($request->person_id)->name;
        return redirect()->route('bond.index')->with(['process'=> 'تم إثبات عملية استلام '.  $request->amount. ' من ', 'name' => $shareholder]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function show(Bond $bond)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function edit(Bond $bond)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bond $bond)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bond $bond)
    {
        //
    }

    public function funds_movement(Bond $bond)
    {
        $bonds = Bond::all()->sortByDesc('id');
        return view('bonds.funds_movement', compact('bonds'));
    }
    // withdraw
    public function withdraw()
    {
        $shareholders = Person::has('shareholder')->orderBy('name')->get(["name", "id"]);
        if (sizeof($shareholders) >= 0){
            return redirect()->route('client.index');
        }else{
            dd(sizeof($shareholders));
            return view('bonds.withdraw', compact('shareholders'));
        }
    }

    // Get Bonds of the chosen shareholder
    public function shareholder_bonds(Request $request) {
        $id = $_POST['id'];
        $name = Person::find($id)->name;
        $bonds = Bond::where(['person_id' => $id])->get();
        $no=1;
        $total = 0;
        $benefits = 0;
        $data = '';
        foreach ($bonds as $bond):
            $days = Carbon::now()->diffInDays($bond->created_at);
            $benefit = round($days * 0.15 * $bond->amount / 365.25);
            $total += $bond->amount;
            $benefits += $benefit;
            $active = ($bond->active == 1) ? 'نشط' : 'تم التسوية';
            $data.= "<tr>";
            $data.= "<td>".$no++."</td>";
            $data.= "<td>$bond->amount</td>";
            $data.= "<td>$days</td>";
            $data.= "<td>$benefit</td>";
            $data.= "<td>$bond->created_at</td>";
            $data.= "<td>$active</td>";
            $data.= "<td>$bond->notes</td>";
            $data.= "</tr>";
        endforeach;
        return response()->json(['bonds' => $data, 'name' => $name, 'total' => $total, 'benefits' => $benefits]);

    }
}
