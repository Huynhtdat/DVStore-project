<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\admin\TextSystemConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserVerify;
use App\Notifications\VerifyUserRegister;
use App\Repository\Eloquent\AddressRepository;
use App\Repository\Eloquent\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var AddressRepository
     */
    private $addressRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     * @param AddressRepository $addressRepository
     */
    public function __construct(UserRepository $userRepository, AddressRepository $addressRepository)
    {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
    }
    /**
     * Hiển thị màn hình đăng kí
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try {

            $response = Http::withHeaders([
                'token' => '24d5b95c-7cde-11ed-be76-3233f989b8f3'
            ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/province');
            $citys = json_decode($response->body(), true);

            $response = Http::withHeaders([
                'token' => '24d5b95c-7cde-11ed-be76-3233f989b8f3'
            ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/district', [
                'province_id' => old('city') ?? $citys['data'][0]['ProvinceID'],
            ]);
            $districts = json_decode($response->body(), true);

            $response = Http::withHeaders([
                'token' => '24d5b95c-7cde-11ed-be76-3233f989b8f3'
            ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/ward', [
                'district_id' => old('district') ?? $districts['data'][0]['DistrictID'],
            ]);
            $wards = json_decode($response->body(), true);

            $rules = [
                'email' => 'required|email',
                'password' => [
                    'required',
                    'min:8',
                    'max:24',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                ],
                'password_confirmation' => 'required|same:password',
                'name' => 'required|min:1|max:30',
                'apartment_number' => 'required',
                'city' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'phone_number' => 'required|min:10|max:11',
            ];


            $messages = [
                'name.required' => __('message.required', ['attribute' => 'Họ và tên']),
                'name.min' => __('message.min', ['attribute' => 'Họ và tên', 'min' => 1]),
                'name.max' => __('message.max', ['attribute' => 'Họ và tên', 'max' => 30]),

                'email.required' => __('message.required', ['attribute' => 'email']),
                'email.email' => __('message.email'),

                'password.required' => __('message.required', ['attribute' => 'mật khẩu']),
                'password.min' => __('message.min', ['attribute' => 'Mật khẩu', 'min' => 8]),
                'password.max' => __('message.max', ['attribute' => 'Mật khẩu', 'max' => 24]),
                'password.checklower' => __('message.password.at_least_one_lowercase_letter_is_required'),
                'password.checkupper' => __('message.password.at_least_one_uppercase_letter_is_required'),
                'password.checkdigit' => __('message.password.at_least_one_digit_is_required'),
                'password.checkspecialcharacter' => __('message.password.at_least_special_characte_is_required'),

                'password_confirm.required' => __('message.required', ['attribute' => 'mật khẩu']),
                'password_confirm.min' => __('message.min', ['attribute' => 'Mật khẩu', 'min' => 8]),
                'password_confirm.max' => __('message.max', ['attribute' => 'Mật khẩu', 'max' => 24]),
                'password_confirm.checklower' => __('message.password.at_least_one_lowercase_letter_is_required'),
                'password_confirm.checkupper' => __('message.password.at_least_one_uppercase_letter_is_required'),
                'password_confirm.checkdigit' => __('message.password.at_least_one_digit_is_required'),
                'password_confirm.checkspecialcharacter' => __('message.password.at_least_special_characte_is_required'),
                'password_confirm.equalTo' => 'Xác nhận mật khẩu không đúng',

                'phone_number.required' => __('message.required', ['attribute' => 'số điện thoại']),
                'phone_number.min' => __('message.min', ['attribute' => 'số điện thoại', 'min' => 10]),
                'phone_number.max' => __('message.max', ['attribute' => 'số điện thoại', 'max' => 11]),

                'city.required' => __('message.required', ['attribute' => 'tỉnh, thành phố']),
                'district.required' => __('message.required', ['attribute' => 'quận, huyện']),
                'ward.required' => __('message.required', ['attribute' => 'phường, xã']),
                'apartment_number.required' => __('message.required', ['attribute' => 'số nhà']),
            ];

            return view('auth.register', [
                'citys' => $citys['data'],
                'districts' => $districts['data'],
                'wards' => $wards['data'],
                'rules' => $rules,
                'messages' => $messages,
            ]);
        } catch (Exception) {
            return redirect()->route('user.login');
        }
    }

    public function store(UserRegisterRequest $request)
    {
        try {
            $data = $request->validated();
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'phone_number' => $data['phone_number'],
                'role_id' => Role::ROLE['user'],
            ];

            $addressData = [
                'city' => $data['city'],
                'district' => $data['district'],
                'ward' => $data['ward'],
                'apartment_number' => $data['apartment_number'],
            ];
            $token = Str::random(64);
            $time = Config::get('auth.verification.expire.resend', 60);


            DB::beginTransaction();
            $user = $this->userRepository->create($userData);
            UserVerify::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'token' => $token,
                    'expires_at' => Carbon::now()->addMinutes($time),
                ]
            );
            $user->notify(new VerifyUserRegister($token));
            $addressData['user_id'] = $user->id;
            $this->addressRepository->updateOrCreate($addressData);
            DB::commit();
            return redirect()->route('user.verification.notice', $user->id);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return back()->with('error', TextSystemConst::CREATE_FAILED);
        }
    }

    public function verifyEmail(User $user)
    {
        return view('auth.verify-email', [
            'user' => $user,
        ]);
    }

    public function resendEmail(Request $request)
    {
        try {
            $user = $this->userRepository->find($request->id);
            if (!$user) {
                return redirect('user.home');
            }
            if ($user->hasVerifiedEmail()) {
                return redirect()->route('user.home');
            }
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
            $user->notify(new VerifyUserRegister($token));
            DB::commit();
            return back()->with('status', 'verification-link-sent');
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', $e->getMessage());
        }
    }

    public function success()
    {
        if (session('status')) {
            return view('auth.verify-success')->with('verify_user_success');
        }
        return back();
    }
}
