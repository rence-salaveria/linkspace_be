<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationRequest;
use App\Http\Resources\ConsultationResource;
use App\Http\Traits\AuditLogger;
use App\Http\Traits\HttpResponse;
use App\Models\Consultation;

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

    public function getByCounselorId(int $counselor)
    {
        $allConsultations = Consultation::with(['student'])->where('counselor_id', $counselor)->get();
        return $this->success(ConsultationResource::collection($allConsultations), "Fetched successfully");
    }

    public function show(int $consultationID)
    {
        return new ConsultationResource(Consultation::with(['student'])->findOrFail($consultationID));
    }
}
