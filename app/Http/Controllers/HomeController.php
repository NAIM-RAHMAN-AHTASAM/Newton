<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordFormPost;
use App\User;
use App\Faq;
use App\order;
use App\product;
use App\order_list;
use App\Pofile;
use App\Charts\SavenDaysSaleChart;
use App\Charts\PaymentMethodChart;
use Auth ;
use Hash ;
use Image;
use Illuminate\Support\Str;
use carbon\carbon;
use App\Mail\ChangePasswordConfirmation;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');//login varified check
        $this->middleware('verified');//email_verified check
        $this->middleware('CheckRole')->except(['edit_profile','change_password','update_profile',
        'view_profile']);
    }






    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      $login_user_id = Auth::id();
     $users= User::where('id','!=',$login_user_id)->orderBy('id','desc')->paginate(5);

      return view('home',compact('users'));
    }



    public function graph()
    {
      for ($i=1; $i <=7 ; $i++) {

      $date[] = Carbon::now()->subdays(7-$i)->format('Y-m-d');

        $sale[] = order::whereDate('created_at', Carbon::now()->subdays(7-$i)->format('Y-m-d'))->sum('total');

      }


      $saven_days_sale_chart= new SavenDaysSaleChart;
      $saven_days_sale_chart->labels($date);
      $saven_days_sale_chart->dataset('Sale Amount', 'bar', $sale)->options([
        'backgroundColor'=>['#CD3413',
        '#810E15',
        '#7A0E81',
        '#0E4981',
        '#0E7F81',
        '#13CD35',
        '#CDCA13',

        ]
      ]);

// Second Chart Start
      $cash_on_delivary = order::where('payment_method',1)->count();
      $online_payment = order::where('payment_method',2)->count();
       $payment_method_chart = new PaymentMethodChart;
       $payment_method_chart->labels(['cash on Delevary','onlone payment']);
       $payment_method_chart->dataset('payment type', 'pie', [$cash_on_delivary,$online_payment])->options([
         'backgroundColor'=>[
         '#810E15',
         '#0E4981',
       ]


       ]);

// Second Chart End



      return view('frontend/graph',compact('saven_days_sale_chart','payment_method_chart'));
    }







      public function addfaq(){
        $soft_deleted_faqs=Faq::onlyTrashed()->get();
        $faqs=Faq::all();
        return view('admin/addfaq', compact('soft_deleted_faqs','faqs'));
      }









          public function addfaqpost(Request $request){

            $request->validate([
            'faq_question' =>'required',
            'faq_answer' =>'required',
          ],[
            'faq_question.required'=>'enter your valid question',
            'faq_answer.required'=>'enter your valid answer',
          ]);



          Faq::insert($request->except('_token')+['created_at'=>carbon::now()]);
          return back()->withStatus(' Your Faq added successfully');

          // Faq::insert([
          //   "faq_question"=>$request->faq_question,
          //   "faq_answer"=>$request->faq_answer,
          //   "created_at"=>carbon::now(),
          //   ]);
          //
        }







public function faqdelete($faq_id){

         Faq::find($faq_id)->delete();
         return back()->with('deletestatus','Deleted successfully');

  }



public function faqedit($faq_id){
            $faq=Faq::find($faq_id);
            return view('admin/edit',[
              'faq'=>$faq
            ]);


            }




public function faqeditpost(Request $request){

       Faq::find($request->faq_id)->update([
         'faq_question'=>$request->faq_question,
         'faq_answer'=>$request->faq_answer,

]);

      return back();
}





public function faqrestore($faq_id){

  Faq::withTrashed()->where('id','=',$faq_id)->restore();
  return back();
}





public function faqharddelete($faq_id){
// echo "string";

  Faq::withTrashed()->where('id','=',$faq_id)->forceDelete();
  return back();
}






public function edit_profile(){

  return view('admin.edit_profile');
}







// Change password start


public function change_password(ChangePasswordFormPost $request){
   if($request->old_password==$request->password){
     return back()->withErrors('Your old password can not be your new password');
   }
    else {
      $old_password = $request->old_password;
             $db_password = Auth::user()->password;
            if (  Hash::check($old_password,$db_password)) {
             user::find(Auth::id())->update([
               'password' =>Hash::make($request->password)
             ]);
               Mail::to(Auth::user()->email)->send(new ChangePasswordConfirmation());


             return back()->with('password_change_success','your password change successfully');
            }
            else {
              return back()->withErrors('Your old password is not right');

            }

     // print_r($request->all());
}
// Change password end




}







function viewreport()

{
return view('admin.report.index',[
  'orders_list'=>order_list::orderBy('id','asc')->paginate(5),




  // 'products'=>product::all(),
  // 'best_salling_products'=>DB::table('order_lists')->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderby('total', 'DESC')->take(4)->get(),

]);


}





function update_profile()
{

return view('admin.profile.update_profile');

}

function update_profile_post(Request $request)
{

  if ($request->hasFile('profile_image')){

      $get_image = $request->file('profile_image');
      $image_name = str::random(5) . '.' . $get_image->getClientOriginalExtension();
      Image::make($get_image)->save('profile_images/' . $image_name, 100);

      User::where('id',Auth::user()->id)->update([
          'image'   => 'profile_images/' . $image_name,
          'name'   => $request->profile_name,
          'email' => $request->profile_email,
          'contact'    => $request->profile_phone,
          'address'    => $request->profile_address,
          'created_at' => Carbon::now()
      ]);

      // return back();
      Toastr::success('User Profile Updated', 'Success');
      return redirect()->back();
  }
  else{
    User::where('id',Auth::user()->id)->update([
        'name'   => $request->profile_name,
        'email' => $request->profile_email,
        'contact'    => $request->profile_phone,
        'address'    => $request->profile_address,
        'created_at' => Carbon::now()
    ]);

      // return back();
      Toastr::success('User Profile Updated', 'Success');
      return redirect()->back();
  }




}



function view_profile()
{

  $data = User::where('id',Auth::user()->id)->first();
return view('admin.profile.view_profile',compact('data'));


}




}
