<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\MenuApiService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuApi;

    public function __construct(MenuApiService $menuApi)
    {
        $this->menuApi = $menuApi;
    }

    public function index()
    {
        $data = [
            'title' => 'Menu Produk',
            'subTitle' => 'Daftar Menu',
            'menus' => $this->menuApi->getAll()
        ];
        return view('menu.index', $data);
    }

    public function create()
    {
        return view('menu.create', ['title' => 'Menu Produk', 'subTitle' => 'Tambah Menu']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);

        $this->menuApi->create($validatedData, $request->file('image'));

        return redirect()->route('menu.index')->with('success', 'Menu baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = $this->menuApi->findById($id);
        if (!$menu) {
            abort(404);
        }
        return view('menu.edit', ['title' => 'Menu Produk', 'subTitle' => 'Edit Menu', 'menu' => $menu]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);

        $this->menuApi->update($id, $validatedData, $request->file('image'));

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->menuApi->delete($id);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}