<?php

namespace App\Http\Controllers\Auth;

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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    private $userRepository;
    private $addressRepository;

    public function __construct(UserRepository $userRepository, AddressRepository $addressRepository)
    {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
    }

    public function create()
    {
        try {

            $citys = $this->getCityData();
            $districts = $this->getDistrictData();
            $wards = $this->getWardData();

            // Validation rules and error messages
            $rules = [
                'email' => 'required|email',
                'password' => 'required|min:8|max:24|confirmed',
                'name' => 'required|min:1|max:30',
                'apartment_number' => 'required',
                'city' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'phone_number' => 'required|min:10|max:11',
            ];

            $messages = [
                'name.required' => __('message.required', ['attribute' => 'Họ và tên']),
                'name.min' => __('message.min', ['min' => 1, 'attribute' => 'Họ và tên']),
                'name.max' => __('message.max', ['max' => 30, 'attribute' => 'Họ và tên']),
                'email.required' => __('message.required', ['attribute' => 'email']),
                'email.email' => __('message.email'),
                'password.required' => __('message.required', ['attribute' => 'mật khẩu']),
                'password.min' => __('message.min', ['attribute' => 'Mật khẩu', 'min' => 8]),
                'password.max' => __('message.max', ['attribute' => 'Mật khẩu', 'max' => 24]),
                'password.confirmed' => __('message.password.confirmed'),
                'apartment_number.required' => __('message.required', ['attribute' => 'số nhà']),
                'city.required' => __('message.required', ['attribute' => 'tỉnh, thành phố']),
                'district.required' => __('message.required', ['attribute' => 'quận, huyện']),
                'ward.required' => __('message.required', ['attribute' => 'phường, xã']),
                'phone_number.required' => __('message.required', ['attribute' => 'số điện thoại']),
                'phone_number.min' => __('message.min', ['attribute' => 'số điện thoại', 'min' => 10]),
                'phone_number.max' => __('message.max', ['attribute' => 'số điện thoại', 'max' => 11]),
            ];

            return view('auth.register', compact('citys', 'districts', 'wards', 'rules', 'messages'));
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('user.login')->with('error', __('message.generic_error'));
        }
    }

    public function store(UserRegisterRequest $request)
    {
        try {
            $data = $request->validated();

            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
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
            $time = config('auth.verification.expire.resend', 60);

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

            return redirect()->route('user.verification.notice', $user->id)->with('success', __('message.registration_success'));
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', __('message.generic_error'));
        }
    }

    private function getCityData()
    {
        // Retrieve city data from API
        return [];
    }

    private function getDistrictData()
    {
        // Retrieve district data from API
        return [];
    }

    private function getWardData()
    {
        // Retrieve ward data from API
        return [];
    }
}
