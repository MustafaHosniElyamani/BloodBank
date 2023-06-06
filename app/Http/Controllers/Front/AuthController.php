<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {

        return view('front.register');
    }
    public function signin()
    {

        return view('front.signin');
    }

    public function registerSave(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'password' => 'required|confirmed',
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
  

        Auth::guard('front')->login($client);

        return redirect('/');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        $validator = Validator::make($credentials, [
            'phone' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }



        if (Auth::guard('front')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended();
        }else{
            return back()->withErrors([
            'phone' => 'The provided credentials do not match our records.',
        ]);}

    }
    public function logOut(Request $request){
        Auth::guard('front')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
    }
}
