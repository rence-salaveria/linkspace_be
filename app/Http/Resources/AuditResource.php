<?php

namespace App\Http\Resources;

use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Audit */
class AuditResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'actionType' => $this->action_type,
            'actionItem' => $this->action_item,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,

            'userId' => $this->user_id,
            'consultationId' => $this->consultation_id,
            'studentId' => $this->student_id,

            'consultation' => new ConsultationResource($this->whenLoaded('consultation')),
            'student' => new StudentResource($this->whenLoaded('student')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
