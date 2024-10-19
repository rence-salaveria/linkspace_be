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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'schedule_date' => $this->schedule_date,
            'concern' => $this->concern,
            'counselor_comment' => $this->counselor_comment,

            'counselor_id' => $this->counselor_id,
            'student_id' => $this->student_id,

            'student' => new StudentResource($this->whenLoaded('student')),
        ];
    }
}
