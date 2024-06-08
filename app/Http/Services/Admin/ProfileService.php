<?php

namespace App\Http\Services\Admin;

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
                    'label' => 'Fullname',
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
                    'label' => 'Phone Number',
                    'type' => 'text',
                    'format_phone' => true,
                    'value' => $user->phone_number,
                ],
                [
                    'attribute' => 'city',
                    'label' => 'City',
                    'type' => 'text',
                    'value' => $user->address->city ?? '',
                ],
                [
                    'attribute' => 'district',
                    'label' => 'District',
                    'type' => 'text',
                    'value' => $user->address->district ?? '',
                ],
                [
                    'attribute' => 'ward',
                    'label' => 'Ward',
                    'type' => 'text',
                    'value' => $user->address->ward ?? '',
                ],
                [
                    'attribute' => 'apartment_number',
                    'label' => 'Apartment Number',
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
                    'required' => "Please enter a fullname",
                    'minlength' => "The fullname must be at least 1 character long",
                    'maxlength' => "The fullname can be up to 100 characters long ",
                ],
                'email' => [
                    'required' => "Please enter a email",
                    'email' => "This email is not avail",
                ],
                'phone_number' => [
                    'required' => "Please enter a phone number",
                    'minlength' => "Phone number must be at least 10 characters long",
                    'maxlength' => "Phone number can be up to 10 characters long",
                ],
                'city' => [
                    'required' =>  "Please enter a city",
                ],
                'district' =>[
                    'required' =>  "Please enter a district",
                ],
                'ward' => [
                    'required' => "Please enter a ward",
                ],
                'apartment_number' => [
                    'required' =>  "Please enter a apartment number",
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
                    'label' => 'Current Password',
                    'type' => 'password',
                    'autocomplete' => 'new-password',
                ],
                [
                    'attribute' => 'new_password',
                    'label' => 'New Pasword',
                    'type' => 'password',
                    'autocomplete' => 'new-password',
                ],
                [
                    'attribute' => 'confirm_password',
                    'label' => 'Confirm Password',
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
                    'required' => "Please enter a current password",
                ],
                'new_password' => [
                    "required" => "Enter a new password",
                    "minlength" =>  "New password must be at least 8 characters long",
                    "maxlength" => "New password can be up to 24 characters long",
                    "checklower" => "Password must contain at least 1 lowercase letter",
                    "checkupper" => "Password must contain at least 1 uppercase letter",
                    "checkdigit"=> "Password must contain at least 1 digit",
                    "checkspecialcharacter" => "Password must contain at least 1 special character (%, #, @, _, /, -)"
                ],
                'confirm_password' => [
                    'equalTo' => "Password confirmation does not match",
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
