<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Service::orderBy('sort_order')->get()
        );
    }

    public function show(Service $service): JsonResponse
    {
        return response()->json($service);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:150', 'unique:services,slug'],
            'icon' => ['nullable', 'string', 'max:100'],
            'summary' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'features' => ['nullable', 'array'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        return response()->json(Service::create($data), 201);
    }

    public function update(Request $request, Service $service): JsonResponse
    {
        $data = $request->validate([
            'title' => ['sometimes', 'string', 'max:150'],
            'slug' => ['sometimes', 'string', 'max:150', 'unique:services,slug,' . $service->id],
            'icon' => ['nullable', 'string', 'max:100'],
            'summary' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'features' => ['nullable', 'array'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $service->update($data);

        return response()->json($service);
    }

    public function destroy(Service $service): JsonResponse
    {
        $service->delete();

        return response()->json(null, 204);
    }
}
