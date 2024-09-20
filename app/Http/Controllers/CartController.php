<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Midtrans\Snap;
use Midtrans\Config;

class CartController extends Controller
{
    public function __construct()
    {
        // Initialize Midtrans configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION') === 'false';
        // Config::$isSanitized = true;
        // Config::$is3ds = true;
    }

    public function clear(Request $request)
    {
        $userId = $request->user()->id;
        Cart::where('user_id', $userId)->delete();
    
        return response()->json(['message' => 'Cart cleared successfully.']);
    }

    public function checkout(Request $request)
    {
        // return response()->json([$request->all()]);
        // // Validasi input data
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'toko_id' => 'required|integer',
            'service_id' => 'required|integer',
            'tanggal_booking' => 'required|date',
            'jumlah_pesanan' => 'required|integer',
            'total_bayar' => 'required|string', // Format harga dalam string
        ]);

        // Convert total_bayar dari format string ke angka
        $totalBayar = $this->convertToNumber($validated['total_bayar']);

        // Buat transaksi dengan Midtrans
        $orderId = 'ORD-' . time(); // Generate unique order ID
        $transactionData = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalBayar, // Total amount in IDR
            ],
            'customer_details' => [
                'first_name' => 'Customer', // Adjust as needed
                'email' => 'customer@example.com', // Adjust as needed
                'phone' => '081234567890', // Adjust as needed
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($transactionData);
            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            // Handle error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function convertToNumber($formattedNumber)
    {
        // Remove currency symbol and thousands separators, replace comma with dot for decimal
        return floatval(str_replace(['Rp ', '.', ','], ['', '', '.'], $formattedNumber));
    }


    public function updateCart(Request $request)
{
    $cartItem = Cart::find($request->id);
    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    $cartItems = Cart::where('user_id', $request->user()->id)->with('toko')->get();
    
    return response()->json(['cart' => $cartItems]);
}


    public function getCartItems(Request $request)
    {
        $user_id = $request->user()->id; // Ambil ID user yang sedang login
        $cartItems = Cart::where('user_id', $user_id)->with('service')->get();
        
        return response()->json($cartItems);
    }
    // Tampilkan keranjang belanja
    public function index()
    {
        $userId = auth()->id();
        $carts = Cart::where('user_id', $userId)->get();
        return response()->json($carts);
    }

    // Tambah item ke keranjang
    public function store(Request $request)
    {
        $cart = Cart::create([
            'user_id' => auth()->id(),
            'toko_id' => $request->toko_id,
            'service_id' => $request->service_id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $request->image
        ]);
        // return response()->json($cart, 201);
        return response()->json($request->all());
    }

    // Update item di keranjang
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update($request->all());
        return response()->json($cart);
    }

    // Hapus item dari keranjang
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json(null, 204);
    }
}

