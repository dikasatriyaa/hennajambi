<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

public function createSnapToken(Request $request)
{

    return response()->json($request->all());
    // $cartTotal = $request->input('total_bayar');
    // $service_id = $request->input('service_id');
    // $orderId = uniqid(); // Generate unique order ID

    // $transactionDetails = [
    //     'order_id' => $orderId,
    //     'gross_amount' => $cartTotal,
    // ];

    // $itemDetails = [
    //     [
    //         'id' => $service_id,
    //         'price' => $cartTotal,
    //         'quantity' => $request->input('jumlah_pesanan'),
    //         'name' => 'Shopping Cart Checkout',
    //     ],
    // ];

    // $customerDetails = [
    //     'first_name'    => 'Customer',
    //     'last_name'     => 'Name',
    //     'email'         => 'customer@example.com',
    //     'phone'         => '08123456789',
    // ];

    // $transactionData = [
    //     'transaction_details' => $transactionDetails,
    //     'item_details'         => $itemDetails,
    //     'customer_details'     => $customerDetails,
    // ];

    // try {
    //     $snapToken = Snap::getSnapToken($transactionData);
    //     return response()->json(['snap_token' => $snapToken]);
    // } catch (\Exception $e) {
    //     // Debugging purpose
    //     dd($e->getMessage()); // Dump error message for debugging
    //     return response()->json(['error' => $e->getMessage()], 500);
    // }
}


    public function handleNotification(Request $request)
    {
        $payload = $request->all();

        // Handle notification data
        $orderId = $payload['order_id'];
        $status = $payload['transaction_status'];

        // Update order status based on transaction status
        // For example, save to database

        return response()->json(['status' => 'success']);
    }
}

