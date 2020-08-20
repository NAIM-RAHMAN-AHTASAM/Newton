<?php

namespace App\Http\Controllers;
use App\product;
use App\Category;
use App\Product_multiple_image;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function __construct()
     {
         $this->middleware('auth')->except(['show']);
         $this->middleware('verified')->except(['show']);
         $this->middleware('CheckRole')->except(['show']);//checkrole check

     }


    public function index()
    {

       return view('admin.product.index',[
         'categories'=>Category::all(),
         'products'=>product::all()

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
        'product_thumbnail_image'=>'required:products,product_thumbnail_image',
      ]);


      $product_slug = Str::slug($request->product_name.'-'.Carbon::now()->timestamp);

      $product_id=product::insertGetId([
      'category_id'=>$request->category_id,
      'product_name'=>$request->product_name,
      'product_price'=>$request->product_price,
      'product_short_description'=>$request->product_short_description,
      'product_long_description'=>$request->product_long_description,
      'product_thumbnail_image'=>$request->product_thumbnail_image,
      'product_slug'=>$product_slug,
      'product_quantity'=>$request->product_quantity,
      'created_at'=>Carbon::now()

      ]);

      $uploaded_product_image= $request->file('product_thumbnail_image');

      $new_product_image_name=$product_id.".".$uploaded_product_image->extension();
      $new_product_image_location= base_path('public/uploads/product_thumbnail/'.$new_product_image_name);
      Image::make($uploaded_product_image)->resize(600,622)->save($new_product_image_location,50);
      // water mark insert query
      // ->insert('https://i.imgur.com/ZJpFDj8.png', 'bottom-right', 5, 5)

      product::find($product_id)->update([
        'product_thumbnail_image'=>$new_product_image_name
      ]);


         $all_images=$request->file('product_multiple_image');
         $flag = 1;

         foreach ($all_images as $single_image) {

           $new_product_image_name=$product_id."-"."$flag".".".$single_image->extension();
           $new_product_image_location= base_path('public/uploads/product_multiple/'.$new_product_image_name);
           Image::make($single_image)->resize(600,550)->save($new_product_image_location,50);
           // water mark for multiple image
           // ->insert('https://i.imgur.com/ZJpFDj8.png', 'bottom-right', 5, 5)

           Product_multiple_image::insert([
             'product_id'=>$product_id,
             'product_multiple_image_name'=>$new_product_image_name,
             'created_at'=>Carbon::now()

           ]);


           $flag++;


         }
         return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      // echo $slug;
      $product_info=product::where('product_slug',$slug)->first();
       $related_product=product::where('category_id',$product_info->category_id)->where('id','!=',$product_info->id)->get();

      return view('frontend.product_details',compact('product_info','related_product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
      // echo $product;
      return view('admin.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {

      if($request->hasFile('product_thumbnail_image')){



          $location = base_path()."/public/uploads/product_thumbnail/".$product->product_thumbnail_image;
          unlink($location);
          $uploaded_product_image= $request->file('product_thumbnail_image');
          $new_product_image_name= $product->id.".".$uploaded_product_image->extension();
          $new_product_image_location= base_path('public/uploads/product_thumbnail/'.$new_product_image_name);
          Image::make($uploaded_product_image)->resize(600,470)->save($new_product_image_location,50);
          $product->product_thumbnail_image = $new_product_image_name;
      }

      // print_r($request->all());
      $product->product_name                    =$request->product_name;
      $product->product_quantity                =$request->product_quantity;
      $product->product_price                   =$request->product_price;
      $product->product_short_description       =$request->product_short_description;
      $product->product_long_description        =$request->product_long_description;

        $product->save();

        return redirect('product');

        // return back();



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
      $product->forceDelete();
      return back();
    }
}
