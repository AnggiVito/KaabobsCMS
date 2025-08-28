<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\NavbarApiService;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    protected $navbarApi;
    
    public function __construct(NavbarApiService $navbarApi)
    {
        $this->navbarApi = $navbarApi;
    }

    public function index()
    {
        $logoItem = collect($this->navbarApi->getAll('Logo'))->first();

        $data = [
            'title' => 'Manajemen Navbar',
            'subTitle' => 'Pengaturan Tampilan Navbar',
            'thumbItems' => $this->navbarApi->getAll('Thumb'),
            'linkItems' => $this->navbarApi->getAll('Link'),
            'navLinkItems' => $this->navbarApi->getAll('NavLink'),
            'tentangLinkItems' => $this->navbarApi->getAll('TentangLink'),
            'logoItem' => $logoItem,
        ];
        return view('navbar.index', $data);
    }

    public function updateLogo(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:png,svg,webp|max:1024',
        ]);
        
        $logo = collect($this->navbarApi->getAll('Logo'))->first();
        $validated['item_type'] = 'Logo';

        if ($logo) {
            $this->navbarApi->update($logo['id'], $validated, $request->file('image'));
        } else {
            $this->navbarApi->create($validated, $request->file('image'));
        }

        return redirect()->route('navbar.index')->with('success', 'Logo berhasil diperbarui.');
    }

    public function createNavLink()
    {
        return view('navbar.create-navlink', ['title' => 'Manajemen Navbar', 'subTitle' => 'Tambah Link Navigasi Utama']);
    }

    public function storeNavLink(Request $request)
    {
        $validated = $request->validate(['title' => 'required|string', 'link_url' => 'required|string', 'sort_order' => 'nullable|integer']);
        $validated['item_type'] = 'NavLink';
        $this->navbarApi->create($validated, null);
        return redirect()->route('navbar.index')->with('success', 'Link Navigasi Utama berhasil ditambahkan.');
    }

    public function createThumb()
    {
        return view('navbar.create-thumb', ['title' => 'Manajemen Navbar', 'subTitle' => 'Tambah Gambar Dropdown']);
    }

    public function storeThumb(Request $request)
    {
        $validated = $request->validate(['image' => 'required|image|mimes:png,webp,jpg|max:1024', 'sort_order' => 'nullable|integer']);
        $validated['item_type'] = 'Thumb';
        $this->navbarApi->create($validated, $request->file('image'));
        return redirect()->route('navbar.index')->with('success', 'Gambar berhasil ditambahkan.');
    }

    public function destroyThumb($id)
    {
        $this->navbarApi->delete($id);
        return redirect()->route('navbar.index')->with('success', 'Gambar berhasil dihapus.');
    }

    public function createLink()
    {
        return view('navbar.create-link', ['title' => 'Manajemen Navbar', 'subTitle' => 'Tambah Link Dropdown Menu']);
    }

    public function storeLink(Request $request)
    {
        $validated = $request->validate(['title' => 'required|string', 'link_url' => 'required|string', 'sort_order' => 'nullable|integer']);
        $validated['item_type'] = 'Link';
        $this->navbarApi->create($validated, null);
        return redirect()->route('navbar.index')->with('success', 'Link Dropdown Menu berhasil ditambahkan.');
    }
    
    public function editLink($id)
    {
        $item = $this->navbarApi->findById($id);
        return view('navbar.edit-link', ['title' => 'Manajemen Navbar', 'subTitle' => 'Edit Link Dropdown', 'item' => $item]);
    }

    public function updateLink(Request $request, $id)
    {
        $validated = $request->validate(['title' => 'required|string', 'link_url' => 'required|string', 'sort_order' => 'nullable|integer']);
        $validated['item_type'] = 'Link';
        $this->navbarApi->update($id, $validated, null);
        return redirect()->route('navbar.index')->with('success', 'Link berhasil diperbarui.');
    }

    public function destroyLink($id)
    {
        $this->navbarApi->delete($id);
        return redirect()->route('navbar.index')->with('success', 'Link berhasil dihapus.');
    }

    public function createTentangLink()
    {
        return view('navbar.create-tentanglink', [
            'title' => 'Manajemen Navbar', 
            'subTitle' => 'Tambah Link Dropdown Tentang'
        ]);
    }

    public function storeTentangLink(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'link_url' => 'required|string',
            'sort_order' => 'nullable|integer'
        ]);
        $validated['item_type'] = 'TentangLink';
        $this->navbarApi->create($validated, null);
        return redirect()->route('navbar.index')->with('success', 'Link Tentang Kabobs berhasil ditambahkan.');
    }

    public function editTentangLink($id)
    {
        $item = $this->navbarApi->findById($id);
        if (!$item) { abort(404); }
        return view('navbar.edit-tentanglink', [
            'title' => 'Manajemen Navbar',
            'subTitle' => 'Edit Link Dropdown Tentang',
            'item' => $item
        ]);
    }

    public function updateTentangLink(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'link_url' => 'required|string',
            'sort_order' => 'nullable|integer'
        ]);
        $validated['item_type'] = 'TentangLink';
        $this->navbarApi->update($id, $validated, null);
        return redirect()->route('navbar.index')->with('success', 'Link Tentang Kabobs berhasil diperbarui.');
    }

    public function destroyTentangLink($id)
    {
        $this->navbarApi->delete($id);
        return redirect()->route('navbar.index')->with('success', 'Link Tentang Kabobs berhasil dihapus.');
    }
}