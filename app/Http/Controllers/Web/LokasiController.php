<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\LokasiApiService;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    protected $lokasiApi;

    public function __construct(LokasiApiService $lokasiApi)
    {
        $this->lokasiApi = $lokasiApi;
    }

    public function index()
    {
        $data = [
            'title' => 'Lokasi',
            'subTitle' => 'Daftar Lokasi',
            'locations' => $this->lokasiApi->getAll()
        ];
        return view('lokasi.index', $data);
    }

    public function create()
    {
        return view('lokasi.create', ['title' => 'Lokasi', 'subTitle' => 'Tambah Lokasi']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'address' => 'required|string|min:10',
            'map_url' => 'required|url',
            'region_name' => 'required|string|min:2',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $this->lokasiApi->create($validatedData);

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $location = $this->lokasiApi->findById($id);
        if (!$location) {
            abort(404);
        }

        $data = [
            'title' => 'Lokasi',
            'subTitle' => 'Edit Lokasi',
            'location' => $location
        ];
        return view('lokasi.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'address' => 'required|string|min:10',
            'map_url' => 'required|url',
            'region_name' => 'required|string|min:2',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $this->lokasiApi->update($id, $validatedData);

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->lokasiApi->delete($id);

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}