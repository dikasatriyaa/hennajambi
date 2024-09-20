<?php

// app/Http/Controllers/PembayaranController.php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pembayaran;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    public function getBookedDates(Request $request)
    {
        $tokoId = $request->input('toko_id');
        $bookedDates = Pembayaran::where('toko_id', $tokoId)
                                ->pluck('tanggal_booking')
                                ->toArray();

        return response()->json(['booked_dates' => $bookedDates]);
    }

    public function storeUser(Request $request)
    {
        Pembayaran::create($request->all());
        
        return response()->json($request->all());
    
    }

    private function generateInvoiceCode()
    {
        return 'INV-' . strtoupper(Str::random(10));
    }

    public function daftarPengajuan()
    {
        $pengajuan = Pembayaran::where('status_pencairan', 'Diajukan')->get();
        return view('admin.pencairan', compact('pengajuan'));
    }

    public function danaMasuk()
    {
        $pengajuan = Pembayaran::where('status_pencairan', 'Dikonfirmasi')->get();
        return view('admin.dana', compact('pengajuan'));
    }

    public function konfirmasiPengajuan(Request $request, $id)
    {
    $request->validate([
        'bukti_pencairan' => 'required|file|mimes:jpg,jpeg,png,pdf',
    ]);

    $pembayaran = Pembayaran::find($id);

    if ($request->hasFile('bukti_pencairan')) {
        $buktiPath = $request->file('bukti_pencairan')->store('bukti_pencairan');
        $pembayaran->bukti_pencairan = $buktiPath;
    }

    $pembayaran->status_pencairan = 'Dikonfirmasi';
    $pembayaran->save();

    return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan berhasil dikonfirmasi.');
    }


    public function updateStatusPesanan($id, Request $request)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status_pesanan = $request->status_pesanan;
        $pembayaran->save();

        return response()->json(['message' => 'Status pesanan berhasil diperbarui.']);
    }

    public function ajukanPencairan($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status_pencairan = 'Diajukan';
        $pembayaran->save();

        return response()->json(['message' => 'Pencairan berhasil diajukan.']);
    }

    public function updateKonfirmasi(Request $request, $id)
    {
    $pembayaran = Pembayaran::find($id);
    $pembayaran->update([
        'konfirmasi' => $request->konfirmasi
    ]);

    return response()->json(['message' => 'Konfirmasi updated successfully']);
}

    public function getByToko()
    {
        // Ambil ID toko dari pengguna yang sedang login
        $tokoId = auth()->user()->toko->id;

        // Ambil semua pembayaran berdasarkan ID toko
        $pembayarans = Pembayaran::where('toko_id', $tokoId)
            ->with(['service'])
            ->get();

        return response()->json($pembayarans);
    }


    public function checkAvailability(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['available' => false], 400);
        }

        // Ambil tanggal dari request
        $date = $request->input('date');

        // Cek apakah tanggal sudah ada di tabel pembayarans
        $exists = Pembayaran::where('tanggal_booking', $date)->exists();

        return response()->json(['available' => !$exists]);
    }
    // Menampilkan semua data pembayaran
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();
        
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->price * $item->quantity;
        }

        return view('checkout', compact('cartItems', 'totalPrice'));
    }

    public function admin()
    {
        return view('admin.pembayaran.index');
    }

    // Menampilkan form untuk membuat pembayaran baru
    public function create()
    {
        $users = User::all(); // Ambil semua pengguna
        $services = Service::where('toko_id', auth()->user()->toko->id)->get(); // Ambil semua layanan dari toko pengguna

        return view('admin.pembayaran.create', compact('users','services'));
    }

    // Menyimpan pembayaran baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'toko_id' => 'required|exists:tokos,id',
            'service_id' => 'required|exists:services,id',
            'invoice_code' => 'required|string',
            'jumlah_pesanan' => 'required|integer',
            'total_bayar' => 'required|integer',
            'status' => 'required|string',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran created successfully.');
    }

    // Menampilkan detail pembayaran berdasarkan ID
    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayaran.show', compact('pembayaran'));
    }

    // Menampilkan form untuk mengedit pembayaran
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayarans.edit', compact('pembayaran'));
    }

    // Mengupdate pembayaran di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,paid,cancelled',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = $request->status;
        $pembayaran->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }

    // Menghapus pembayaran dari database
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran deleted successfully.');
    }
}
