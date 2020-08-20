<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;

use Carbon\Carbon;

class GoogleController extends Controller
{


    /**
         * Redirect the user to the GitHub authentication page.
         *
         * @return \Illuminate\Http\Response
         */
        public function redirectToProvider()
        {
            return Socialite::driver('google')->redirect();
        }

        /**
         * Obtain the user information from GitHub.
         *
         * @return \Illuminate\Http\Response
         */
        public function handleProviderCallback()
        {

          // store in user variable
            $user = Socialite::driver('google')->user();

            // $user->token;
            // if account is not created thn create account
          if (!User::where('email',$user->getemail())->exists()) {
            User::insert([
              'name'=>$user->getName(),
              'email'=>$user->getEmail(),
              'password'=>bcrypt('123456789'),
              'role'=>2,
              'created_at'=>Carbon::now(),
            ]);
            }
            // if account is already created thn login successfully
            if (Auth::attempt(['email'=>$user->getEmail(),'password'=>'123456789'])) {
              return redirect('home/customer');
            }
        }





}
