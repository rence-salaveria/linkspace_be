<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\ConsultationRequest;
use App\Http\Resources\ConsultationResource;
use App\Http\Traits\AuditLogger;
use App\Http\Traits\HttpResponse;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    use HttpResponse, AuditLogger;

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
                ->get();
            return $this->success(ConsultationResource::collection($allConsultations), "Fetched successfully");
        } elseif ($request->type === "upcoming") {
            $allConsultations = Consultation::with(['student'])
                ->where('counselor_id', $counselor)
                ->where('status', 'LookUp-002')
                ->whereDate('schedule_date', now()->toDateString())
                ->get();
            return $this->success(ConsultationResource::collection($allConsultations), "Fetched successfully");
        } elseif ($request->type === "done") {
            $allConsultations = Consultation::with(['student'])
                ->where('counselor_id', $counselor)
                ->where('status', 'LookUp-003')
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
}
