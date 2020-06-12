<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('auth');
    }
    public function showRegistrationForm()
    {
        if(Auth::user()->role == 'Admin'){
            return view('admin.users.register');
        }else{
            return redirect('');
        }
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'role' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'min:11', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'role' => $data['role'],
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function userList(){
        if(Auth::user()->role =='Admin'){
            $user = User::all();
            return view('admin.users.user_list', ['user'=>$user]);
        }else{
            return redirect('/');
        }
        
    }
    public function userProfile($userId){
        $user = User::find($userId);
        //return $user;
        return view('admin.users.user_profile', ['user'=>$user]);
    }
    public function updateProfile($userId){
        $user = User::find($userId);
        return view('admin.users.user_profile', ['user'=>$user]);
    }
    public function updateProfilePic($userId){
        $user = User::find($userId);
        return view('admin.users.user_profile', ['user'=>$user]);
    }
    public function updateProfileInfo(Request $request){
        $this->validate($request, [
            'name' =>['required', 'string', 'max:255'],
            'mobile' =>['required', 'string', 'min:13', 'max:13'],
            'email' =>['required', 'string', 'email', 'max:255'],
        ]);
        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->save();
        //return $user;

        return redirect("/user_profile/{$request->user_id}")->with('message', 'Update successfull');
    }
    public function updateProfileImage(Request $request){
        $user = User::find($request->user_id);
        //return $user;
        //$isExists = Storage::exists('avatar/itsolutionstuff.png');

        //dd($isExists);
        $image = $request->file('avater');
        $slug = str_slug($user->name);
        if(isset($image))
        {
            //make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            //$imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $imageName  = $slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('avatar'))
            {
                Storage::disk('public')->makeDirectory('avatar');
            }
            $avatarImage = Image::make($image)->resize(300,300)->stream();
            Storage::disk('public')->put('avatar/'.$imageName,$avatarImage);
        } else {
            $imageName = "avatar.jpeg";
        }
        $user->avater = $imageName;
        $user->save();

        return redirect("/user_profile/{$request->user_id}")->with('message', 'Image Update successfully');

    }
    public function passwordUpdate(Request $request){
        $this->validate($request, [
            'new_password' => ['required', 'string', 'min:8'],
        ]);
        $oldpassword = $request->password;
        $user = User::find($request->user_id);
        
        if(Hash::check($oldpassword, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect("/user_profile/{$request->user_id}")->with('message', 'Password has been updated successfully');
        }
        return redirect("/user_profile/{$request->user_id}")->with('error', 'Old Password does not match, Please try again....');
    }
}
