<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\PaymentLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Validator;
use Mail;
use PhpOffice\PhpSpreadsheet\Shared\Trend\Trend;
use Stripe;
use Stripe\Stripe as StripeStripe;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }
    public function paymentInit(Request $request)
    {

        if ($request->request_type == 'create_customer_subscription') {
            $name   = $request->name;
            $email  = $request->email;

            // Add customer to stripe 
            try {
                $customer = \Stripe\Customer::create([
                    'name'  => $name,
                    'email' => $email
                ]);

            } catch (\Throwable $e) {
                return array('error' => 'error creating customer');
            }

            if ($customer) {
                //create local database user
                $user = User::whereEmail($email)->first();
                if(!$user){
                    $user = User::create([
                        'full_name'     => $name,
                        'email'         => $email,
                        'password'      => Hash::make($request->password),
                        'status'        =>'inactive',
                    ]);
                }
               

                // Create a new subscription 
                try {
                    $subscription = \Stripe\Subscription::create([
                        'customer' => $customer->id,
                        'items' => [[
                            'price' => $request->plan_price_id,
                        ]],
                        'payment_behavior' => 'default_incomplete',
                        'expand' => ['latest_invoice.payment_intent'],
                    ]);
                    $output = [
                        'subscriptionId' => $subscription->id,
                        'clientSecret' => $subscription->latest_invoice->payment_intent->client_secret,
                        'customerId' => $customer->id
                    ];

                    $dateAndTime = date('Y:m:d H:i:s');
                    $credit = Credit::whereClientId($user->id)->first();
                    if(!$credit){
                        Credit::create(['client_id'=> $user->id, 'total_credits'=> 3000, 'created_at'=> $dateAndTime, 'updated_at'=> $dateAndTime]);
                    }
                

                    return $output;
                } catch (\Throwable $e) {
                    return array('error' => $e);
                }
            }
        } elseif ($request->request_type == 'payment_insert') {
            $payment_intent  =  $request->payment_intent;
            $subscription_id =  $request->subscription_id;
            $customer_id     = $request->customer_id;


            // Retrieve customer info 
            try {
                $customer = \Stripe\Customer::retrieve($customer_id);
            } catch (\Throwable $e) {
                return array('error' => 'customer not found');
            }

            // Check whether the charge was successful 
            if ($payment_intent) {

                // Retrieve subscription info 
                try {
                    $subscriptionData = \Stripe\Subscription::retrieve($subscription_id);
                } catch (\Throwable $e) {
                    return array('error' => 'subscription not found');
                }
                $user = User::whereEmail($request->customer_email)->first();
                if($user){
                    User::whereId($user->id)->update(['status'=> 'active']);
                }
                return $subscriptionData;
            } else {
                return array('error' => 'transaction has been failed');
            }
        }
    }
}
