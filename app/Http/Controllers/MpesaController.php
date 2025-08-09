<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    public function stkPush(Request $request)
    {
        $timestamp = now()->format('YmdHis'); // Current timestamp in required format

        $shortcode = env('MPESA_SHORTCODE');
        $passkey = env('MPESA_PASSKEY');
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');
        $callbackUrl = env('MPESA_CALLBACK_URL');
        $phone = $request->phone;
        $amount = $request->amount;

        // Generate password
        $password = base64_encode($shortcode . $passkey . $timestamp);

        // Get access token
        $response = Http::withBasicAuth($consumerKey, $consumerSecret)
            ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        if (!$response->ok()) {
            return response()->json(['error' => 'Failed to generate access token'], 500);
        }

        $accessToken = $response->json()['access_token'];

        // STK Push request
        $stkPushResponse = Http::withToken($accessToken)
            ->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
                'BusinessShortCode' => $shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phone,
                'PartyB' => $shortcode,
                'PhoneNumber' => $phone,
                'CallBackURL' => $callbackUrl,
                'AccountReference' => 'KaribuJikoni',
                'TransactionDesc' => 'Karibu Jikoni Delivery',
            ]);

        Log::info('STK Push Response', $stkPushResponse->json());

        return response()->json($stkPushResponse->json());
    }
}
