<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\ConsultationRequest;
use App\Http\Resources\ConsultationResource;
use App\Http\Traits\AuditLogger;
use App\Http\Traits\HttpResponse;
use App\Http\Traits\UserInfoAccess;
use App\Models\Audit;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $startOfToday = now()->startOfDay()->sub(8, 'hours');
        $endOfToday = now()->endOfDay()->sub(8, 'hours');
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
                ->whereBetween('schedule_date', [$startOfToday, $endOfToday])
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

        $consultation = null;

        if ($request->scheduleDate !== null) {
            $status = "LookUp-002";
//            $request->scheduleDate = date('Y-m-d H:i:s', strtotime($request->scheduleDate));$scheduleDate = Carbon::parse($request->input('scheduleDate'))->setTimezone(config('app.timezone'));
            $consultation = Consultation::create([
                'counselor_id' => $counselorId,
                'student_id' => $request->selectedStudent,
                'schedule_date' => $request->scheduleDate,
                'concern' => $request->concern,
                'counselor_comment' => $request->counselorComment,
                'status' => $status,
            ]);
        } else {
            $status = "LookUp-001";
            $consultation = Consultation::create([
                'counselor_id' => $counselorId,
                'student_id' => $request->selectedStudent,
                'schedule_date' => null,
                'concern' => $request->concern,
                'counselor_comment' => $request->counselorComment,
                'status' => $status,
            ]);
        }

        $this->createLog(new Audit([
            'action_type' => 'create',
            'action_item' => 'consultation',
            'user_id' => $counselorId,
            'consultation_id' => $consultation->id,
            'student_id' => $request->selectedStudent,
        ]));

        return $this->success(new ConsultationResource($consultation), "Consultation updated successfully");
    }

    public function editConsultation(Request $request, int $consultationID)
    {
        $counselorId = $this->getUserId($request);

        $consultation = Consultation::findOrFail($consultationID);
        if ($request->scheduleDate === null) {
            $consultation->schedule_date = null;
            $consultation->status = "LookUp-001";
        } else {
//            $scheduleDate = Carbon::parse($request->input('scheduleDate'))->setTimezone(config('app.timezone'));
            $consultation->schedule_date = $request->scheduleDate;
            $consultation->status = "LookUp-002";
        }
        $consultation->counselor_comment = $request->counselorComment;
        $consultation->concern = $request->concern;
        $consultation->save();

        $this->createLog(new Audit([
            'action_type' => 'edit',
            'action_item' => 'consultation',
            'user_id' => $counselorId,
            'consultation_id' => $consultation->id,
            'student_id' => $consultation->student_id,
        ]));
        return $this->success(new ConsultationResource($consultation), "Consultation updated successfully");
    }

    public function cancelConsultation(Request $request, int $consultationID)
    {
        $counselorId = $this->getUserId($request);
        $consultation = Consultation::findOrFail($consultationID);
        $consultation->status = "LookUp-004";
        $consultation->save();

        $this->createLog(new Audit([
            'action_type' => 'cancel',
            'action_item' => 'consultation',
            'user_id' => $counselorId,
            'student_id' => $consultation->student_id,
        ]));

        return $this->success(new ConsultationResource($consultation), "Consultation cancelled successfully");
    }

    public function completeConsultation(Request $request, int $consultationID)
    {
        $counselorId = $this->getUserId($request);
        $consultation = Consultation::findOrFail($consultationID);
        $consultation->concern = $request->concern;
        $consultation->counselor_comment = $request->counselorComment;
        $consultation->status = "LookUp-003";
        $consultation->save();

        $this->createLog(new Audit([
            'action_type' => 'complete',
            'action_item' => 'consultation',
            'user_id' => $counselorId,
            'student_id' => $consultation->student_id,
        ]));

        return $this->success(new ConsultationResource($consultation), "Consultation cancelled successfully");
    }
}
