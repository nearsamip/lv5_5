<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;

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
    protected $redirectTo = '/home';

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
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $socialUser = Socialite::driver('facebook')->user();
        $user = $this->checkFacebookId( $socialUser );
        Auth::login( $user );
        return redirect('/home');
    }

    private function checkFacebookId( $socialUser)
    {
        $user = User::where('fid',$socialUser->getId() )->first();
        if( $user )
        {
            return $user;
        }
        else
        {
            /*check email*/
            $this->checkEmail( $socialUser );
        }
        
    }

    private function checkEmail( $socialUser )
    {
        $user = User::where('email',$socialUser->getEmail())->first();
        if($user)
        {
            User::where( 'email',$socialUser->getEmail() )->update(['fid'=>$socialUser->getId()]);
            return $user;
        }
        $this->registerSocialUser( $socialUser );
    }

  

    private function registerSocialUser( $socialUser )
    {
        $user = new User;
        $user->name = $socialUser->getName();
        $user->email = $socialUser->getEmail();
        $user->password = bcrypt('12345678');
        $user->fid = $socialUser->getId();
        $user->save( );
        return $user;
    }
}
