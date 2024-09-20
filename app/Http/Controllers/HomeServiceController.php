<?php

// app/Http/Controllers/HomeServiceController.php

namespace App\Http\Controllers;

use App\Models\HomeService;
use Illuminate\Http\Request;

class HomeServiceController extends Controller
{
    // Menampilkan semua data home service
    public function index()
    {
        $homeServices = HomeService::all();
        return view('home_services.index', compact('homeServices'));
    }

    // Menampilkan form untuk membuat home service baru
    public function create()
    {
        return view('home_services.create');
    }

    // Menyimpan home service baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cost_jarak' => 'required|integer',
            'max_jarak' => 'required|integer',
        ]);

        HomeService::create($request->all());

        return redirect()->route('home_services.index')
            ->with('success', 'Home service created successfully.');
    }

    // Menampilkan detail home service berdasarkan ID
    public function show($id)
    {
        $homeService = HomeService::findOrFail($id);
        return view('home_services.show', compact('homeService'));
    }

    // Menampilkan form untuk mengedit home service
    public function edit($id)
    {
        $homeService = HomeService::findOrFail($id);
        return view('home_services.edit', compact('homeService'));
    }

    // Mengupdate home service di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cost_jarak' => 'required|integer',
            'max_jarak' => 'required|integer',
        ]);

        $homeService = HomeService::findOrFail($id);
        $homeService->update($request->all());

        return redirect()->route('home_services.index')
            ->with('success', 'Home service updated successfully.');
    }

    // Menghapus home service dari database
    public function destroy($id)
    {
        $homeService = HomeService::findOrFail($id);
        $homeService->delete();

        return redirect()->route('home_services.index')
            ->with('success', 'Home service deleted successfully.');
    }
}

