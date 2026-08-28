<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Insight;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InsightController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Insight::whereNotNull('published_at')
            ->orderByDesc('published_at');

        if ($category = $request->query('category')) {
            $query->where('category', $category);
        }

        return response()->json($query->paginate(10));
    }

    public function show(Insight $insight): JsonResponse
    {
        return response()->json($insight);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['required', 'string', 'max:200', 'unique:insights,slug'],
            'category' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
        ]);

        return response()->json(Insight::create($data), 201);
    }

    public function update(Request $request, Insight $insight): JsonResponse
    {
        $data = $request->validate([
            'title' => ['sometimes', 'string', 'max:200'],
            'slug' => ['sometimes', 'string', 'max:200', 'unique:insights,slug,' . $insight->id],
            'category' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
        ]);

        $insight->update($data);

        return response()->json($insight);
    }

    public function destroy(Insight $insight): JsonResponse
    {
        $insight->delete();

        return response()->json(null, 204);
    }
}
