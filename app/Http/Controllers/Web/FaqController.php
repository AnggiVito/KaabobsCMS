<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\FaqApiService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $faqApi;

    public function __construct(FaqApiService $faqApi)
    {
        $this->faqApi = $faqApi;
    }

    public function index()
    {
        $data = [
            'title' => 'FAQ',
            'subTitle' => 'List FAQ',
            'faqs' => $this->faqApi->getAll()
        ];
        return view('faq.index', $data);
    }

    public function create()
    {
        return view('faq.create', ['title' => 'FAQ', 'subTitle' => 'Tambah FAQ']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|min:10',
            'answer' => 'required|string|min:10',
        ]);

        $this->faqApi->create($validatedData);

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $faq = $this->faqApi->findById($id);
        if (!$faq) {
            abort(404);
        }

        $data = [
            'title' => 'FAQ',
            'subTitle' => 'Edit FAQ',
            'faq' => $faq
        ];
        return view('faq.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|min:10',
            'answer' => 'required|string|min:10',
        ]);

        $this->faqApi->update($id, $validatedData);

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->faqApi->delete($id);

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil dihapus.');
    }
}