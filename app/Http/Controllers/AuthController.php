<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
class AuthController extends Controller{

    public function register(){
        return view('auth/register');
    }
 
    public function registerPost(Request $request){
        // Same email error
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'Email already exists');
        }
        // Save data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // Return 
        return redirect()->route('login')->with('success', 'Register successfully');
    }
 
    public function login(){
        return view('auth/login');
    }
 
    public function loginPost(Request $request){
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credetials)) {
            return redirect('/home')->with('success', 'Login Success');
        }
 
        return back()->with('error', 'Check again your email and password');
    }
 
    public function logout(){
        Auth::logout();
 
        return redirect()->route('login');
    }
}