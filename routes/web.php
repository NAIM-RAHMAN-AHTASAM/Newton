<?php



Route::get('/', function () {
    return view('frontend.index');
});


Route::get('/', 'FrontendController@index');
Route::get('admin/contact', 'FrontendController@contact');
Route::get('admin/about', 'FrontendController@about');
Route::get('about', 'FrontendController@about');
Route::get('/faq', 'FrontendController@faq');

Route::get('/shop','FrontendController@shop')->name('shop');
Route::get('/search','FrontendController@search');




Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add/faq', 'HomeController@addfaq');
Route::post('/add/faq/post', 'HomeController@addfaqpost');
Route::get('/faq/delete/{faq_id}','HomeController@faqdelete');
Route::get('/faq/edit/{faq_id}','HomeController@faqedit');
Route::post('/faq/edit/post','HomeController@faqeditpost');
Route::get('/faq/restore/{faq_id}','HomeController@faqrestore');
Route::get('/faq/hard/delete/{faq_id}','HomeController@faqharddelete');
// for graph
Route::get('all/graph', 'HomeController@graph')->name('all_graph');

// For Report Generate
Route::get('view/report', 'HomeController@viewreport')->name('view_report');








Route::get('edit/profile','HomeController@edit_profile')->name('edit_profile');
Route::post('change/password','HomeController@change_password')->name('change_password');


Route::get('update/profile','HomeController@update_profile')->name('update_profile');
Route::post('update/profile/post','HomeController@update_profile_post');
// Route::post('update/profile/post','HomeController@update_profile_post')->name('update_profile_post');
Route::get('view/profile','HomeController@view_profile')->name('view_profile');










Route::get('home/customer','CustomerController@homecustomer');
Route::get('order/download/{order_id}','CustomerController@orderdownload');
Route::get('send/sms/{order_id}','CustomerController@sendsms');
Route::post('add/review','CustomerController@addreview')->name('add_review');
Route::get('total/review','CustomerController@totalreview');


Route::resource('category','CategoryController');
Route::resource('product','ProductController');
Route::resource('banner','BannerController');
Route::resource('coupon','CouponController');
Route::resource('blog','BlogController');
Route::resource('contact','ContactController');
Route::post('contact/post','ContactController@contactpost');
// contact status update
Route::get('contact/activation/{id}/{activation}','ContactController@contactactivation');

Route::resource('about','AboutController');
Route::get('about/activation/{id}/{activation}','AboutController@aboutactivation');


Route::get('blog/page/file','BlogController@blog_page');



//git GitHub
Route::get('register/github','Githubcontroller@redirectToProvider');
Route::get('login/github/callback','Githubcontroller@handleProviderCallback');


//google Socialite
Route::get('register/google','GoogleController@redirectToProvider');
Route::get('login/google/callback','GoogleController@handleProviderCallback');


Route::post('add/to/cart','CartController@addtocart');
Route::get('delete/from/cart/{cart_id}','CartController@deletefromcart');
Route::post('update/cart','CartController@updatecart');
Route::get('view/cart/page','CartController@viewcartpage');
Route::get('view/cart/page/{coupon_name}','CartController@viewcartpage');



Route::post('checkout','CheckoutController@index');
Route::post('checkout/post','CheckoutController@checkoutpost');

Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
// ajax Route
Route::post('/get/city/list','CheckoutController@getcitylist');



Route::get('role/index','RoleController@index')->name('role.index');
Route::post('role/add','RoleController@roleadd')->name('role.add');
Route::post('role/assign','RoleController@roleassign')->name('role.assign');
Route::get('role/permission/edit/{user_id}','RoleController@rolepermissionedit');
Route::post('role/permission/edit','RoleController@rolepermissioneditpost')->name('role.permission.edit.post');
