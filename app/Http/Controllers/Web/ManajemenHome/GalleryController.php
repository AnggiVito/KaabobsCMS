<?php
namespace App\Http\Controllers\Web\ManajemenHome;

use App\Http\Controllers\Controller;
use App\Services\HomeItemsApiService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected $itemsApi;
    private const GALLERY_TYPE = 'Gallery';
    private const SOSMED_ICON_TYPE = 'SosmedIcon';

    public function __construct(HomeItemsApiService $itemsApi)
    {
        $this->itemsApi = $itemsApi;
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Home',
            'subTitle' => 'Section Gallery',
            'galleryItems' => $this->itemsApi->getAll(self::GALLERY_TYPE),
            'sosmedIconItems' => $this->itemsApi->getAll(self::SOSMED_ICON_TYPE)
        ];
        return view('gallery.index', $data);
    }

    public function create()
    {
        return view('gallery.create', ['title' => 'Manajemen Home', 'subTitle' => 'Tambah Gambar Galeri']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['item_type'] = self::GALLERY_TYPE;
        $this->itemsApi->create($validated, $request->file('image'));
        return redirect()->route('gallery.index')->with('success', 'Gambar Galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = $this->itemsApi->findById($id);
        if (!$item) { abort(404); }
        return view('gallery.edit', ['title' => 'Manajemen Home', 'subTitle' => 'Edit Gambar Galeri', 'item' => $item]);
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate(['image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048', 'sort_order' => 'nullable|integer']);
        $validated['item_type'] = self::GALLERY_TYPE;
        $this->itemsApi->update($id, $validated, $request->file('image'));
        return redirect()->route('gallery.index')->with('success', 'Gambar Galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->itemsApi->delete($id);
        return redirect()->route('gallery.index')->with('success', 'Gambar Galeri berhasil dihapus.');
    }

    public function createIcon()
    {
        return view('gallery.create-icon', ['title' => 'Manajemen Home', 'subTitle' => 'Tambah Ikon Media Sosial']);
    }

    public function storeIcon(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link_url' => 'required|url',
            'image' => 'required|image|mimes:svg,png|max:1024',
        ]);
        $validated['item_type'] = self::SOSMED_ICON_TYPE;
        $this->itemsApi->create($validated, $request->file('image'));
        return redirect()->route('gallery.index')->with('success', 'Ikon Media Sosial berhasil ditambahkan.');
    }

    public function editIcon($id)
    {
        $item = $this->itemsApi->findById($id);
        if (!$item) { abort(404); }
        return view('gallery.edit-icon', ['title' => 'Manajemen Home', 'subTitle' => 'Edit Ikon Media Sosial', 'item' => $item]);
    }

    public function updateIcon(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link_url' => 'required|url',
            'image' => 'nullable|image|mimes:svg,png|max:1024',
        ]);
        $validated['item_type'] = self::SOSMED_ICON_TYPE;
        $this->itemsApi->update($id, $validated, $request->file('image'));
        return redirect()->route('gallery.index')->with('success', 'Ikon Media Sosial berhasil diperbarui.');
    }
    
    public function destroyIcon($id)
    {
        $this->itemsApi->delete($id);
        return redirect()->route('gallery.index')->with('success', 'Ikon Media Sosial berhasil dihapus.');
    }
}