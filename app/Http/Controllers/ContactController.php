<?php

namespace App\Http\Controllers;

use App\User;
use App\Contact;
use App\Contactmessage;
use App\Mail\SendContactMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contact.index',[
        'contacts'=>Contact::all(),
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
      // print_r($request->all());


      //
      //
      Contact::Insert([
        'Contact_address'=>$request->Contact_address,
        'Contact_email'=>$request->Contact_email,
        'Contact_phone'=>$request->Contact_phone,
        'created_at'=>Carbon::now(),

      ]);
      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
          return view('admin/contact/edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {

      $contact->Contact_address        =$request->Contact_address;
      $contact->Contact_email          =$request->Contact_email;
      $contact->Contact_phone          =$request->Contact_phone;

      $contact->save();
      return redirect('contact');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
      $contact->forceDelete();
      return back();
    }

    public function contactpost(Request $request)
    {
      // print_r($request->except('_token')+[
      //   'created_at'=>Carbon::now();
      // ]);

      Contactmessage::insert($request->except('_token')+[
        'created_at'=>Carbon::now(),
      ]);

       $name = $request->name;
       $email = $request->email;
       $subject = $request->subject;
        $message = $request->message;

      foreach (User::where('role',1)->get() as $admin_mail) {
       Mail::to($admin_mail->email)->send(new SendContactMessage($name,$email,$subject,$message));
       return back();
      }

// Contactmessage::insert([
//
//   'name'=>$request->name,
//   'email'=>$request->email,
//   'subject'=>$request->subject,
//   'message'=>$request->message,
//   'created_at'=>Carbon::now(),
// ]);
//       $contact_all= $request->all();





    }




  function  contactactivation($id , $activation)
{


     $all_contacts = Contact::all();
     foreach ($all_contacts as $all_contact)
     {
          $all_contact->activation = 0 ;
          $all_contact->save();

    }
  Contact::findOrFail($id)->update ([
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
