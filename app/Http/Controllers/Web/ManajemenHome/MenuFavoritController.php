<?php
namespace App\Http\Controllers\Web\ManajemenHome;

use App\Http\Controllers\Controller;
use App\Services\HomeItemsApiService;
use App\Services\HomeSettingsApiService;
use Illuminate\Http\Request;

class MenuFavoritController extends Controller
{
    protected $itemsApi;
    protected $settingsApi;
    private const ITEM_TYPE = 'MenuFav';

    public function __construct(HomeItemsApiService $itemsApi, HomeSettingsApiService $settingsApi)
    {
        $this->itemsApi = $itemsApi;
        $this->settingsApi = $settingsApi;
    }

    public function index()
    {
        $settingsRaw = $this->settingsApi->getSettings();
        $settings = collect($settingsRaw)->pluck('settingValue', 'settingKey');

        $data = [
            'title' => 'Manajemen Home',
            'subTitle' => 'Section Menu Favorit',
            'items' => $this->itemsApi->getAll(self::ITEM_TYPE),
            'settings' => $settings
        ];
        return view('menu-favorit.index', $data);
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'menuFavoritTitle' => 'required|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            $this->settingsApi->updateOneSetting($key, $value);
        }

        return redirect()->route('menu-favorit.index')->with('success', 'Pengaturan seksi berhasil diperbarui.');
    }

    public function create()
    {
        return view('menu-favorit.create', ['title' => 'Manajemen Home', 'subTitle' => 'Tambah Menu Favorit']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        
        $validated['item_type'] = self::ITEM_TYPE;
        
        $this->itemsApi->create($validated, $request->file('image'));
        return redirect()->route('menu-favorit.index')->with('success', 'Menu Favorit berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = $this->itemsApi->findById($id);
        if (!$item) { abort(404); }
        return view('menu-favorit.edit', ['title' => 'Manajemen Home', 'subTitle' => 'Edit Menu Favorit', 'item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        
        $validated['item_type'] = self::ITEM_TYPE;
        
        $this->itemsApi->update($id, $validated, $request->file('image'));
        return redirect()->route('menu-favorit.index')->with('success', 'Menu Favorit berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->itemsApi->delete($id);
        return redirect()->route('menu-favorit.index')->with('success', 'Menu Favorit berhasil dihapus.');
    }
}