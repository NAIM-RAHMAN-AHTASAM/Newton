<?php

namespace App\Http\Controllers;

use App\Blog;
use Image;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      {
      // $categories = category::all();
      return view('admin.blog.index',[
        'blogs'=> Blog::all()

      ]);
      }
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

      // $request->validate([
      // 'blog_image'=>'required:blogs,blog_image',
      // ]);

      // Category::insert([
      //   'category_name'=>$request->category_name,
      //   'added_by'=>Auth::id(),
      //   'created_at'=>Carbon::now(),
      // ]);
      $return_after_create = Blog::create([
      'blog_title'=>$request->blog_title,
      'blog_description'=>$request->blog_description,
      'blog_image'=>$request->blog_image,
      'created_at'=>Carbon::now(),

      ]);
      // print_r($return_after_creaate->id);
      //
      if($request->hasFile('blog_image')){

      $uploaded_blog_image= $request->file('blog_image');

      $new_blog_image_name= $return_after_create->id.".".$uploaded_blog_image->extension();
      $new_blog_image_location= base_path('public/uploads/blog/'.$new_blog_image_name);
      Image::make($uploaded_blog_image)->resize(500,364)->save($new_blog_image_location,50);

      Blog::find($return_after_create->id)->update([
        'blog_image'=>$new_blog_image_name,


      ]);

      }
      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {

    }
    public function blog_page()
    {
      return view('frontend.blog.blogpage',[
          'blogs'=> Blog::all(),

      ]

    );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
      return view('admin.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {

            if($request->hasFile('blog_image'))
            {



                $location = base_path()."/public/uploads/blog/".$blog->blog_image;
                unlink($location);
                $uploaded_blog_image= $request->file('blog_image');
                $new_blog_image_name= $blog->id.".".$uploaded_blog_image->extension();
                $new_blog_image_location= base_path('public/uploads/blog/'.$new_blog_image_name);
                Image::make($uploaded_blog_image)->resize(600,470)->save($new_blog_image_location,50);
                $blog->blog_image = $new_blog_image_name;
            }

                $blog->blog_title                    =$request->blog_title;
                $blog->blog_description              =$request->blog_description;


                $blog->save();
                return redirect('blog');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
      $blog->forceDelete();
      return back();
    }
}
