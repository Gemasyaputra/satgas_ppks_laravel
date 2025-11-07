<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(9); // 9 agar pas 3x3 grid
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $this->validateService($request);
        Service::create($request->all());
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function update(Request $request, Service $service)
    {
        $this->validateService($request);
        $service->update($request->all());
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }

    // Helper validasi
    private function validateService(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'phone' => 'required|string|max:255', // Bisa email atau telepon
            'icon' => 'nullable|string|max:50',
        ]);
    }
}