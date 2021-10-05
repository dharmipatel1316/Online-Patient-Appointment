<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DoctorPortalController extends Controller
{
    public function signin(Request $request){
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
                   // if (Auth::guard('doctors')->attempt($credentials)) {
                    $user = Doctors::where('email', '=', $request->get('email'))->first();
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
}
