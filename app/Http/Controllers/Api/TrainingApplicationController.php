<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrainingApplicationRequest;
use App\Models\TrainingApplication;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TrainingApplicationController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            TrainingApplication::latest()->paginate(20)
        );
    }

    public function store(StoreTrainingApplicationRequest $request): JsonResponse
    {
        $application = TrainingApplication::create([
            ...$request->validated(),
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Thanks — your application has been received. We will review it and reach out with next steps.',
            'data' => $application,
        ], 201);
    }

    public function update(Request $request, TrainingApplication $trainingApplication): JsonResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,reviewed,accepted,enrolled,rejected'],
        ]);

        $trainingApplication->update($request->only('status'));

        return response()->json(['data' => $trainingApplication]);
    }
}
