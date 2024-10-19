<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationRequest;
use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;

class ConsultationController extends Controller
{
    public function index()
    {
        return ConsultationResource::collection(Consultation::all());
    }

    public function store(ConsultationRequest $request)
    {
        return new ConsultationResource(Consultation::create($request->validated()));
    }

    public function show(Consultation $consultation)
    {
        return new ConsultationResource($consultation);
    }

    public function update(ConsultationRequest $request, Consultation $consultation)
    {
        $consultation->update($request->validated());

        return new ConsultationResource($consultation);
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();

        return response()->json();
    }
}
