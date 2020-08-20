<?php
namespace App\Http\Controllers;
use App\Banner;
use Image;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BannerController extends Controller
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
      return view('admin.banner.index',[
        'banners'=>Banner::all()
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
      'banner_image'=>'required:banners,banner_image',
    ]);

    // Category::insert([
    //   'category_name'=>$request->category_name,
    //   'added_by'=>Auth::id(),
    //   'created_at'=>Carbon::now(),
    // ]);
    $return_after_create = Banner::create([
      'banner_title'=>$request->banner_title,
      'banner_description'=>$request->banner_description,
      'banner_image'=>$request->banner_image,
      'created_at'=>Carbon::now(),

    ]);
    // print_r($return_after_creaate->id);
    //
    if($request->hasFile('banner_image')){

      $uploaded_banner_image= $request->file('banner_image');

      $new_banner_image_name= $return_after_create->id.".".$uploaded_banner_image->extension();
      $new_banner_image_location= base_path('public/uploads/banner/'.$new_banner_image_name);
      Image::make($uploaded_banner_image)->resize(1919,800)->save($new_banner_image_location,50);

      Banner::find($return_after_create->id)->update([
        'banner_image'=>$new_banner_image_name,


      ]);

    }
    return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
    return view('admin.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
      if($request->hasFile('banner_image')){


          $location = base_path()."/public/uploads/banner/".$banner->banner_image;
          unlink($location);

          $uploaded_banner_image= $request->file('banner_image');
          $new_banner_image_name= $banner->id.".".$uploaded_banner_image->extension();
          $new_banner_image_location= base_path('public/uploads/banner/'.$new_banner_image_name);
          Image::make($uploaded_banner_image)->resize(600,470)->save($new_banner_image_location,50);
          $banner->banner_image = $new_banner_image_name;
      }

        $banner->banner_title             =$request->banner_title;
        $banner->banner_description       =$request->banner_description;

        $banner->save();

        return redirect('banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */




    public function destroy(Banner $banner)
    {
      $banner->forceDelete();
      return back();
    }
}
