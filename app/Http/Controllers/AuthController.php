<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\StoreUserRequest;
use App\Http\Traits\AuditLogger;
use App\Http\Traits\HttpResponse;
use App\Models\Audit;
use App\Models\Consultation;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponse, AuditLogger;

    public function register(StoreUserRequest $request)
    {
        try {
            \DB::beginTransaction();

            $validatedData = $request->validated();
            $newUser = User::create([
                'full_name' => $validatedData['full_name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'username' => $validatedData['username'],
            ]);
            $this->createLog(new Audit([
                'action_type' => 'create',
                'action_item' => 'user',
                'user_id' => $newUser->id,
            ]));

            \DB::commit();

            return $this->success([
                'user' => $newUser,
                'token' => $newUser->createToken('register token for ' . $newUser->username)->plainTextToken
            ], 'Create new user successfully');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error($e); // Log the exception
            return $this->error('An unexpected error occurred.', HttpStatus::BAD_REQUEST);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return $this->error('Invalid login credentials', HttpStatus::UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('login token for ' . $user->username)->plainTextToken;

        $this->createLog(new Audit([
            'action_type' => 'login',
            'action_item' => 'user',
            'user_id' => $user->id,
        ]));

        return $this->success([
            'user' => $user,
            'token' => $token,
        ], 'Login successfully');
    }

    public function dashboardInfo(Request $request)
    {
        $user = Auth::id();

        $startOfToday = now()->startOfDay();
        $endOfToday = now()->endOfDay();

        $audit = Audit::where('user_id', $user)->count();
        $student = Student::count();
        $user = Auth::id();

        $consultation = Consultation::where('counselor_id', $user)
            ->whereIn('status', ['LookUp-001', 'LookUp-002'])
            ->count();

        $todayConsultations = Consultation::where('counselor_id', $user)
            ->whereBetween('schedule_date', [$startOfToday, $endOfToday])
            ->count();

        $history = Consultation::where('counselor_id', $user)
            ->where('status', 'LookUp-003')
            ->count();

        return $this->success([
            'audit' => $audit,
            'student' => $student,
            'consultation' => $consultation,
            'todayConsultations' => $todayConsultations,
            'history' => $history,
        ], 'Dashboard information retrieved successfully');
    }
}
