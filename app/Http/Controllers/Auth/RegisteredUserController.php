<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\PaymentLog;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Stripe;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if((Auth()->user())){
            return redirect()->back();
        }
        return view('register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [   
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6',
            'plan_price_id' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET') );
             $stripeCustomer  = $stripe->customers->create([
                'description'       => 'Monthly Subscription '.$request->full_name,
                'email'             => $request->email,
                'name'              => $request->full_name,
                'payment_method'    => $request->stripeToken
              ]); 
              
              $subscription = \Stripe\Subscription::create([
                'customer'  =>  $stripeCustomer->id,
                'items'     => [['price' => $request->plan_price_id]],
                'default_payment_method'  =>  $request->stripeToken,
    
              ]);
             
             
              $dataToAdd['response']  = $subscription;
              $dataToAdd['status']    = 'paid';
              $status = 'active';
        } catch (\Throwable $th) {
           
            $dataToAdd['response']  = $th;
            $dataToAdd['status']    = 'unpaid';
            $status = 'inactive';
        }
       

        $user = User::create([
            'full_name'     => $request->full_name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'phone_number'  => $request->phone_number,
            'status'        =>$status,
        ]);
        if($user){
            $dataToAdd['client_id']    = $user->id;
            $dataToAdd['plan_type']    = $request->plan_type;
            if($request->plan_type == 'basic'){
                $planPrice = 300;
            }
            if($request->plan_type == 'advance'){
                $planPrice = 300;
            }
            if($request->plan_type == 'premium'){
                $planPrice = 300;
            }
            else{
                $planPrice = 300;
            }
            $dataToAdd['plan_price']   = $planPrice;
            PaymentLog::create($dataToAdd);
            $dateAndTime = date('Y:m:d H:i:s');
            Credit::create(['client_id'=> $user->id, 'total_credits'=> 3000, 'created_at'=> $dateAndTime, 'updated_at'=> $dateAndTime]);
            if($status == 'active'){
                $authenticated = Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password]);
                return redirect()->route('client.dashboard');
            }
            else{
                return redirect()->back()->with('error', 'Your account is created, to activate it please contact Adminstration!');
            }
        }
        
    }

}
