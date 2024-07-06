<?php

namespace App\Http\Services\Admin;

use App\Helpers\admin\TextSystemConst;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserVerify;
use App\Notifications\VerifyUser;
use App\Repository\Eloquent\AddressRepository;
use App\Repository\Eloquent\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use \Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

use App\Http\Services\Address\Address;

class UserService
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
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get list customers
        $list = $this->userRepository->all();
        $tableCrud = [
            'headers' => [
                [
                    'text' => 'ID',
                    'key' => 'id',
                ],
                [
                    'text' => 'Tên khách hàng',
                    'key' => 'name',
                ],
                [
                    'text' => 'Email',
                    'key' => 'email',
                ],
                [
                    'text' => 'Số điện thoại',
                    'key' => 'phone_number',
                ],
                [
                    'text' => 'Trạng thái',
                    'key' => 'active',
                    'status' => [
                        [
                            'text' => 'Hoạt động',
                            'value' => 1,
                            'class' => 'badge badge-success'
                        ],
                        [
                            'text' => 'Vô hiệu hóa',
                            'value' => 0,
                            'class' => 'badge badge-danger'
                        ],
                    ],
                ],
            ],
            'actions' => [
                'text'          => "Chức năng",
                'create'        => true,
                'createExcel'   => false,
                'edit'          => true,
                'deleteAll'     => false,
                'delete'        => true,
                'viewDetail'    => false,
            ],
            'routes' => [
                'create' => 'admin.users_create',
                'delete' => 'admin.users_delete',
                'edit' => 'admin.users_edit',
            ],
            'list' => $list,
        ];

        return [
            'title' => TextLayoutTitle("customer"),
            'tableCrud' => $tableCrud,
        ];
    }

    /**
     * Show the form for creating a new user.
     *
     * @return array
     */
    public function create()
    {
        try {
            // Fields form
            $fields = [
                [
                    'attribute' => 'name',
                    'label' => 'Họ và tên',
                    'type' => 'text',
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                ],
                [
                    'attribute' => 'password',
                    'label' => 'Mật khẩu mới',
                    'type' => 'password',
                    'autocomplete' => 'new-password',
                ],
                [
                    'attribute' => 'phone_number',
                    'label' => 'Phone Number',
                    'type' => 'text',
                    'format_phone' => true,
                ],
                [
                    'attribute' => 'city',
                    'label' => 'Tỉnh, thành phố',
                    'type' => 'text',
                ],
                [
                    'attribute' => 'district',
                    'label' => 'Quận, huyện',
                    'type' => 'text',

                ],
                [
                    'attribute' => 'ward',
                    'label' => 'Phường, xã',
                    'type' => 'text',

                ],
                [
                    'attribute' => 'apartment_number',
                    'label' => 'Số nhà',
                    'type' => 'text',
                ],
            ];

            //Rules form
            $rules = [
                'email' => [
                    'required' => true,
                    'email' => true,
                ],
                'password' => [
                    'required' => true,
                    'minlength' => 8,
                    'maxlength' => 24,
                    'checklower' => true,
                    'checkupper' => true,
                    'checkdigit' => true,
                    'checkspecialcharacter' => true,
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
                    'minlength' => 9,
                    'maxlength' => 12,
                ],
            ];

            // Messages eror rules
            $messages = [
                'name' => [
                    'required' => 'Vui lòng nhập họ tên đầy đủ của bạn',
                    'minlength' => 'Họ tên phải có ít nhất 1 ký tự',
                    'maxlength' => 'Họ tên không được dài quá 24 ký tự',
                ],
                'email' => [
                    'required' => 'Vui lòng nhập email của bạn',
                    'email' => 'Địa chỉ email không hợp lệ',
                ],
                'password' => [
                    'required' => 'Vui lòng nhập mật khẩu của bạn',
                    'minlength' => 'Mật khẩu phải có ít nhất 8 ký tự',
                    'maxlength' => 'Mật khẩu không được dài quá 24 ký tự',
                    'checklower' => 'Mật khẩu phải chứa ít nhất một chữ cái thường',
                    'checkupper' => 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa',
                    'checkdigit' => 'Mật khẩu phải chứa ít nhất một chữ số',
                    'checkspecialcharacter' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt (%, #, @, _, /, -)',
                ],
                'phone_number' => [
                    'required' => 'Vui lòng nhập số điện thoại của bạn',
                    'minlength' => 'Số điện thoại phải có ít nhất 10 ký tự',
                    'maxlength' => 'Số điện thoại không được dài quá 10 ký tự',
                ],
                'city' => [
                    'required' => 'Vui lòng nhập tỉnh, thành phố của bạn',
                ],
                'district' => [
                    'required' => 'Vui lòng nhập quận, huyện của bạn',
                ],
                'ward' => [
                    'required' => 'Vui lòng nhập phường, xã của bạn',
                ],
                'apartment_number' => [
                    'required' => 'Vui lòng nhập số nhà của bạn',
                ],
            ];




            return [
                'title' => TextLayoutTitle("create_user"),
                'fields' => $fields,
                'rules' => $rules,
                'messages' => $messages,
            ];
        } catch (Exception) {
            return [];
        }

    }

    /**
     * store the user in the database.
     * @param App\Http\Requests\Admin\StoreUserRequest $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {

        try {
            $data = $request->validated();
            // user data request
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'phone_number' => $data['phone_number'],
                'role_id' => Role::ROLE['user'],
            ];

            // address data request
            $addressData = [
                'city' => $data['city'],
                'district' => $data['district'],
                'ward' => $data['ward'],
                'apartment_number' => $data['apartment_number'],
            ];
            $user = User::create($userData);
            $addressData['user_id'] = $user->id;
            $this->addressRepository->updateOrCreate($addressData);
            DB::commit();
            return redirect()->route('admin.users_index')->with('success', TextSystemConst::CREATE_SUCCESS);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('admin.users_index')->with('error', TextSystemConst::CREATE_FAILED);
        }
    }

    /**
     * Show the form for creating a new user.
     *
     * @return array
     */
    public function edit(User $user)
    {
        try {
            // Fields form
            $fields = [
                [
                    'attribute' => 'name',
                    'label' => 'Họ và tên',
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
                    'attribute' => 'password',
                    'label' => 'Mật khẩu mới',
                    'type' => 'password',
                    'autocomplete' => 'new-password',
                ],
                [
                    'attribute' => 'phone_number',
                    'label' => 'Số điện thoai',
                    'type' => 'text',
                    'format_phone' => true,
                    'value' => $user->phone_number,
                ],
                [
                    'attribute' => 'city',
                    'label' => 'Tỉnh, thành phố',
                    'type' => 'text',
                    'value' => $user->address->city ?? '',
                ],
                [
                    'attribute' => 'district',
                    'label' => 'Quận, huyện',
                    'type' => 'text',
                    'value' => $user->address->district ?? '',
                ],
                [
                    'attribute' => 'ward',
                    'label' => 'Phường, xã',
                    'type' => 'text',
                    'value' => $user->address->ward ?? '',
                ],
                [
                    'attribute' => 'apartment_number',
                    'label' => 'Số nhà',
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
                'password' => [
                    'minlength' => 8,
                    'maxlength' => 24,
                    'checklower' => true,
                    'checkupper' => true,
                    'checkdigit' => true,
                    'checkspecialcharacter' => true,
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

            $messages = [
                'name' => [
                    'required' => 'Vui lòng nhập họ tên đầy đủ của bạn',
                    'minlength' => 'Họ tên phải có ít nhất 1 ký tự',
                    'maxlength' => 'Họ tên không được dài quá 24 ký tự',
                ],
                'email' => [
                    'required' => 'Vui lòng nhập email của bạn',
                    'email' => 'Địa chỉ email không hợp lệ',
                ],
                'password' => [
                    'required' => 'Vui lòng nhập mật khẩu của bạn',
                    'minlength' => 'Mật khẩu phải có ít nhất 8 ký tự',
                    'maxlength' => 'Mật khẩu không được dài quá 24 ký tự',
                    'checklower' => 'Mật khẩu phải chứa ít nhất một chữ cái thường',
                    'checkupper' => 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa',
                    'checkdigit' => 'Mật khẩu phải chứa ít nhất một chữ số',
                    'checkspecialcharacter' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt (%, #, @, _, /, -)',
                ],
                'phone_number' => [
                    'required' => 'Vui lòng nhập số điện thoại của bạn',
                    'minlength' => 'Số điện thoại phải có ít nhất 10 ký tự',
                    'maxlength' => 'Số điện thoại không được dài quá 10 ký tự',
                ],
                'city' => [
                    'required' => 'Vui lòng nhập tỉnh, thành phố của bạn',
                ],
                'district' => [
                    'required' => 'Vui lòng nhập quận, huyện của bạn',
                ],
                'ward' => [
                    'required' => 'Vui lòng nhập phường, xã của bạn',
                ],
                'apartment_number' => [
                    'required' => 'Vui lòng nhập số nahf của bạn',
                ],
            ];



            return [
                'title' => TextLayoutTitle("create_edit"),
                'fields' => $fields,
                'rules' => $rules,
                'messages' => $messages,
                'user' => $user,
            ];
        } catch (Exception) {
            return[];
        }

    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            if ($user->role_id != Role::ROLE['user']) {
                return redirect()->route('admin.users_index')->with('error', TextSystemConst::UPDATE_FAILED);
            }
            $data = $request->validated();
            // user data request
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'phone_number' => $data['phone_number'],
                'role_id' => Role::ROLE['user'],
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
            $this->addressRepository->update($user->address, $addressData);

            if (!isset($userData['password'])) {
                unset($userData['password']);
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
            return redirect()->route('admin.users_index')->with('success', TextSystemConst::UPDATE_SUCCESS);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('admin.users_index')->with('error', TextSystemConst::UPDATE_FAILED);
        }
    }

     /**
     * delete the user in the database.
     * @param Illuminate\Http\Request; $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        try{
            $user = $this->userRepository->find($request->id);
            if ($user->id == Auth::guard('admin')->user()->id) {
                return response()->json(['status' => 'error', 'message' => TextSystemConst::SYSTEM_ERROR], 200);
            }

            if($this->userRepository->delete($user)) {
                $this->userRepository->update(
                    $user,
                    ['deleted_by' => Auth::guard('admin')->user()->id]
                );
                return response()->json(['status' => 'success', 'message' => TextSystemConst::DELETE_SUCCESS], 200);
            }

            return response()->json(['status' => 'failed', 'message' => TextSystemConst::DELETE_FAILED], 200);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => TextSystemConst::SYSTEM_ERROR], 200);
        }
    }
}
?>
