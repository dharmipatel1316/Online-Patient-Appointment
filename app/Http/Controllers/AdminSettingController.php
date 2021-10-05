<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class AdminSettingController extends Controller
{
    public function dashboard(){
        if(Auth::check()){
            return view("dashboard");
        }
        return redirect("/");
    }

    public function signup(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'password' => ['required', Password::min(8)->mixedCase()->symbols()],
               /*  'conpassword' => ['required', 'password', Password::min(8)->mixedCase()->symbols()], */
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            } else {
                $getSignup = DB::table('user')->insert([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'user_type' => 'admin'
                ]);  
                if($getSignup){
                    return response()->json(["message" => "User signup successfully!"]);
                } 
            }
        }
    }

    public function signin(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            } else {
                $credentials = ['email' => $request->email, 'password' => $request->password, 'user_type' => 'admin'];
                if (Auth::attempt($credentials)) {
                    $user = User::where('email', '=', $request->get('email'))->first();

                    $request->session()->put('user_id', $user->id);
                    $request->session()->put('firstname', $user->firstname);
                    $request->session()->put('lastname', $user->lastname);
                  
                 
                   return response()->json(["message" => "Login successfully!"]);
                } else{
                    return response()->json(["wrong" => "Invalid email & password"]);
                }            
            }
        }
    }
    // Update Profile
    public function updateProfile($id){
        $profileUpdate = User::find($id);
        return response()->json($profileUpdate);
    }

    public function profileUpdateSave(Request $request){
        $updateProfile = DB::table('user')
                        ->where('id', $request->user_id)
                        ->update([
                                'firstname' => $request->firstname, 
                                'lastname' => $request->lastname,
                                'email' => $request->email
                                ]);

        return response()->json(["message" => "Profile update successfully!"]);
    }

    public function signout(Request $request){
        //$value = $request->session()->pull('email', 'default');
        Auth::logout();
        //$request->session()->forget('email');
        $request->session()->flush();
        return redirect('/');
    }
}
