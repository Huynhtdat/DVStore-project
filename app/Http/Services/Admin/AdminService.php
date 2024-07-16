<?php

namespace App\Http\Services\Admin;

use App\Helpers\admin\TextSystemConst;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserVerify;
use App\Notifications\VerifyUser;
use App\Repository\Eloquent\AddressRepository;
use App\Repository\Eloquent\AdminRepository;
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

class AdminService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var AdminRepository
     */
    private $adminRepository;

    /**
     * @var AddressRepository
     */
    private $addressRepository;

    /**
     * AdminService constructor.
     *
     * @param UserRepository $userRepository
     * @param AdminRepository $adminRepository
     * @param AddressRepository $addressRepository
     */
    public function __construct(
        UserRepository $userRepository,
        AdminRepository $adminRepository,
        AddressRepository $addressRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->adminRepository = $adminRepository;
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
        $list = $this->userRepository->where(function ($query) {
            $query->where('role_id', '!=', Role::ROLE['user']);
        },);
        $tableCrud = [
            'headers' => [
                [
                    'text' => 'ID',
                    'key' => 'id',
                ],
                [
                    'text' => 'Họ Tên',
                    'key' => 'name',
                ],
                [
                    'text' => 'Email',
                    'key' => 'email',
                ],
                [
                    'text' => 'Vai Trò',
                    'key' => 'role.name',
                ],
                [
                    'text' => 'Trạng Thái',
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
                'create' => 'admin.admins_create',
                'delete' => 'admin.admins_delete',
                'edit' => 'admin.admins_edit',
            ],
            'list' => $list,
        ];

        return [
            'title' => TextLayoutTitle("administrators"),
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

            $roles = Role::select('id as value', 'name as text')->where('id', '!=', Role::ROLE['user'])->get()->toArray();
            // Fields form
            $fields = [
                [
                    'attribute' => 'name',
                    'label' => 'Họ Và Tên',
                    'type' => 'text',
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                ],
                [
                    'attribute' => 'password',
                    'label' => 'Mật Khẩu',
                    'type' => 'password',
                    'autocomplete' => 'new-password',
                ],
                [
                    'attribute' => 'phone_number',
                    'label' => 'Số Điện Thoại',
                    'type' => 'text',
                    'format_phone' => true,
                ],
                [
                    'attribute' => 'role_id',
                    'label' => 'Vai Trò',
                    'type' => 'select',
                    'list' => $roles,
                ],
                [
                    'attribute' => 'city',
                    'label' => 'Tỉnh, Thành Phố',
                    'type' => 'text',

                ],
                [
                    'attribute' => 'district',
                    'label' => 'Quận, Huyện',
                    'type' => 'text',

                ],
                [
                    'attribute' => 'ward',
                    'label' => 'Phường, Xã',
                    'type' => 'text',

                ],
                [
                    'attribute' => 'apartment_number',
                    'label' => 'Số Nhà',
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
                'title' => TextLayoutTitle("create_admin"),
                'fields' => $fields,
                'rules' => $rules,
                'messages' => $messages,
            ];
        } catch (Exception) {
            return [];
        }

    }

    /**
     * store the admin in the database.
     * @param App\Http\Requests\Admin\StoreStaffRequest $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreAdminRequest $request)
    {
        try {
            $data = $request->validated();
            // user data request
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'phone_number' => $data['phone_number'],
                'role_id' => $data['role_id'],
                'created_by' => Auth::guard('admin')->user()->id,
            ];

            // address data request
            $addressData = [
                'city' => $data['city'],
                'district' => $data['district'],
                'ward' => $data['ward'],
                'apartment_number' => $data['apartment_number'],
            ];


            $user = $this->userRepository->create($userData);

            $addressData['user_id'] = $user->id;
            $adminData['user_id'] = $user->id;
            $this->addressRepository->updateOrCreate($addressData);
            DB::commit();
            return redirect()->route('admin.admins_index')->with('success', TextSystemConst::CREATE_SUCCESS);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('admin.admins_index')->with('error', TextSystemConst::CREATE_FAILED);
        }
    }

    /**
     * Show the form for creating a new user.
     *
     * @return array
     */
    public function edit(User $user)
    {
        // try {
            $roles = Role::select('id as value', 'name as text')->where('id', '!=', Role::ROLE['user'])->get()->toArray();
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
                    'attribute' => 'password',
                    'label' => 'Mật Khẩu',
                    'type' => 'password',
                    'autocomplete' => 'new-password',
                ],
                [
                    'attribute' => 'phone_number',
                    'label' => 'Số Điện Thoại',
                    'type' => 'text',
                    'format_phone' => true,
                    'value' => $user->phone_number,
                ],
                [
                    'attribute' => 'role_id',
                    'label' => 'Vai Trò',
                    'type' => 'select',
                    'list' => $roles,
                    'value' => $user->role_id,
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
                [
                    'attribute' => 'active',
                    'label' => 'Trạng Thái',
                    'type' => 'select',
                    'list' => Role::STATUS,
                    'value' => $user->active,
                ],
                [
                    'attribute' => 'disable_reason',
                    'label' => 'Lý Do Khóa Tài Khoản',
                    'type' => 'text',
                    'value' => $user->disable_reason,
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
                'role_id' => [
                    'required' => true,
                ],
                'active' => [
                    'required' => true,
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
                'title' => TextLayoutTitle("edit_admin"),
                'fields' => $fields,
                'rules' => $rules,
                'messages' => $messages,
                'user' => $user,
            ];
        // } catch (Exception) {
        //     return [];
        // }

    }

    public function update(UpdateAdminRequest $request, User $user)
    {
        try {
            if ($user->role_id == Role::ROLE['user']) {
                return redirect()->route('admin.admins_index')->with('error', TextSystemConst::UPDATE_FAILED);
            }
            $data = $request->validated();
            // user data request
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'phone_number' => $data['phone_number'],
                'role_id' => $data['role_id'],
                'active' => $data['active'],
                'disable_reason' => $data['disable_reason'],
            ];

            // address data request
            $addressData = [
                'city' => $data['city'],
                'district' => $data['district'],
                'ward' => $data['ward'],
                'apartment_number' => $data['apartment_number'],
            ];

            $addressData['user_id'] = $user->id;
            $adminData['user_id'] = $user->id;
            $this->addressRepository->update($user->address, $addressData);
            if (!isset($userData['password'])) {
                unset($userData['password']);
            } elseif (!isset($userData['disable_reason'])) {
                unset($userData['disable_reason']);
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
            return redirect()->route('admin.admins_index')->with('success', TextSystemConst::UPDATE_SUCCESS);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return redirect()->route('admin.admins_index')->with('error', TextSystemConst::UPDATE_FAILED);
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
            // if ($user->id == Auth::guard('admin')->user()->id) {
            //     return response()->json(['status' => 'error', 'message' => TextSystemConst::SYSTEM_ERROR], 200);
            // }

            if($this->userRepository->delete($user) && $this->adminRepository->delete($user->admin)) {
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
