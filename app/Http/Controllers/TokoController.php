<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{

    public function getToko(Request $request)
    {
        $user_id = $request->input('user_id');
        $tokos = Toko::where('user_id', $user_id)->get();
        return response()->json($tokos);
    }

    public function checkToko($toko)
    {
        $tokos = Toko::where('id', $toko)->first();
        return response()->json($tokos);
    }

    // Menampilkan semua toko
    public function index()
    {
        return view('admin.tokos.index');
    }

    public function getAllToko()
    {
        $data = [
            'toko' => Toko::all()
        ];

        return view('admin.penyediaJasa', $data);
    }

    public function calculateShipping(Request $request)
    {
        $userLat = $request->input('user_lat');
        $userLong = $request->input('user_long');
        $toko = Toko::first(); // Assuming there's only one toko

        $distance = Toko::calculateDistance($userLat, $userLong, $toko->lat, $toko->long);
        $shippingCost = $distance > 30 ? 50000 : 0;

        return response()->json([
            'distance' => $distance,
            'shipping_cost' => $shippingCost,
        ]);
    }

    // Menampilkan form untuk menambah toko
    public function create()
    {
        return view('tokos.create');
    }

    // Menyimpan toko baru ke database
    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'name' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        try {
            $toko = Toko::create($request->all());
            $message = 'Toko berhasil ditambahkan';
            
        } catch (\Exception $e) {
            return redirect()->route('toko.index')->with('error', $e);
        }
        return redirect()->route('toko.index')->with('success', $message);
        // return $request->all();
    }
    
    // Menampilkan detail toko berdasarkan ID
    public function show($toko)
    {
        if ($toko) {
            $tokos = Toko::where('id', $toko)->first();
        } else {
            $tokos = null;
        }

        return view('admin.tokos.show', compact('tokos'));
    }

    // Menampilkan form untuk mengedit toko
    public function edit($id)
    {
        $toko = Toko::findOrFail($id);
        return view('tokos.edit', compact('toko'));
    }

    // Update toko berdasarkan ID
    public function update(Request $request)
    {

        // return $request->all();
        $toko = Toko::where('user_id', $request->user_id)->firstOrFail();
        $toko->update($request->all());

        return redirect()->route('toko.index')->with('success', 'Toko berhasil diperbarui');
    }

    // Menghapus toko berdasarkan ID
    public function destroy($id)
    {
        $toko = Toko::findOrFail($id);
        $toko->delete();

        return redirect()->route('tokos.index')->with('success', 'Toko berhasil dihapus');
    }
}
