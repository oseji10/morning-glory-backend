<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'qualification' => ['nullable', 'string', 'max:150'],
            'preferred_cohort' => ['nullable', 'string', 'max:100'],
            'referral_source' => ['nullable', 'string', 'max:100'],
            'motivation' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
