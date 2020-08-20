<?php

namespace App\Http\Controllers;

use App\Coupon;
use Carbon\Carbon;
use App\Mail\SendCoupon;
use Illuminate\Http\Request;
use Mail;
use App\User;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');//login varified check
         $this->middleware('verified');//email_verified check
         $this->middleware('CheckRole');//checkrole check
     }



    public function index()
    {
      return view('admin.coupon.index',[
        'coupons'=>Coupon::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        'coupon_name'=>'required|max:20|unique:coupons,coupon_name',
        'coupon_discount'=>'required|numeric|max:99|min:1',
        'coupon_validity'=>'required'
      ]);


      Coupon::insert([
        'coupon_name'=>strtoupper($request->coupon_name),
        'coupon_discount'=>$request->coupon_discount,
        'coupon_validity'=>$request->coupon_validity,
        'created_at'=>Carbon::now(),
      ]);
       $coupon_name = strtoupper($request->coupon_name);

       foreach (User::where('role',2)->get() as $coupon_mail) {
         Mail::to($coupon_mail->email)->send(new SendCoupon($coupon_name));

       }

      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
      return view('admin.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
            $coupon->coupon_name              =$request->coupon_name;
            $coupon->coupon_discount          =$request->coupon_discount;
            $coupon->coupon_validity          =$request->coupon_validity;

            $coupon->save();
            return redirect('coupon');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
      $coupon->forceDelete();
      return back();
    }
}
