<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(): \Illuminate\Http\RedirectResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login');
            }

            if ($user instanceof User && !$user->hasVerifiedEmail()) {
                $token = Str::random(64);
                $time = Config::get('auth.verification.expire.resend', 60);

                DB::beginTransaction();
                UserVerify::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'token' => $token,
                        'expires_at' => Carbon::now()->addMinutes($time),
                    ]
                );
                $user->sendEmailVerificationNotification($token);
                DB::commit();

                return back()->with('status', 'verification-link-sent');
            } else {
                return redirect()->route('admin.home');
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return back()->with('error', $e->getMessage());
        }
    }
}
