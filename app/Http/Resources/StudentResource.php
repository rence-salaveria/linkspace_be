<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Student */
class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'nickname' => $this->nickname,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'mailing_address' => $this->mailing_address,
            'mailing_contact_number' => $this->mailing_contact_number,
            'permanent_address' => $this->permanent_address,
            'permanent_contact_number' => $this->permanent_contact_number,
            'residency' => $this->residency,
            'civil_status' => $this->civil_status,
            'religion' => $this->religion,
            'spouse_name' => $this->spouse_name,
            'spouse_occupation' => $this->spouse_occupation,
            'birth_order' => $this->birth_order,
            'brother_count' => $this->brother_count,
            'sister_count' => $this->sister_count,
            'total_siblings' => $this->total_siblings,
            'living_with' => $this->living_with,
            'father_living' => $this->father_living,
            'father_name' => $this->father_name,
            'father_nationality' => $this->father_nationality,
            'father_religion' => $this->father_religion,
            'father_educ_attainment' => $this->father_educ_attainment,
            'father_occupation' => $this->father_occupation,
            'father_company' => $this->father_company,
            'father_birthdate' => $this->father_birthdate,
            'father_contact_number' => $this->father_contact_number,
            'mother_living' => $this->mother_living,
            'mother_name' => $this->mother_name,
            'mother_nationality' => $this->mother_nationality,
            'mother_religion' => $this->mother_religion,
            'mother_educ_attainment' => $this->mother_educ_attainment,
            'mother_occupation' => $this->mother_occupation,
            'mother_company' => $this->mother_company,
            'mother_birthdate' => $this->mother_birthdate,
            'mother_contact_number' => $this->mother_contact_number,
            'monthly_income' => $this->monthly_income,
            'guardian_name' => $this->guardian_name,
            'guardian_relationship' => $this->guardian_relationship,
            'guardian_address' => $this->guardian_address,
            'guardian_contact_number' => $this->guardian_contact_number,
            'guardian_email' => $this->guardian_email,
            'emergency_contact' => $this->emergency_contact,
            'emergency_contact_number' => $this->emergency_contact_number,
            'educ_status' => $this->educ_status,
            'educ_background' => $this->educ_background,
            'educ_assistance' => $this->educ_assistance,
            'educ_assistance_info' => $this->educ_assistance_info,
            'institutional_affiliations' => $this->institutional_affiliations,
            'work_experience' => $this->work_experience,
            'interest' => $this->interest,
            'talents' => $this->talents,
            'characteristics' => $this->characteristics,
            'self_image_answer' => $this->self_image_answer,
            'self_motivation_answer' => $this->self_motivation_answer,
            'decision_making_answer' => $this->decision_making_answer,
        ];
    }
}
