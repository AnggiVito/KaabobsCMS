<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\SubmissionApiService;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    protected $submissionApi;

    public function __construct(SubmissionApiService $submissionApi)
    {
        $this->submissionApi = $submissionApi;
    }

    public function index()
    {
        $data = [
            'title' => 'Lamaran Masuk',
            'subTitle' => 'Daftar Lamaran',
            'submissions' => $this->submissionApi->getAll()
        ];
        return view('submission.index', $data);
    }

    public function shortlist()
    {
        $allSubmissions = $this->submissionApi->getAll();

        $shortlisted = collect($allSubmissions)->where('status', 2);

        return view('submission.shortlist', [
            'title' => 'Lamaran Masuk',
            'subTitle' => 'Kandidat Shortlist',
            'submissions' => $shortlisted
        ]);
    }

    public function interview()
    {
        $allSubmissions = $this->submissionApi->getAll();

        $interviewees = collect($allSubmissions)->where('status', 3);

        return view('submission.interview', [
            'title' => 'Lamaran Masuk',
            'subTitle' => 'Kandidat Interview',
            'submissions' => $interviewees
        ]);
    }

    public function show($id)
    {
        $submission = $this->submissionApi->findById($id);
        if (!$submission) {
            abort(404);
        }

        $data = [
            'title' => 'Lamaran Masuk',
            'subTitle' => 'Detail Lamaran',
            'submission' => $submission
        ];
        return view('submission.show', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|integer|in:1,2,3'
        ]);

        $this->submissionApi->updateStatus($id, $validated['status']);

        return redirect()->route('submission.show', $id)->with('success', 'Status lamaran berhasil diperbarui.');
    }
}