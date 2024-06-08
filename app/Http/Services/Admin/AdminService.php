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

class AdminService
{
    /**
     * @var UserRepository
     */
    private $adminRepository;

    /**
     * @var AddressRepository
     */
    private $addressRepository;

    /**
     * AdminService constructor.
     *
     * @param AdminRepository $adminRepository
     * @param AddressRepository $addressRepository
     */
    public function __construct(UserRepository $adminRepository, AddressRepository $addressRepository)
    {
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
        $list = $this->adminRepository->admins();
        $tableCrud = [
            'headers' => [
                [
                    'text' => 'ID',
                    'key' => 'id',
                ],
                [
                    'text' => 'Name Admin',
                    'key' => 'name',
                ],
                [
                    'text' => 'Email',
                    'key' => 'email',
                ],
                [
                    'text' => 'Phone Number',
                    'key' => 'phone_number',
                ],
                [
                    'text' => 'Status',
                    'key' => 'active',
                    'status' => [
                        [
                            'text' => 'Availiable',
                            'value' => 1,
                            'class' => 'badge badge-success'
                        ],
                        [
                            'text' => 'Disable',
                            'value' => 0,
                            'class' => 'badge badge-danger'
                        ],
                    ],
                ],
            ],
            'actions' => [
                'text'          => "Tool",
                'create'        => true,
                'createExcel'   => false,
                'edit'          => true,
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
                    'label' => 'Full Name',
                    'type' => 'text',
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                ],
                [
                    'attribute' => 'password',
                    'label' => 'Password',
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
                    'label' => 'City',
                    'type' => 'text',
                    // 'list' => $provinces,
                ],
                [
                    'attribute' => 'district',
                    'label' => 'District',
                    'type' => 'text',
                    // 'list' => $districts,
                ],
                [
                    'attribute' => 'ward',
                    'label' => 'Ward',
                    'type' => 'text',
                    // 'list' => $wards,
                ],
                [
                    'attribute' => 'apartment_number',
                    'label' => 'Apartment Number',
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
                    'maxlength' => 12
                ],
            ];

            // Thông báo bẫy lỗi
            $messages = [
                'name' => [
                    'required' => 'Please enter your full name',
                    'minlength' => 'Full name must be at least 1 character long',
                    'maxlength' => 'Full name must not exceed 24 characters',
                ],
                'email' => [
                    'required' => 'Please enter your email',
                    'email' => 'Invalid email address',
                ],
                'password' => [
                    'required' => 'Please enter your password',
                    'minlength' => 'Password must be at least 8 characters long',
                    'maxlength' => 'Password must not exceed 24 characters',
                    'checklower' => 'Password must contain at least one lowercase letter',
                    'checkupper' => 'Password must contain at least one uppercase letter',
                    'checkdigit' => 'Password must contain at least one digit',
                    'checkspecialcharacter' => 'Password must contain at least one special character (%, #, @, _, /, -)',
                ],
                'phone_number' => [
                    'required' => 'Please enter your phone number',
                    'minlength' => 'Phone number must be at least 10 characters long',
                    'maxlength' => 'Phone number must not exceed 11 characters',
                ],
                'city' => [
                    'required' => 'Please enter your city',
                ],
                'district' => [
                    'required' => 'Please enter your district',
                ],
                'ward' => [
                    'required' => 'Please enter your ward',
                ],
                'apartment_number' => [
                    'required' => 'Please enter your apartment number',
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
                'role_id' => Role::ROLE['admin'],
            ];

            // address data request
            $addressData = [
                'city' => $data['city'],
                'district' => $data['district'],
                'ward' => $data['ward'],
                'apartment_number' => $data['apartment_number'],
            ];

            // $token = Str::random(64);
            // $time = Config::get('auth.verification.expire.resend', 60);
            // DB::beginTransaction();
            // $user = $this->userRepository->create($userData);
            // UserVerify::updateOrCreate(
            //     ['user_id' => $user->id],
            //     [
            //         'token' => $token,
            //         'expires_at' => Carbon::now()->addMinutes($time),
            //     ]
            // );
            // $user->notify(new VerifyUser($token));
            $user = User::create($userData);
            $addressData['user_id'] = $user->id;
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
        try {
            // Fields form
            $fields = [
                [
                    'attribute' => 'name',
                    'label' => 'Full Name',
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
                    'label' => 'New Password',
                    'type' => 'password',
                    'autocomplete' => 'new-password',
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

            // thông báo bẫy lỗi
            $messages = [
                'name' => [
                    'required' => 'Please enter your full name',
                    'minlength' => 'Full name must be at least 1 character long',
                    'maxlength' => 'Full name must not exceed 24 characters',
                ],
                'email' => [
                    'required' => 'Please enter your email',
                    'email' => 'Invalid email address',
                ],
                'password' => [
                    'required' => 'Please enter your password',
                    'minlength' => 'Password must be at least 8 characters long',
                    'maxlength' => 'Password must not exceed 24 characters',
                    'checklower' => 'Password must contain at least one lowercase letter',
                    'checkupper' => 'Password must contain at least one uppercase letter',
                    'checkdigit' => 'Password must contain at least one digit',
                    'checkspecialcharacter' => 'Password must contain at least one special character (%, #, @, _, /, -)',
                ],
                'phone_number' => [
                    'required' => 'Please enter your phone number',
                    'minlength' => 'Phone number must be at least 10 characters long',
                    'maxlength' => 'Phone number must not exceed 10 characters',
                ],
                'city' => [
                    'required' => 'Please enter your city',
                ],
                'district' => [
                    'required' => 'Please enter your district',
                ],
                'ward' => [
                    'required' => 'Please enter your ward',
                ],
                'apartment_number' => [
                    'required' => 'Please enter your apartment number',
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
            if ($user->role_id != Role::ROLE['admin']) {
                return redirect()->route('admin.admins_index')->with('error', TextSystemConst::UPDATE_FAILED);
            }
            $data = $request->validated();
            // user data request
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'phone_number' => $data['phone_number'],
                'role_id' => Role::ROLE['admin'],
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

            // DB::beginTransaction();
            // if ($userData['email'] !== $user->email) {
            //     unset($userData['email']);
            //     $this->adminRepository->update($user, $userData);
            //     $token = Str::random(64);
            //     $time = Config::get('auth.verification.expire.resend', 60);
            //     UserVerify::updateOrCreate(
            //         ['user_id' => $user->id],
            //         [
            //             'token' => $token,
            //             'expires_at' => Carbon::now()->addMinutes($time),
            //             'email_verify' => $request->email,
            //         ]
            //     );
            //     $user['email'] = $request->email;
            //     $user->notify(new VerifyUser($token));
            // } else {
            //     $this->adminRepository->update($user, $userData);
            // }

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
            $admin = $this->adminRepository->find($request->id);
            if ($admin->id == Auth::guard('admin')->user()->id) {
                return response()->json(['status' => 'error', 'message' => TextSystemConst::SYSTEM_ERROR], 200);
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
