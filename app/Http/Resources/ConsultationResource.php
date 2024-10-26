<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Consultation */
class ConsultationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'id' => $this->id,
            'scheduleDate' => $this->schedule_date,
            'concern' => $this->concern,
            'counselorComment' => $this->counselor_comment,

            'counselorId' => $this->counselor_id,
            'studentId' => $this->student_id,

            'student' => new StudentResource($this->whenLoaded('student')),
        ];
    }
}
