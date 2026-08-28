<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationRequest;
use App\Models\Consultation;
use App\Notifications\ConsultationReceived;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class ConsultationController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Consultation::latest()->paginate(20)
        );
    }

    public function store(StoreConsultationRequest $request): JsonResponse
    {
        $consultation = Consultation::create([
            ...$request->validated(),
            'status' => 'pending',
        ]);

        // Notify the ops team — configure MAIL_* env vars and a
        // Notification/Mailable class to send this for real.
        Notification::route('mail', config('mail.admin_address'))
            ->notify(new ConsultationReceived($consultation));

        return response()->json([
            'message' => 'Thanks — your consultation request has been received. Our team will reach out shortly.',
            'data' => $consultation,
        ], 201);
    }

    public function update(Request $request, Consultation $consultation): JsonResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,contacted,scheduled,closed'],
        ]);

        $consultation->update($request->only('status'));

        return response()->json(['data' => $consultation]);
    }
}
