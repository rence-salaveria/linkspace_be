<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('gender')->nullable();
            $table->string('course')->nullable();
            $table->string('year')->nullable();
            $table->string('id_number')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('mailing_contact_number')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('permanent_contact_number')->nullable();
            $table->string('residency')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->integer('birth_order')->nullable();
            $table->integer('brother_count')->default(0)->nullable();
            $table->integer('sister_count')->default(0)->nullable();
            $table->integer('total_siblings')->default(0)->nullable();
            $table->string('living_with')->nullable();
            $table->boolean('father_living')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_nationality')->nullable();
            $table->string('father_religion')->nullable();
            $table->string('father_educ_attainment')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_company')->nullable();
            $table->date('father_birthdate')->nullable();
            $table->string('father_contact_number')->nullable();
            $table->boolean('mother_living')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_nationality')->nullable();
            $table->string('mother_religion')->nullable();
            $table->string('mother_educ_attainment')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_company')->nullable();
            $table->date('mother_birthdate')->nullable();
            $table->string('mother_contact_number')->nullable();
            $table->decimal('monthly_income')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relationship')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('guardian_contact_number')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('educ_status')->nullable();
            $table->json('educ_background')->nullable();
            $table->boolean('educ_assistance')->default(false)->nullable();
            $table->string('educ_assistance_info')->nullable();
            $table->json('institutional_affiliations')->nullable();
            $table->json('work_experience')->nullable();
            $table->json('interest')->nullable();
            $table->json('talents')->nullable();
            $table->json('characteristics')->nullable();
            $table->text('self_image_answer')->nullable();
            $table->text('self_motivation_answer')->nullable();
            $table->text('decision_making_answer')->nullable();
            $table->text('info_sheet_path')->nullable();
            $table->string('photo_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
