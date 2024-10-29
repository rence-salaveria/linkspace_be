<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'nickname',
        'gender',
        'course',
        'year',
        'birthdate',
        'mailing_address',
        'mailing_contact_number',
        'permanent_address',
        'permanent_contact_number',
        'residency',
        'civil_status',
        'religion',
        'spouse_name',
        'spouse_occupation',
        'birth_order',
        'brother_count',
        'sister_count',
        'total_siblings',
        'living_with',
        'father_living',
        'father_name',
        'father_nationality',
        'father_religion',
        'father_educ_attainment',
        'father_occupation',
        'father_company',
        'father_birthdate',
        'father_contact_number',
        'mother_living',
        'mother_name',
        'mother_nationality',
        'mother_religion',
        'mother_educ_attainment',
        'mother_occupation',
        'mother_company',
        'mother_birthdate',
        'mother_contact_number',
        'monthly_income',
        'guardian_name',
        'guardian_relationship',
        'guardian_address',
        'guardian_contact_number',
        'guardian_email',
        'emergency_contact',
        'emergency_contact_number',
        'educ_status',
        'educ_background',
        'educ_assistance',
        'educ_assistance_info',
        'institutional_affiliations',
        'work_experience',
        'interest',
        'talents',
        'characteristics',
        'self_image_answer',
        'self_motivation_answer',
        'decision_making_answer',
        'info_sheet_path'
    ];

    protected function casts(): array
    {
        return [
            'educ_background' => 'array',
            'institutional_affiliations' => 'array',
            'work_experience' => 'array',
            'interest' => 'array',
            'talents' => 'array',
            'characteristics' => 'array',
        ];
    }
}
