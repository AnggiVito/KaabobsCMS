<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\FaqApiService;
use App\Services\KarierApiService;
use App\Services\LokasiApiService;

class DashboardController extends Controller
{
    protected $karierApi;
    protected $lokasiApi;
    protected $faqApi;

    public function __construct(
        KarierApiService $karierApi, 
        LokasiApiService $lokasiApi, 
        FaqApiService $faqApi
    ) {
        $this->karierApi = $karierApi;
        $this->lokasiApi = $lokasiApi;
        $this->faqApi = $faqApi;
    }

    public function index()
    {
        $allKariers = $this->karierApi->getAll();
        $allLocations = $this->lokasiApi->getAll();
        $allFaqs = $this->faqApi->getAll();
        $latestKariers = collect($allKariers)->sortByDesc('dbCreatedAt')->take(5);
        $latestLocations = collect($allLocations)->sortByDesc('created_at')->take(5);
        $latestFaqs = collect($allFaqs)->sortByDesc('created_at')->take(5);

        $data = [
            'title' => 'Dashboard',
            'subTitle' => '',
            'totalKarier' => count($allKariers),
            'totalLokasi' => count($allLocations),
            'totalFaq' => count($allFaqs),
            'latestKariers' => $latestKariers,
            'latestLocations' => $latestLocations,
            'latestFaqs' => $latestFaqs,
        ];

        return view('dashboard.index', $data);
    }
}