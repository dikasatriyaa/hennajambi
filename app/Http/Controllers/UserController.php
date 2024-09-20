<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Service;
use App\Models\Toko;
use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User sudah di-import
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;
use PDF;

class UserController extends Controller
{
    public function generatePDF()
    {
// Mengambil data dari beberapa tabel
$users = User::all();
$services = Service::all();
$tokos = Toko::all();
$pembayarans = Pembayaran::with('service', 'toko', 'user')->get();

// Render Blade view sebagai template PDF
$html = view('laporan.pdf', compact('users', 'services', 'tokos', 'pembayarans'))->render();

// Inisialisasi objek Mpdf
$mpdf = new Mpdf([
    'format' => 'A4',
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_left' => 10,
    'margin_right' => 10
]);

// Menulis HTML ke dalam PDF
$mpdf->WriteHTML($html);

// Mengatur header atau footer (opsional)
$mpdf->SetHeader('Laporan Data');
$mpdf->SetFooter('{PAGENO}');

// Output PDF (sebagai download atau inline di browser)
return $mpdf->Output('laporan_data.pdf', 'I');
    }
    public function getUsers(Request $request)
    {
        $users = User::all();
        return response()->json($users);
    }

    public function changeRole(Request $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $user->role = $request->input('role');
        $user->update();

        return redirect()->back()->with('success', 'Role berhasil diubah!');
    }

    public function index()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function create()
    {
        return view('admin.profiles.create');
    }

    public function userList()
    {
        return view('admin.user');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            // Tambahkan validasi untuk kolom lainnya
        ]);

        // Simpan data ke dalam database
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            // Tambahkan atribut lain sesuai kebutuhan
        ]);
        $user->save();

        return redirect()->route('admin.profiles.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profiles.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profiles.edit', compact('user'));
    }

    public function update(Request $request)
    {


        // Update data toko berdasarkan ID
        $user = User::findOrFail($request->id);
        $user->update($request->all());


        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui');
        // return $request->all();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'User deleted successfully.');
    }

    
}
