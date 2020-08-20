<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;
use Image;
use Carbon\Carbon;

class CategoryController extends Controller
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
         $this->middleware('CheckRole');//checkrole check

     }

    public function index()
    {
    $categories = category::all();
    return view('admin.category.index',compact('categories'));
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
        'category_name'=>'required|unique:categories,category_name',
      ]);

      // Category::insert([
      //   'category_name'=>$request->category_name,
      //   'added_by'=>Auth::id(),
      //   'created_at'=>Carbon::now(),
      // ]);
      $return_after_creaate = Category::create([
        'category_name'=>$request->category_name,
         'added_by'=>Auth::id(),
         'created_at'=>Carbon::now(),

      ]);
      // print_r($return_after_creaate->id);

      if($request->hasFile('category_image')){

        $uploaded_category_image= $request->file('category_image');

        $new_category_image_name= $return_after_creaate->id.".".$uploaded_category_image->extension();
        $new_category_image_location= base_path('public/uploads/category/'.$new_category_image_name);
        Image::make($uploaded_category_image)->resize(900,1100)->save($new_category_image_location,50);

        // Watermark insart


        // ->insert('https://i.imgur.com/ZJpFDj8.png', 'bottom-right', 5, 5)



        Category::find($return_after_creaate->id)->update([
          'category_image'=>$new_category_image_name,


        ]);

      }
      return back();
    }








    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
  return view('admin/category/edit',compact('category'));
  return back();

    }






    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
if($request->hasFile('category_image')){

  if(  $category->category_image !='category_default_image.jpg')
  {
    $location = base_path()."/public/uploads/category/".$category->category_image;
    unlink($location);
    }
    $uploaded_category_image= $request->file('category_image');
    $new_category_image_name= $category->id.".".$uploaded_category_image->extension();
    $new_category_image_location= base_path('public/uploads/category/'.$new_category_image_name);
    Image::make($uploaded_category_image)->insert('https://i.imgur.com/ZJpFDj8.png', 'bottom-right', 5, 5)->resize(600,470)->save($new_category_image_location,50);
    $category->category_image = $new_category_image_name;
}


    $category->category_name=$request->category_name;
      $category->save();
      return back();
    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

      $category->forceDelete();
      return back();
    }
}
