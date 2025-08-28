<?php
namespace App\Http\Controllers\Web\ManajemenHome;

use App\Http\Controllers\Controller;
use App\Services\HomeItemsApiService;
use App\Services\HomeSettingsApiService;
use Illuminate\Http\Request;

class PenawaranController extends Controller
{
    protected $itemsApi;
    protected $settingsApi;
    private const ITEM_TYPE = 'Penawaran';

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
            'subTitle' => 'Section Penawaran Spesial',
            'items' => $this->itemsApi->getAll(self::ITEM_TYPE),
            'settings' => $settings
        ];
        return view('penawaran.index', $data);
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'penawaranSpesialTitle' => 'required|string|max:255',
            'penawaranFixedImage' => 'nullable|image|max:2048', 
        ]);

        foreach ($validated as $key => $value) {
            $this->settingsApi->updateOneSetting($key, $value);
        }

        return redirect()->route('penawaran.index')->with('success', 'Pengaturan seksi berhasil diperbarui.');
    }

    public function create()
    {
        return view('penawaran.create', ['title' => 'Manajemen Home', 'subTitle' => 'Tambah Item Penawaran']);
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
        return redirect()->route('penawaran.index')->with('success', 'Item Penawaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = $this->itemsApi->findById($id);
        if (!$item) { abort(404); }
        return view('penawaran.edit', ['title' => 'Manajemen Home', 'subTitle' => 'Edit Item Penawaran', 'item' => $item]);
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
        return redirect()->route('penawaran.index')->with('success', 'Item Penawaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->itemsApi->delete($id);
        return redirect()->route('penawaran.index')->with('success', 'Item Penawaran berhasil dihapus.');
    }
}