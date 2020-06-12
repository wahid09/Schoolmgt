<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function showLoginForm()
    {
        $user = User::all();
        if(count($user)>0){
            return view('admin.users.login');
        }else{
            $user = new User();
            $user->role = 'Admin';
            $user->name = 'Admin';
            $user->mobile = '01765153253';
            $user->email = 'admin@admin.com';
            $user->password = Hash::make('12345678');
            $user->save();

            return view('admin.users.login');

        }
        
    }
    public function username()
    {
        //return 'email';
        return 'mobile';
    }
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}
