<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'counselor_id' => ['required', 'exists:users'],
            'student_id' => ['required', 'exists:students'],
            'schedule_date' => ['nullable', 'date'],
            'concern' => ['nullable'],
            'counselor_comment' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
