<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('gender');
            $table->string('course');
            $table->string('year');
            $table->date('birthdate');
            $table->string('mailing_address');
            $table->string('mailing_contact_number');
            $table->string('permanent_address')->nullable(); // might be same in mailing
            $table->string('permanent_contact_number')->nullable(); // might be same in mailing
            $table->string('residency');
            $table->string('civil_status');
            $table->string('religion');
            $table->string('spouse_name')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->integer('birth_order');
            $table->integer('brother_count')->default(0);
            $table->integer('sister_count')->default(0);
            $table->integer('total_siblings')->default(0);
            $table->string('living_with');
            $table->boolean('father_living');
            $table->string('father_name');
            $table->string('father_nationality');
            $table->string('father_religion');
            $table->string('father_educ_attainment');
            $table->string('father_occupation');
            $table->string('father_company');
            $table->date('father_birthdate');
            $table->string('father_contact_number')->nullable();
            $table->boolean('mother_living');
            $table->string('mother_name');
            $table->string('mother_nationality');
            $table->string('mother_religion');
            $table->string('mother_educ_attainment');
            $table->string('mother_occupation');
            $table->string('mother_company');
            $table->date('mother_birthdate');
            $table->string('mother_contact_number')->nullable();
            $table->decimal('monthly_income');
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relationship')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('guardian_contact_number')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('educ_status');
            $table->json('educ_background')->nullable();
            $table->boolean('educ_assistance')->default(false);
            $table->string('educ_assistance_info')->nullable();
            $table->json('institutional_affiliations')->nullable();
            $table->json('work_experience')->nullable();
            $table->json('interest')->nullable();
            $table->json('talents')->nullable();
            $table->json('characteristics')->nullable();
            $table->text('self_image_answer');
            $table->text('self_motivation_answer');
            $table->text('decision_making_answer');
            $table->text('info_sheet_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
