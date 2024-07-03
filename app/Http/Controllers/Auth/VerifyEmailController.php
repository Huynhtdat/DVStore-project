<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VerifyEmailController extends Controller
{
    /**
     * Hiển thị trang xác nhận email đã được xác thực thành công.
     *
     * @return \Illuminate\View\View
     */
    public function success()
    {
        if (session('status')) {
            return view('admin.auth.verify-success');
        }

        return redirect()->route('user.login');
    }

    /**
     * Đánh dấu địa chỉ email của người dùng đã xác thực và xóa bản ghi UserVerify sau khi đã xác thực.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyAccount(Request $request)
    {
        if ($request->token) {
            $token = $request->token;
            $verifyUser = UserVerify::where('token', $token)->first();

            if (!$verifyUser || !$verifyUser->user) {
                return redirect()->route('user.login')->with('error', __('message.token_is_invalid'));
            }

            $expiresAt = Carbon::parse($verifyUser->expires_at);
            if (Carbon::now()->gt($expiresAt)) {
                return redirect()->route('user.verification.notice', $verifyUser->user->id);
            }

            DB::transaction(function () use ($verifyUser) {
                if ($verifyUser->email_verify) {
                    $verifyUser->user->email = $verifyUser->email_verify;
                }
                $verifyUser->user->email_verified_at = Carbon::now();
                $verifyUser->user->save();
                $verifyUser->delete();
            });

            return redirect()->route('user.verify.success')->with('status', 'verification-success');
        }

        return redirect()->route('login');
    }
}
