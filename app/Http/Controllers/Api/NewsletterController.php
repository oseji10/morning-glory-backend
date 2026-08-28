<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NewsletterController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:newsletter_subscribers,email'],
        ]);

        NewsletterSubscriber::create($data);

        return response()->json([
            'message' => 'Subscribed successfully.',
        ], 201);
    }
}
