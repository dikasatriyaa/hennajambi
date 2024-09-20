<?php

// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getServices()
    {
        $tokoId = auth()->user()->toko->id;
    
        // Ambil semua layanan yang terkait dengan ID toko
        $services = Service::where('toko_id', $tokoId)->get();
    
        // Mendekode gambar jika disimpan sebagai JSON
        foreach ($services as $service) {
            $service->image = json_decode($service->image, true); // Dekode JSON menjadi array
        }
    
        return response()->json($services);
    }
    
    // Menampilkan semua data service
    public function index()
    {
        return view('admin.services.index');
    }

    // Menampilkan form untuk membuat service baru
    public function create()
    {
        return view('admin.services.create');
    }

    // Menyimpan service baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'toko_id' => 'required',
            'name' => 'required|string',
            'price' => 'required|string',
            'category' => 'required|string',
            'deskripsi' => 'required|string',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('service_images', 'public');
                $imagePaths[] = $imagePath;
            }
        }

        Service::create([
            'toko_id' => $request->toko_id,
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'deskripsi' => $request->deskripsi,
            'image' => json_encode($imagePaths),
        ]);

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');

        // return json_encode($imagePaths);
    }
    
    

    // Menampilkan detail service berdasarkan ID
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('services.show', compact('service'));
    }

    // Menampilkan form untuk mengedit service
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    // Mengupdate service di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'price' => 'required|string',
            'category' => 'required|string',
            'deskripsi' => 'required|string',
            'image' => 'required|string',
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    // Menghapus service dari database
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Service deleted successfully.');
    }
}

