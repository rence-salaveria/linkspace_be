<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddStudentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'middleName' => ['nullable', 'string'],
            'nickname' => ['nullable', 'string'],
            'gender' => ['required', 'string'],
            'course' => ['required', 'string'],
            'year' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'mailingAddress' => ['required', 'string'],
            'mailingContactNumber' => ['required', 'string'],
            'permanentAddress' => ['nullable', 'string'],
            'permanentContactNumber' => ['nullable', 'string'],
            'residency' => ['required', 'string'],
            'civilStatus' => ['required', 'string'],
            'religion' => ['required', 'string'],
            'spouseName' => ['nullable', 'string'],
            'spouseOccupation' => ['nullable', 'string'],
            'birthOrder' => ['required', 'integer'],
            'brotherCount' => ['required', 'integer'],
            'sisterCount' => ['required', 'integer'],
            'totalSiblings' => ['required', 'integer'],
            'livingWith' => ['required', 'string'],
            'fatherLiving' => ['required', 'boolean'],
            'fatherName' => ['required', 'string'],
            'fatherNationality' => ['required', 'string'],
            'fatherReligion' => ['required', 'string'],
            'fatherEducAttainment' => ['required', 'string'],
            'fatherOccupation' => ['required', 'string'],
            'fatherCompany' => ['required', 'string'],
            'fatherBirthdate' => ['required', 'date'],
            'fatherContactNumber' => ['nullable', 'string'],
            'motherLiving' => ['required', 'boolean'],
            'motherName' => ['required', 'string'],
            'motherNationality' => ['required', 'string'],
            'motherReligion' => ['required', 'string'],
            'motherEducAttainment' => ['required', 'string'],
            'motherOccupation' => ['required', 'string'],
            'motherCompany' => ['required', 'string'],
            'motherBirthdate' => ['required', 'date'],
            'motherContactNumber' => ['nullable', 'string'],
            'monthlyIncome' => ['required', 'string'],
            'guardianName' => ['nullable', 'string'],
            'guardianRelationship' => ['nullable', 'string'],
            'guardianAddress' => ['nullable', 'string'],
            'guardianContactNumber' => ['nullable', 'string'],
            'guardianEmail' => ['nullable', 'email', 'max:254'],
            'emergencyContact' => ['nullable', 'string'],
            'emergencyContactNumber' => ['nullable', 'string'],
            'educStatus' => ['required', 'array'],
            'educBackground' => ['nullable', 'array'],
            'educAssistance' => ['required', 'boolean'],
            'educAssistanceInfo' => ['nullable', 'string'],
            'institutionalAffiliations' => ['nullable', 'array'],
            'workExperience' => ['nullable', 'array'],
            'interest' => ['nullable', 'array'],
            'talents' => ['nullable', 'array'],
            'characteristics' => ['nullable', 'array'],
            'selfImageAnswer' => ['required', 'string'],
            'selfMotivationAnswer' => ['required', 'string'],
            'decisionMakingAnswer' => ['required', 'string'],
            'infoSheetPath' => ['nullable', 'array'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
