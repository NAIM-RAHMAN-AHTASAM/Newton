<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\product;
use App\order_list;
use App\Banner;
use App\Blog;
use App\Faq;
use App\Contact;
use App\About;
use DB;
use Spatie\QueryBuilder\QueryBuilder;
class FrontendController extends Controller
{
  function index(){
    return view('frontend.index',[
      'categories'=>Category::all(),
      'banners'=>Banner::all(),
      'products'=>product::orderBy('id','desc')->get(),
    
      'best_salling_products'=>DB::table('order_lists')->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderby('total', 'DESC')->take(4)->get(),

    ]);
  }




function contact(){
return view('frontend.contact',[
  'contacts'=>Contact::all(),
]);

}


function about(){
return view('frontend.about',[
    'abouts'=>About::all(),
    'best_salling_products'=>DB::table('order_lists')->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderby('total', 'DESC')->take(4)->get(),
]);

}
function faq(){

return view('frontend.faq',[
  'faqs'=>Faq::all()
]);

}


function shop(){
return view('frontend.shop',[
  'products'=>product::all(),
  'categories'=>Category::all()
]);

}

function search(){
          $searched = QueryBuilder::for(product::class)
            ->allowedFilters(['product_name','category_id'])
            // ->allowedSorts('product_price')
            ->get();

            if ($_GET['sort']=='product_price') {

              $search_product= $searched->sortBy('product_price');
            }

            else{
              $search_product= $searched->sortByDesc('product_price');


            }
          return view('frontend.search',compact('search_product'));
         }




}
