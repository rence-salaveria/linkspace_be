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
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'middleName' => $this->middle_name,
            'nickname' => $this->nickname,
            'gender' => $this->gender,
            'course' => $this->course,
            'year' => $this->year,
            'idNumber' => $this->id_number,
            'birthdate' => $this->birthdate,
            'mailingAddress' => $this->mailing_address,
            'mailingContactNumber' => $this->mailing_contact_number,
            'permanentAddress' => $this->permanent_address,
            'permanentContactNumber' => $this->permanent_contact_number,
            'residency' => $this->residency,
            'civilStatus' => $this->civil_status,
            'religion' => $this->religion,
            'spouseName' => $this->spouse_name,
            'spouseOccupation' => $this->spouse_occupation,
            'birthOrder' => $this->birth_order,
            'brotherCount' => $this->brother_count,
            'sisterCount' => $this->sister_count,
            'totalSiblings' => $this->total_siblings,
            'livingWith' => $this->living_with,
            'fatherLiving' => $this->father_living,
            'fatherName' => $this->father_name,
            'fatherNationality' => $this->father_nationality,
            'fatherReligion' => $this->father_religion,
            'fatherEducAttainment' => $this->father_educ_attainment,
            'fatherOccupation' => $this->father_occupation,
            'fatherCompany' => $this->father_company,
            'fatherBirthdate' => $this->father_birthdate,
            'fatherContactNumber' => $this->father_contact_number,
            'motherLiving' => $this->mother_living,
            'motherName' => $this->mother_name,
            'motherNationality' => $this->mother_nationality,
            'motherReligion' => $this->mother_religion,
            'motherEducAttainment' => $this->mother_educ_attainment,
            'motherOccupation' => $this->mother_occupation,
            'motherCompany' => $this->mother_company,
            'motherBirthdate' => $this->mother_birthdate,
            'motherContactNumber' => $this->mother_contact_number,
            'monthlyIncome' => $this->monthly_income,
            'guardianName' => $this->guardian_name,
            'guardianRelationship' => $this->guardian_relationship,
            'guardianAddress' => $this->guardian_address,
            'guardianContactNumber' => $this->guardian_contact_number,
            'guardianEmail' => $this->guardian_email,
            'emergencyContact' => $this->emergency_contact,
            'emergencyContactNumber' => $this->emergency_contact_number,
            'educStatus' => $this->educ_status,
            'educBackground' => json_decode($this->educ_background, true),
            'educAssistance' => $this->educ_assistance,
            'educAssistanceInfo' => $this->educ_assistance_info,
            'institutionalAffiliations' => json_decode($this->institutional_affiliations, true),
            'workExperience' => json_decode($this->work_experience, true),
            'interest' => json_decode($this->interest, true),
            'talents' => json_decode($this->talents, true),
            'characteristics' => json_decode($this->characteristics, true),
            'selfImageAnswer' => $this->self_image_answer,
            'selfMotivationAnswer' => $this->self_motivation_answer,
            'decisionMakingAnswer' => $this->decision_making_answer,
            'infoSheet' => $this->info_sheet_path,
            'photo' => $this->photo_path,
        ];
    }
}
