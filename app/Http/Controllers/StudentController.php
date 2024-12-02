<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Http\Traits\AuditLogger;
use App\Http\Traits\HttpResponse;
use App\Http\Traits\UserInfoAccess;
use App\Models\Audit;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Random\RandomException;

class StudentController extends Controller
{
    use HttpResponse, UserInfoAccess, AuditLogger;

    public function index()
    {
        return StudentResource::collection(Student::all());
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return new StudentResource($student);
    }

    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return new StudentResource($student);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json();
    }

    /**
     * @throws RandomException
     */
    public function uploadPersonalInfoSheet(Request $request)
    {
        if ($request->hasFile('infoSheet')) {
            $file = $request->file('infoSheet');
            $filename = time() . '-' . random_int(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $maxSize = 10 * 1024 * 1024;
            if ($file->getSize() > $maxSize) return response()->json(['message' => 'File size should not exceed 10MB.'], 400);

            $extension = $file->getClientOriginalExtension();
            if (!in_array($extension, ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'pdf'])) return response()->json(['message' => 'Only JPG, JPEG, or PNG, PDF files are accepted.'], 400);
            if ($request->dp === '1') {
                $folderPath = "student/photo";
            } else {
                $folderPath = "student/info-sheet";
            }
            $path = $file->storeAs($folderPath, $filename, 'public');

            return response()->json(['path' => $path, 'file' => $filename], 200);
        }

        return response()->json(['error' => 'No file was uploaded.'], 400);
    }

    public function revertFile(Request $request)
    {
        try {
            $filePath = $request->getContent();
            $filePath = json_decode($filePath);
            $filePath = $filePath->path;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);

                $directoryPath = dirname($filePath);

                if (Storage::disk('public')->exists($directoryPath)) {
                    $files = Storage::disk('public')->allFiles($directoryPath);
                    if (count($files) === 0) {
                        Storage::disk('public')->deleteDirectory($directoryPath);
                    }
                }

                return response()->json(['message' => 'File and folder deleted if empty'], 200);
            } else {
                return response()->json(['message' => 'File not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function addStudent(Request $request)
    {
        $userId = $this->getUserId($request);

        try {
            $mappedData = [
                'first_name' => $request['firstName'],
                'last_name' => $request['lastName'],
                'middle_name' => $request['middleName'] ?? null,
                'nickname' => $request['nickname'] ?? null,
                'gender' => $request['gender'],
                'course' => $request['course'],
                'year' => $request['year'],
                'id_number' => $request['idNumber'],
                'birthdate' => $request['birthdate'],
                'mailing_address' => $request['mailingAddress'],
                'mailing_contact_number' => $request['mailingContactNumber'],
                'permanent_address' => $request['permanentAddress'] ?? $request['mailingAddress'],
                'permanent_contact_number' => $request['permanentContactNumber'] ?? $request['mailingContactNumber'],
                'residency' => $request['residency'],
                'civil_status' => $request['civilStatus'],
                'religion' => $request['religion'],
                'spouse_name' => $request['spouseName'] ?? null,
                'spouse_occupation' => $request['spouseOccupation'] ?? null,
                'birth_order' => $request['birthOrder'],
                'brother_count' => $request['brotherCount'],
                'sister_count' => $request['sisterCount'],
                'total_siblings' => $request['totalSiblings'],
                'living_with' => $request['livingWith'],
                'father_living' => $request['fatherLiving'],
                'father_name' => $request['fatherName'],
                'father_nationality' => $request['fatherNationality'],
                'father_religion' => $request['fatherReligion'],
                'father_educ_attainment' => $request['fatherEducAttainment'],
                'father_occupation' => $request['fatherOccupation'],
                'father_company' => $request['fatherCompany'],
                'father_birthdate' => $request['fatherBirthdate'],
                'father_contact_number' => $request['fatherContactNumber'] ?? null,
                'mother_living' => $request['motherLiving'],
                'mother_name' => $request['motherName'],
                'mother_nationality' => $request['motherNationality'],
                'mother_religion' => $request['motherReligion'],
                'mother_educ_attainment' => $request['motherEducAttainment'],
                'mother_occupation' => $request['motherOccupation'],
                'mother_company' => $request['motherCompany'],
                'mother_birthdate' => $request['motherBirthdate'],
                'mother_contact_number' => $request['motherContactNumber'] ?? null,
                'monthly_income' => $request['monthlyIncome'],
                'guardian_name' => $request['guardianName'] ?? null,
                'guardian_relationship' => $request['guardianRelationship'] ?? null,
                'guardian_address' => $request['guardianAddress'] ?? null,
                'guardian_contact_number' => $request['guardianContactNumber'] ?? null,
                'guardian_email' => $request['guardianEmail'] ?? null,
                'emergency_contact' => $request['emergencyContact'] ?? null,
                'emergency_contact_number' => $request['emergencyContactNumber'] ?? null,
                'educ_status' => json_encode($request['educStatus']),
                'educ_background' => json_encode($request['educBackground'] ?? []),
                'educ_assistance' => $request['educAssistance'],
                'educ_assistance_info' => $request['educAssistanceInfo'] ?? null,
                'institutional_affiliations' => json_encode($request['institutionalAffiliations'] ?? []),
                'work_experience' => json_encode($request['workExperience'] ?? []),
                'interest' => json_encode($request['interest'] ?? []),
                'talents' => json_encode($request['talents'] ?? []),
                'characteristics' => json_encode($request['characteristics'] ?? []),
                'self_image_answer' => $request['selfImageAnswer'],
                'self_motivation_answer' => $request['selfMotivationAnswer'],
                'decision_making_answer' => $request['decisionMakingAnswer'],
                'info_sheet_path' => $request['infoSheetPath']['path'] ?? [],
                'photo_path' => $request['photo']['path'] ?? [],
            ];

            $student = Student::create($mappedData);

            $this->createLog(new Audit([
                    'action_type' => 'create',
                    'action_item' => 'student',
                    'user_id' => $userId,
                    'student_id' => $student->id,
            ]));

            return $this->success(new StudentResource($student), 'Student added successfully');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), HttpStatus::INTERNAL_SERVER_ERROR);
        }
    }
}
