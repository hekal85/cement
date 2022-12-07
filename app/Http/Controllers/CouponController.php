<?php

namespace App\Http\Controllers;

use App\Models\CementType;
use App\Models\Company;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Component\Console\Input\Input;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all()->sortByDesc('created_at');
        return view('coupons.index', ['coupons' => $coupons]);
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
        $data['cement_types'] = CementType::orderBy('name')->get(["name", "id"]);
        return view('coupons.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cops = $request->input('coupon');
        $textAr = explode("\r\n", trim($cops));
        $coupons = array_filter($textAr, 'trim');


        $request->validate([
            'value' => 'required | integer | min:5 | max: 200',
            'manufactory' => 'required | integer | min:1',
            'cement_type_id' => 'required | integer | min:1',
            'transportation' => 'required | integer | min:1',
            'coupon' => 'required | min:1',
            'packed' => 'required | integer | min:0 | max:1',
            'cost' => 'required | integer | min:100 | max:3000',
        ]);

        foreach ($coupons as $cop) {
            $exist = Coupon::firstWhere('coupon', $cop);
            if ($exist !== null)
                return back()->with(['process'=> 'البون موجود بالفعل: ', 'duplicated' => $cop]);
            else{
                $coupon = new Coupon;
                $coupon->coupon         = $cop;
                $coupon->manufactory_id = $request->manufactory;
                $coupon->transportation_id    = $request->transportation;
                $coupon->value          = $request->value;
                $coupon->notes          = $request->notes;
                $coupon->packed         = $request->packed;
                $coupon->shipment_id    = $request->shipment_id;
                $coupon->cement_type_id = $request->cement_type_id;
                $coupon->cost          = $request->cost;
                $coupon->save();
            }
        }

        return redirect()->route('coupon.unused')->with(['process'=> 'تمت إضافة البون رقم: ', 'name' => $request->coupon]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

    public function used(Coupon $coupon)
    {
        $coupons = Coupon::all()->where('used')->sortByDesc('created_at');
        return view('coupons.used', ['coupons' => $coupons]);
    }
    public function unused(Coupon $coupon)
    {
        $coupons = Coupon::all()->where('used', false)->sortByDesc('created_at');
        return view('coupons.unused', ['coupons' => $coupons]);
    }
}
