<?php

namespace App\Http\Traits;

use App\Models\Audit;
use Illuminate\Support\Facades\DB;

trait AuditLogger
{
    /**
     * `createLog` creates an audit trail
     */
    public function createLog(Audit $audit): bool {
        try {
            DB::beginTransaction();
            Audit::create($audit->toArray());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
        return true;
    }
}
