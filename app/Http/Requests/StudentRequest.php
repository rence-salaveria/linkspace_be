<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'], // Nullable in the model
            'nickname' => ['nullable', 'string', 'max:255'], // Nullable in the model
            'gender' => ['required', 'in:M,F,O'],
            'course' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'], // Year added
            'birthdate' => ['required', 'date'],
            'mailing_address' => ['required', 'string', 'max:255'],
            'mailing_contact_number' => ['required', 'string', 'max:20'],
            'permanent_address' => ['nullable', 'string', 'max:255'], // Nullable in the model
            'permanent_contact_number' => ['nullable', 'string', 'max:20'], // Nullable in the model
            'residency' => ['required', 'string', 'max:255'],
            'civil_status' => ['required', 'in:single,married,divorced,widowed'],
            'religion' => ['required', 'string', 'max:255'],
            'spouse_name' => ['nullable', 'string', 'max:255'], // Nullable in the model
            'spouse_occupation' => ['nullable', 'string', 'max:255'], // Nullable in the model
            'birth_order' => ['required', 'integer', 'min:1'],
            'brother_count' => ['required', 'integer', 'min:0'], // Default 0 in model
            'sister_count' => ['required', 'integer', 'min:0'], // Default 0 in model
            'total_siblings' => ['required', 'integer', 'min:0'], // Default 0 in model
            'living_with' => ['required', 'string', 'max:255'],
            'father_living' => ['required', 'boolean'],
            'father_name' => ['required_if:father_living,true', 'string', 'max:255'],
            'father_nationality' => ['required_if:father_living,true', 'string', 'max:255'],
            'father_religion' => ['required_if:father_living,true', 'string', 'max:255'],
            'father_educ_attainment' => ['required_if:father_living,true', 'string', 'max:255'],
            'father_occupation' => ['required_if:father_living,true', 'string', 'max:255'],
            'father_company' => ['required_if:father_living,true', 'string', 'max:255'],
            'father_birthdate' => ['required_if:father_living,true', 'date'],
            'father_contact_number' => ['nullable', 'string', 'max:20'], // Nullable in the model
            'mother_living' => ['required', 'boolean'],
            'mother_name' => ['required_if:mother_living,true', 'string', 'max:255'],
            'mother_nationality' => ['required_if:mother_living,true', 'string', 'max:255'],
            'mother_religion' => ['required_if:mother_living,true', 'string', 'max:255'],
            'mother_educ_attainment' => ['required_if:mother_living,true', 'string', 'max:255'],
            'mother_occupation' => ['required_if:mother_living,true', 'string', 'max:255'],
            'mother_company' => ['required_if:mother_living,true', 'string', 'max:255'],
            'mother_birthdate' => ['required_if:mother_living,true', 'date'],
            'mother_contact_number' => ['nullable', 'string', 'max:20'], // Nullable in the model
            'monthly_income' => ['required', 'numeric', 'min:0'],
            'guardian_name' => ['nullable', 'string', 'max:255'], // Nullable in the model
            'guardian_relationship' => ['nullable', 'string', 'max:255'], // Nullable in the model
            'guardian_address' => ['nullable', 'string', 'max:255'], // Nullable in the model
            'guardian_contact_number' => ['nullable', 'string', 'max:20'], // Nullable in the model
            'guardian_email' => ['nullable', 'email', 'max:254'], // Nullable in the model
            'emergency_contact' => ['nullable', 'string', 'max:255'], // Nullable in the model
            'emergency_contact_number' => ['nullable', 'string', 'max:20'], // Nullable in the model
            'educ_status' => ['required', 'string', 'max:255'],
            'educ_background' => ['nullable', 'json'], // Nullable in model
            'educ_assistance' => ['required', 'boolean'],
            'educ_assistance_info' => ['nullable', 'string', 'max:255'], // Nullable in model
            'institutional_affiliations' => ['nullable', 'json'], // Nullable in model
            'work_experience' => ['nullable', 'json'], // Nullable in model
            'interest' => ['nullable', 'json'], // Nullable in model
            'talents' => ['nullable', 'json'], // Nullable in model
            'characteristics' => ['nullable', 'json'], // Nullable in model
            'self_image_answer' => ['required', 'string'],
            'self_motivation_answer' => ['required', 'string'],
            'decision_making_answer' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
