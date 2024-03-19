<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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

    public function googleCallback() {
        // Retrieve user data from Google using Socialite
        $socialiteUser = Socialite::driver('google')->user();

        // Check if the user exists in the database based on their email
        $user = User::where('email', $socialiteUser->getEmail())->first();

        // If the user doesn't exist, create a new user record
        if (!$user) {
            $user = new User();
            $user->name = $socialiteUser->getName();
            $user->password = Hash::make($socialiteUser->getEmail()); // Set password
            $user->email = $socialiteUser->getEmail();
            // Add any additional fields you want to save
            $user->save();
        } else {
            // Update the existing user record with the latest information from Google
            $user->name = $socialiteUser->getName();
            // Update any additional fields if needed
            $user->save();
        }

        // Log in the user
        Auth::login($user);

        // Redirect the user to a dashboard or home page
        return redirect('/home');
    }
}
