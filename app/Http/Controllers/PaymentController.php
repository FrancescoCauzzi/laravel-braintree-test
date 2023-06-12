<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function showCheckoutForm()
    {
        $gateway = app('Braintree\Gateway');
        $clientToken = $gateway->clientToken()->generate();
        return view('checkout', ['clientToken' => $clientToken]);
    }

    public function getClientToken()
    {
        $gateway = app('Braintree\Gateway');
        $clientToken = $gateway->clientToken()->generate();
        return response()->json(['clientToken' => $clientToken]);
    }

    public function purchase(Request $request)
    {
        // Get the payment method nonce from the request
        //$nonceFromTheClient = $request->payment_method_nonce;
        $nonceFromTheClient = 'fake-valid-nonce';

        // Generate a client token
        $gateway = app('Braintree\Gateway');
        //$clientToken = $gateway->clientToken()->generate();

        // Use the client token and nonce to create a transaction
        $result = $gateway->transaction()->sale([
            'amount' => '10.00', // replace this with the actual amount
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => ['submitForSettlement' => true]
        ]);

        // Handle the result of the transaction
        if ($result->success) {
            // Transaction was successful
            $transaction = $result->transaction;
            // $braintree_response =  response()->json([
            //     'message' => 'Transaction successful',
            //     'transaction' => $transaction, 'transactionId' => $transaction->id
            // ]);

            return Redirect::to('dashboard');
        } else {
            // Transaction failed
            $errorString = "";
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return response()->json(['message' => 'Transaction failed', 'errors' => $errorString]);
        }
    }
}
