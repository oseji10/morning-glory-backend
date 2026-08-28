<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            ContactMessage::latest()->paginate(20)
        );
    }

    public function store(StoreContactMessageRequest $request): JsonResponse
    {
        $message = ContactMessage::create([
            ...$request->validated(),
            'is_read' => false,
        ]);

        return response()->json([
            'message' => "Thanks — we've received your message.",
            'data' => $message,
        ], 201);
    }
}
