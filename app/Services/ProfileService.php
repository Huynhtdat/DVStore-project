<?php

namespace App\Services;

use App\Helpers\admin\TextSystemConst;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\Role;
use App\Models\UserVerify;
use App\Notifications\VerifyUser;
use App\Repository\Eloquent\AddressRepository;
use App\Repository\Eloquent\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class ProfileService
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
     * ProfileService constructor.
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
     * Show the form for creating a new user.
     *
     * @return array
     */
    public function changeProfile()
    {
        try {
            $user = Auth::guard('admin')->user();

            // Fields form
            $fields = [
                [
                    'attribute' => 'name',
                    'label' => 'Họ Và Tên',
                    'type' => 'text',
                    'value' => $user->name,
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                    'value' => $user->email,
                ],
                [
                    'attribute' => 'phone_number',
                    'label' => 'Số Điện Thoại',
                    'type' => 'text',
                    'format_phone' => true,
                    'value' => $user->phone_number,
                ],
                [
                    'attribute' => 'city',
                    'label' => 'Tỉnh, Thành Phố',
                    'type' => 'text',
                    'value' => $user->address->city ?? '',
                ],
                [
                    'attribute' => 'district',
                    'label' => 'Quận, Huyện',
                    'type' => 'text',
                    'value' => $user->address->district ?? '',
                ],
                [
                    'attribute' => 'ward',
                    'label' => 'Phường, Xã',
                    'type' => 'text',
                    'value' => $user->address->ward ?? '',
                ],
                [
                    'attribute' => 'apartment_number',
                    'label' => 'Số Nhà',
                    'type' => 'text',
                    'value' => $user->address->apartment_number ?? '',
                ],
            ];

            //Rules form
            $rules = [
                'email' => [
                    'required' => true,
                    'email' => true,
                ],
                'name' => [
                    'required' => true,
                    'minlength' => 1,
                    'maxlength' => 30,
                ],
                'apartment_number' => [
                    'required' => true,
                ],
                'city' => [
                    'required' => true,
                ],
                'district' => [
                    'required' => true,
                ],
                'ward' => [
                    'required' => true,
                ],
                'phone_number' => [
                    'required' => true,
                    'minlength' => 12,
                    'maxlength' => 12,
                ],
            ];

            // Messages eror rules
            $messages = [
                'name' => [
                    'required' => "Vui lòng nhập họ và tên",
                    'minlength' => "Họ và tên có tối thiểu 1 ký tự",
                    'maxlength' => "Họ và tên có tối đa 100 ký tự ",
                ],
                'email' => [
                    'required' => "Vui lòng nhập địa chỉ email",
                    'email' => "Địa chỉ email này không hợp lệ",
                ],
                'phone_number' => [
                    'required' => "Vui lòng nhập số điện thoại",
                    'minlength' => "Số điện thoại có tối thiểu 10 ký tự",
                    'maxlength' => "Số điện thoại có tối đa 10 ký tự",
                ],
                'city' => [
                    'required' =>  "Vui lòng nhập tỉnh, thành phố",
                ],
                'district' =>[
                    'required' =>  "Vui lòng nhập quận, huyện",
                ],
                'ward' => [
                    'required' => "Vui lòng nhập phường, xã",
                ],
                'apartment_number' => [
                    'required' =>  "Vui lòng nhập số nhà",
                ],

            ];
            return [
                'title' => TextLayoutTitle("profile"),
                'fields' => $fields,
                'rules' => $rules,
                'messages' => $messages,
            ];
        } catch (Exception) {
            return[];
        }
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            $user = $this->userRepository->find(Auth::guard('admin')->user()->id);
            $data = $request->validated();
            // user data request
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'role_id' => $user->role_id,
                'updated_by' => Auth::guard('admin')->user()->id,
            ];
            // address data request
            $addressData = [
                'city' => $data['city'],
                'district' => $data['district'],
                'ward' => $data['ward'],
                'apartment_number' => $data['apartment_number'],
            ];
            $addressData['user_id'] = $user->id;
            if ($user->address) {
                // Nếu địa chỉ đã tồn tại, cập nhật nó
                $this->addressRepository->update($user->address, $addressData);
            } else {
                // Nếu địa chỉ không tồn tại, tạo mới
                $addressData['user_id'] = $user->id;
                $this->addressRepository->create($addressData);
            }

            DB::beginTransaction();
            if ($userData['email'] !== $user->email) {
                unset($userData['email']);
                $this->userRepository->update($user, $userData);
                $token = Str::random(64);
                $time = Config::get('auth.verification.expire.resend', 60);
                UserVerify::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'token' => $token,
                        'expires_at' => Carbon::now()->addMinutes($time),
                        'email_verify' => $request->email,
                    ]
                );
                $user['email'] = $request->email;
                $user->notify(new VerifyUser($token));
            } else {
                $this->userRepository->update($user, $userData);
            }
            DB::commit();
            return back()->with('success', TextSystemConst::UPDATE_SUCCESS);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return back()->with('error', TextSystemConst::UPDATE_FAILED);
        }
    }

    public function changePassword()
    {
        try {
            // Fields form
            $fields = [
                [
                    'attribute' => 'current_password',
                    'label' => 'Mật Khẩu Cũ',
                    'type' => 'password',
                    'autocomplete' => 'new-password',
                ],
                [
                    'attribute' => 'new_password',
                    'label' => 'Mật Khẩu Mới',
                    'type' => 'password',
                    'autocomplete' => 'new-password',
                ],
                [
                    'attribute' => 'confirm_password',
                    'label' => 'Xác Nhận Mật Khẩu',
                    'type' => 'password',
                    'autocomplete' => 'new-password',
                ],
            ];

            //Rules form
            $rules = [
                'current_password' => [
                    'required' => true,
                ],
                'new_password' => [
                    'required' => true,
                    'minlength' => 8,
                    'maxlength' => 24,
                    'checklower' => true,
                    'checkupper' => true,
                    'checkdigit' => true,
                    'checkspecialcharacter' => true,
                ],
                'confirm_password' => [
                    'equalTo' => '#new_password',
                ],
            ];

            // Messages eror rules
            $messages = [
                'current_password' => [
                    'required' => "Nhập mật khẩu hiện tại ",
                ],
                'new_password' => [
                    'required' => "Nhập mật khẩu mới",
                    'minlength' => "Mật khẩu có tối thiểu 8 ký tự",
                    'maxlength' => "Mật khẩu có tối đa 24 ký tự",
                    'checklower' => "Mật khẩu có chứa ít nhất 1 chữ cái in thường",
                    'checkupper' => "Mật khẩu có chứa ít nhất 1 chữ cái in hoa",
                    'checkdigit' => "Mật khẩu có chứa ít nhất 1 chữ số",
                    'checkspecialcharacter' => "Mật khẩu phải chứa ít nhất 1 kí tự đặc biệt (%, #, @, _, /, -)",
                ],
                'confirm_password' => [
                    'equalTo' => 'Xác nhận mật khẩu không trùng khớp',
                ],
            ];
            return [
                'title' => TextLayoutTitle("change_password"),
                'fields' => $fields,
                'rules' => $rules,
                'messages' => $messages,
            ];
        } catch (Exception) {
            return[];
        }
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        try {
            $request->validated();
            $data = [
                'password' => $request->new_password,
            ];
            $user = $this->userRepository->find(Auth::guard('admin')->user()->id);
            $this->userRepository->update($user, $data);
            return back()->with('success', TextSystemConst::CHANGE_PASSWORD['success']);
        } catch (Exception) {
            return back()->with('error', TextSystemConst::CHANGE_PASSWORD['error']);
        }
    }
}
?>
