<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CaseStudyController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            CaseStudy::whereNotNull('published_at')
                ->orderByDesc('published_at')
                ->get()
        );
    }

    public function show(CaseStudy $caseStudy): JsonResponse
    {
        return response()->json($caseStudy);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:150', 'unique:case_studies,slug'],
            'summary' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'industry' => ['nullable', 'string', 'max:150'],
            'stats' => ['nullable', 'array'],
            'published_at' => ['nullable', 'date'],
        ]);

        return response()->json(CaseStudy::create($data), 201);
    }

    public function update(Request $request, CaseStudy $caseStudy): JsonResponse
    {
        $data = $request->validate([
            'title' => ['sometimes', 'string', 'max:150'],
            'slug' => ['sometimes', 'string', 'max:150', 'unique:case_studies,slug,' . $caseStudy->id],
            'summary' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'industry' => ['nullable', 'string', 'max:150'],
            'stats' => ['nullable', 'array'],
            'published_at' => ['nullable', 'date'],
        ]);

        $caseStudy->update($data);

        return response()->json($caseStudy);
    }

    public function destroy(CaseStudy $caseStudy): JsonResponse
    {
        $caseStudy->delete();

        return response()->json(null, 204);
    }
}
