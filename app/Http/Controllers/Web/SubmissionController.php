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
}