<?php

namespace App\Http\Controllers;

use App\About;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.about.index',[
      'abouts'=>About::all(),
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
      About::Insert([
        'about_title'=>$request->about_title,
        'about_discription'=>$request->about_discription,
        'created_at'=>Carbon::now(),

      ]);
      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
      $about->forceDelete();
      return back();
    }




    function  aboutactivation($id , $activation)
  {


       $all_abouts = About::all();
       foreach ($all_abouts as $all_about)
       {
            $all_about->activation = 0 ;
            $all_about->save();

      }
    About::findOrFail($id)->update ([
               'activation'=> 1 ,
                ]);


           return back();






  //     if ($activation == 1)
  //            {
  //             Contact::findOrFail($id)->update([
  //            'activation'=> 0 ,
  //             ]);
  //
  //            }
  //
  // else {
  //
  //         Contact::findOrFail($id)->update([
  //           'activation'=> 1 ,
  //         ]);
  //
  //       }
  //        return back();

  }







}
