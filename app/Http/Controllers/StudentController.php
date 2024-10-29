<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Random\RandomException;

class StudentController extends Controller
{
    public function index()
    {
        return StudentResource::collection(Student::all());
    }

    public function store(StudentRequest $request)
    {
        return new StudentResource(Student::create($request->validated()));
    }

    public function show(Student $student)
    {
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
        if($request->hasFile('infoSheet')) {
            $file = $request->file('infoSheet');
            $filename = time() . '-' . random_int(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $maxSize = 10 * 1024 * 1024;
            if ($file->getSize() > $maxSize) return response()->json(['message' => 'File size should not exceed 10MB.'], 400);

            $extension = $file->getClientOriginalExtension();
            if (!in_array($extension, ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'pdf'])) return response()->json(['message' => 'Only JPG, JPEG, or PNG, PDF files are accepted.'], 400);
            $folderPath = "student/info-sheet";
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
}
