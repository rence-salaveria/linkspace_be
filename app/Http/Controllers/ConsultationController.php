<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\ConsultationRequest;
use App\Http\Resources\ConsultationResource;
use App\Http\Traits\AuditLogger;
use App\Http\Traits\HttpResponse;
use App\Http\Traits\UserInfoAccess;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    use HttpResponse, AuditLogger, UserInfoAccess;

//    public function index()
//    {
//        return ConsultationResource::collection(Consultation::all());
//    }

    public function store(ConsultationRequest $request)
    {
        return new ConsultationResource(Consultation::create($request->validated()));
    }

    public function getByCounselorId(int $counselor, Request $request)
    {
        // type = pending, upcoming, done
        if ($request->type === "pending") {
            $allConsultations = Consultation::with(['student'])
                ->where('counselor_id', $counselor)
                ->whereIn('status', ['LookUp-001', 'LookUp-002'])
                ->orderBy('created_at', 'desc')
                ->get();
            return $this->success(ConsultationResource::collection($allConsultations), "Fetched successfully");
        } elseif ($request->type === "today") {
            $allConsultations = Consultation::with(['student'])
                ->where('counselor_id', $counselor)
                ->where('status', 'LookUp-002')
                ->orderBy('created_at', 'desc')
                ->whereDate('schedule_date', now()->toDateString())
                ->get();
            return $this->success(ConsultationResource::collection($allConsultations), "Fetched successfully");
        } elseif ($request->type === "done") {
            $allConsultations = Consultation::with(['student'])
                ->where('counselor_id', $counselor)
                ->whereIn('status', ['LookUp-003', 'LookUp-004'])
                ->orderBy('created_at', 'desc')
                ->get();
            return $this->success(ConsultationResource::collection($allConsultations), "Fetched successfully");
        } else {
            return $this->error("Invalid type", HttpStatus::BAD_REQUEST);
        }
    }

    public function show(int $consultationID)
    {
        return new ConsultationResource(Consultation::with(['student'])->findOrFail($consultationID));
    }

    public function create(Request $request)
    {
        $counselorId = $this->getUserId($request);
        $status = "";

        if ($request->scheduleDate !== null) {
            $status = "LookUp-002";
            $request->scheduleDate = date('Y-m-d H:i:s', strtotime($request->scheduleDate));
            Consultation::create([
                'counselor_id' => $counselorId,
                'student_id' => $request->selectedStudent,
                'schedule_date' => $request->scheduleDate,
                'status' => $status,
            ]);
        } else {
            $status = "LookUp-001";
            Consultation::create([
                'counselor_id' => $counselorId,
                'student_id' => $request->selectedStudent,
                'schedule_date' => null,
                'status' => $status,
            ]);
        }
    }
}
