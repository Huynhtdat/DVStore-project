<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerify;
use App\Notifications\VerifyUserForgotPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function create()
    {
        return view('auth.forgot_password');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages([
                'email' => 'Địa chỉ email không tồn tại',
            ]);
        }

        $user = User::where('email', $request->email)->first();

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
        $user->notify(new VerifyUserForgotPassword($token));
        DB::commit();

        return back()->with('notify', 'Chúng tôi đã gởi liên kết xác nhận vào email của bạn vui lòng kiểm tra');
    }

    public function changePassword(Request $request)
    {
        if ($request->token) {
            $verifyUser = UserVerify::where('token', $request->token)->first();

            if (!$verifyUser || !$verifyUser->user) {
                return redirect()->route('user.login')->with('error', __('message.token_is_invalid'));
            }

            $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s', $verifyUser->expires_at);
            if (!$expiresAt->gt(Carbon::now())) {
                return redirect()->route('user.login');
            }

            return view('auth.change-password', [
                'token' => $request->token,
            ]);
        }

        return redirect()->route('user.login');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => [
                'required',
                'min:8',
                'max:24',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                'confirmed',
            ],
        ]);

        $verifyUser = UserVerify::where('token', $request->token)->first();

        if (!$verifyUser || !$verifyUser->user) {
            return redirect()->route('user.login')->with('error', __('message.token_is_invalid'));
        }

        $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s', $verifyUser->expires_at);
        if (!$expiresAt->gt(Carbon::now())) {
            return redirect()->route('user.login');
        }

        $user = $verifyUser->user;
        $user->password = bcrypt($request->password);
        $user->save();

        $verifyUser->delete();

        return redirect()->route('user.verify.success')->with('status', 'forgot-password-success');
    }
}
