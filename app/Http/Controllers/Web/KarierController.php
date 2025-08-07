<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\KarierApiService;
use Illuminate\Http\Request;

class KarierController extends Controller
{
    protected $karierApi;

    public function __construct(KarierApiService $karierApi)
    {
        $this->karierApi = $karierApi;
    }

    public function index()
    {
        $data = [
            'title' => 'Karier',
            'subTitle' => 'Daftar Lowongan',
            'kariers' => $this->karierApi->getAll()
        ];
        return view('karier.index', $data);
    }

    public function create()
    {
        return view('karier.create', ['title' => 'Karier', 'subTitle' => 'Tambah Lowongan']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'posting' => 'required|date',
            'namaposisi' => 'required|string|min:3',
            'kota' => 'required|string|min:3',
            'provinsi' => 'required|string|min:2',
            'workplace' => 'required|string',
            'worktype' => 'required|string',
            'paytype' => 'required|string',
            'payrangeFrom' => 'nullable|numeric',
            'payrangeTo' => 'nullable|numeric',
            'deskripsi' => 'required|string|min:10',
            'jobSummary' => 'required|string|min:10',
            'jobRequirement' => 'required|string|min:10',
        ]);

        $this->karierApi->create($validatedData);

        return redirect()->route('karier.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $karier = $this->karierApi->findById($id);
        if (!$karier) {
            abort(404);
        }

        $data = [
            'title' => 'Karier',
            'subTitle' => 'Edit Lowongan',
            'karier' => $karier
        ];
        return view('karier.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'posting' => 'required|date',
            'namaposisi' => 'required|string|min:3',
            'kota' => 'required|string|min:3',
            'provinsi' => 'required|string|min:2',
            'workplace' => 'required|string',
            'worktype' => 'required|string',
            'paytype' => 'required|string',
            'payrangeFrom' => 'nullable|numeric',
            'payrangeTo' => 'nullable|numeric',
            'deskripsi' => 'required|string|min:10',
            'jobSummary' => 'required|string|min:10',
            'jobRequirement' => 'required|string|min:10',
        ]);
        
        $this->karierApi->update($id, $validatedData);

        return redirect()->route('karier.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->karierApi->delete($id);

        return redirect()->route('karier.index')->with('success', 'Lowongan berhasil dihapus.');
    }
}