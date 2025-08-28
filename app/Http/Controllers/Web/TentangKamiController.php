<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Services\TentangKamiApiService;
use Illuminate\Http\Request;

class TentangKamiController extends Controller {
    protected $tentangKamiApi;
    public function __construct(TentangKamiApiService $tentangKamiApi) { $this->tentangKamiApi = $tentangKamiApi; }

    public function index() {
        return view('tentang-kami.index', [
            'title' => 'Tentang Kami',
            'subTitle' => 'Kelola Halaman',
            'settings' => $this->tentangKamiApi->getSettings()
        ]);
    }

    public function update(Request $request) {
        $request->validate([
            'store_count' => 'required|string',
            'store_description' => 'required|string',
            'rating_title' => 'required|string',
            'rating_description' => 'required|string',
            'about_us_title' => 'required|string',
            'about_us_body1' => 'required|string',
            'about_us_body2' => 'required|string',
            'img_utama_src' => 'nullable|image|max:2048',
            'img_sosmed1_src' => 'nullable|image|max:2048',
        ]);

        $this->tentangKamiApi->updateSettings($request->except('_token'));
        return redirect()->back()->with('success', 'Halaman Tentang Kami berhasil diperbarui.');
    }
}