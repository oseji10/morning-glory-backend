<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProposalRequest;
use App\Models\ProposalRequest as ProposalRequestModel;
use Illuminate\Http\JsonResponse;

class ProposalController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            ProposalRequestModel::latest()->paginate(20)
        );
    }

    public function store(StoreProposalRequest $request): JsonResponse
    {
        $proposal = ProposalRequestModel::create([
            ...$request->validated(),
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Thanks — your proposal request has been received.',
            'data' => $proposal,
        ], 201);
    }
}
