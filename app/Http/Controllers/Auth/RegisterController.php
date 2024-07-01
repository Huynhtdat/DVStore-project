<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Notifications\VerifyUserRegister;
use App\Repository\Eloquent\AddressRepository;
use App\Repository\Eloquent\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
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
            $cities = []; // Example: ['Hà Nội', 'Hồ Chí Minh']
            $districts = []; // Example: ['Quận 1', 'Quận 2']
            $wards = []; // Example: ['Phường 1', 'Phường 2']

            $rules = [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|max:24|confirmed',
                'name' => 'required|min:1|max:30',
                'apartment_number' => 'required',
                'city' => 'required|string|max:50',
                'district' => 'required|string|max:50',
                'ward' => 'required|string|max:50',
                'phone_number' => 'required|min:10|max:11',
            ];

            $messages = [
                'name.required' => __('message.required', ['attribute' => 'Họ và tên']),
                'name.min' => __('message.min', ['min' => 1, 'attribute' => 'Họ và tên']),
                'name.max' => __('message.max', ['max' => 30, 'attribute' => 'Họ và tên']),
                'email.required' => __('message.required', ['attribute' => 'email']),
                'email.email' => __('message.email'),
                'email.unique' => __('message.unique', ['attribute' => 'email']),
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

            return view('auth.register', compact('cities', 'districts', 'wards', 'rules', 'messages'));
        } catch (Exception $e) {
            Log::error('Error in create method', ['exception' => $e]);
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
                'password' => Hash::make($data['password']),
                'phone_number' => $data['phone_number'],
                'role_id' => Role::ROLE['user'],
            ];

            $user = $this->userRepository->create($userData);

            $addressData = [
                'city' => $data['city'],
                'district' => $data['district'],
                'ward' => $data['ward'],
                'apartment_number' => $data['apartment_number'],
                'user_id' => $user->id,
            ];

            $this->addressRepository->create($addressData);

            return redirect()->route('user.login')->with('success', __('message.registration_success'));
        } catch (Exception $e) {
            Log::error('Error in store method', ['exception' => $e]);
            return back()->with('error', __('message.generic_error'));
        }
    }
}
