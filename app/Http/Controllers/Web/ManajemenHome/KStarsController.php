<?php

namespace App\Http\Controllers\Web\ManajemenHome;

use App\Http\Controllers\Controller;
use App\Services\HomeItemsApiService;
use Illuminate\Http\Request;

class KStarsController extends Controller
{
    protected $itemsApi;
    private const ITEM_TYPE = 'kStar';

    public function __construct(HomeItemsApiService $itemsApi)
    {
        $this->itemsApi = $itemsApi;
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Home',
            'subTitle' => 'Section K-Stars',
            'items' => $this->itemsApi->getAll(self::ITEM_TYPE)
        ];
        return view('manajemen-home.k-stars.index', $data);
    }

    public function create()
    {
        return view('manajemen-home.k-stars.create', ['title' => 'Manajemen Home', 'subTitle' => 'Tambah Gambar K-Stars']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        
        $validated['item_type'] = self::ITEM_TYPE;
        
        $this->itemsApi->create($validated, $request->file('image'));
        
        return redirect()->route('k-stars.index')->with('success', 'Gambar K-Stars berhasil ditambahkan.');
    }

    public function show($id)
    {
        return redirect()->route('k-stars.index');
    }

    public function edit($id)
    {
        $item = $this->itemsApi->findById($id);
        if (!$item) { abort(404); }
        return view('manajemen-home.k-stars.edit', ['title' => 'Manajemen Home', 'subTitle' => 'Edit Gambar K-Stars', 'item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        
        $validated['item_type'] = self::ITEM_TYPE;
        
        $this->itemsApi->update($id, $validated, $request->file('image'));

        return redirect()->route('k-stars.index')->with('success', 'Gambar K-Stars berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->itemsApi->delete($id);
        return redirect()->route('k-stars.index')->with('success', 'Gambar K-Stars berhasil dihapus.');
    }
}