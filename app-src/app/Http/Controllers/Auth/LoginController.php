<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->with(['hd' => 'redhat.com'])->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
      // http://localhost:8000/ext-login/google
      $userSocial =   Socialite::driver('google')->stateless()->user();
      $users      =   User::where(['email' => $userSocial->getEmail()])->first();

      if($users){
        Auth::login($users);
        return redirect($this->redirectTo);
      }
      else {
        $user = User::create([
          'name'            => $userSocial->getName(),
          'email'           => $userSocial->getEmail(),
          'provider_avatar' => $userSocial->getAvatar(),
          'provider_id'     => $userSocial->getId(),
          'provider'        => 'google',
        ]);
        Auth::login($user);
        return redirect($this->redirectTo);
      }

    }
}
