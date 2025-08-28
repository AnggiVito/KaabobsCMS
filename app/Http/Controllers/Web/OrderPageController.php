<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\OrderPageApiService;
use Illuminate\Http\Request;

class OrderPageController extends Controller
{
    protected $orderPageApi;

    public function __construct(OrderPageApiService $orderPageApi)
    {
        $this->orderPageApi = $orderPageApi;
    }

    public function index()
    {
        return view('order-page.index', [
            'title' => 'Pengaturan Halaman',
            'subTitle' => 'Kelola Halaman Order',
            'settings' => $this->orderPageApi->getPageSettings()
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'header_title' => 'required|string',
            'header_desc1' => 'required|string',
            'header_desc2' => 'required|string',
            'header_image' => 'nullable|image|max:2048',
            'section_title' => 'required|string',
            'order_options.*.name' => 'nullable|string',
            'order_options.*.url' => 'nullable|string|url',
            'order_options.*.image' => 'nullable|image|max:2048',
        ]);

        $this->orderPageApi->updatePageSettings($validated);
        
        return redirect()->back()->with('success', 'Halaman Order berhasil diperbarui.');
    }
}