<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProposalRequest extends FormRequest
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
            'phone' => ['nullable', 'string', 'max:30'],
            'company' => ['nullable', 'string', 'max:150'],
            'industry' => ['nullable', 'string', 'max:150'],
            'project_scope' => ['required', 'string', 'max:3000'],
            'budget_range' => ['nullable', 'string', 'max:100'],
        ];
    }
}
