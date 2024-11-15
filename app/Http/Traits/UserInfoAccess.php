<?php

namespace App\Http\Traits;

use App\Enums\HttpStatus;
use Illuminate\Http\Request;

trait UserInfoAccess
{
    use HttpResponse;
    public function getUserInfo(Request $request)
    {
        $userInfo = $request->header('X-User-Info');

        if ($userInfo) {
            return json_decode($userInfo, true);
        } else {
            return $this->error('No user info found', HttpStatus::BAD_REQUEST);
        }
    }

    public function getUserId(Request $request)
    {
        $userInfo = $request->header('X-User-Info');

        if ($userInfo) {
            $user = json_decode($userInfo, true);
            return $user['id'] ?? null;
        } else {
            return $this->error('No user info found', HttpStatus::BAD_REQUEST);
        }
    }
}
