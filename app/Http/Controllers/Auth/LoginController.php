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
            return $this->checkEmail( $socialUser );
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
         return $this->registerSocialUser( $socialUser );
    }

  

    private function registerSocialUser( $socialUser )
    {
        $user = new User;
        $user->name = $socialUser->getName();
        $user->email = $socialUser->getEmail();
        $user->password = bcrypt('12345678');
        $user->fid = $socialUser->getId();
        $user->save( );
        $registerUser = User::find( $user->id );
        return $registerUser;
    }

    /*twitter*/
    /**
     * Redirect the user to the twitter authentication page.
     *
     * @return Response
     */
    public function twitterRedirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from twitter.
     *
     * @return Response
     */
    public function twitterHandleProviderCallback()
    {
        $twitterUser = Socialite::driver('twitter')->user();
        $user = $this->checkTwitterId( $twitterUser );
        Auth::login( $user );
        return redirect('/home');
    }

    private function checkTwitterId( $twitterUser)
    {
        $user = User::where('tid',$twitterUser->getId() )->first();
        if( $user )
        {
            return $user;
        }
        else
        {
            /*check email*/
            return $this->checkTwitterEmail( $twitterUser );
        }
        
    }

    private function checkTwitterEmail( $twitterUser )
    {
        $user = User::where('email',$twitterUser->getEmail())->first();
        if( $user )
        {
            User::where( 'email',$twitterUser->getEmail() )->update(['tid'=>$twitterUser->getId()]);
            return $user;
        }
        return $this->registerTwitterUser( $twitterUser );
    }

  

    private function registerTwitterUser( $twitterUser )
    {
        $user = new User;
        $user->name = $twitterUser->getName();
        $user->email = $twitterUser->getEmail();
        $user->password = bcrypt('12345678');
        $user->tid = $twitterUser->getId();
        $user->save( );
        // echo $user->id;die;
        $registerUser = User::find( $user->id );
        return $registerUser;
    }

    /*google*/
    /**
     * Redirect the user to the google authentication page.
     *
     * @return Response
     */
    public function googleRedirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return Response
     */
    public function googleHandleProviderCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = $this->checkGoogleId( $googleUser );
        Auth::login( $user );
        return redirect('/home');
    }

    private function checkGoogleId( $googleUser)
    {
        $user = User::where('gid',$googleUser->getId() )->first();
        if( $user )
        {
            return $user;
        }
        else
        {
            /*check email*/
            return $this->checkGoogleEmail( $googleUser );
        }
        
    }

    private function checkGoogleEmail( $googleUser )
    {
        $user = User::where('email',$googleUser->getEmail())->first();
        if( $user )
        {
            User::where( 'email',$googleUser->getEmail() )->update(['fid'=>$googleUser->getId()]);
            return $user;
        }
        return $this->registerGoogleUser( $googleUser );
    }

  

    private function registerGoogleUser( $googleUser )
    {
        $user = new User;
        $user->name = $googleUser->getName();
        $user->email = $googleUser->getEmail();
        $user->password = bcrypt('12345678');
        $user->gid = $googleUser->getId();
        $user->save( );
        // echo $user->id;die;
        $registerUser = User::find( $user->id );
        return $registerUser;
    }

    
}
