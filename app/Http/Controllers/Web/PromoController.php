<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\PromoApiService;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    protected $promoApi;

    public function __construct(PromoApiService $promoApi)
    {
        $this->promoApi = $promoApi;
    }

    public function index()
    {
        $data = [
            'title' => 'Promo',
            'subTitle' => 'Daftar Promo',
            'promos' => $this->promoApi->getAll()
        ];
        return view('promo.index', $data);
    }

    public function create()
    {
        return view('promo.create', ['title' => 'Promo', 'subTitle' => 'Tambah Promo']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'expired' => 'required|date',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $this->promoApi->create($validatedData, $request->file('image'));

        return redirect()->route('promo.index')->with('success', 'Promo baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $promo = $this->promoApi->findById($id);
        if (!$promo) {
            abort(404);
        }
        return view('promo.edit', ['title' => 'Promo', 'subTitle' => 'Edit Promo', 'promo' => $promo]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'expired' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $this->promoApi->update($id, $validatedData, $request->file('image'));

        return redirect()->route('promo.index')->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->promoApi->delete($id);
        return redirect()->route('promo.index')->with('success', 'Promo berhasil dihapus.');
    }
}