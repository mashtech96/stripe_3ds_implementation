<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if((Auth()->user())){
            return redirect()->back();
        }
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    { 
         $checkUser = User::where(['email' =>  $request->email])->first();
     
        if(!$checkUser){
            return redirect()->back()->withErrors('Email Address does not exists.')->withInput();
        }
        if($checkUser->status == 'banned'){
            return redirect()->back()->withErrors('You have been blocked by Admin, Please contact Admin.')->withInput();
        }
        if($checkUser->status == 'inactive'){
            return redirect()->back()->withErrors('Your accout is inactive, Please contact Admin.')->withInput();
        }
        if($checkUser->status == 'deleted'){
            return redirect()->back()->withErrors('This account deleted earlier.')->withInput();
        }
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(url('client/dashboard'));
        }

        return redirect()->back()->withErrors('These credentials do not match our records.')->withInput();
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
