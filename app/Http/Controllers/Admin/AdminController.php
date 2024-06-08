<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\Admin\AdminService;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

class AdminController extends Controller
{
    /**
     * @var AdminService
     */
    private $adminService;

    /**
     * AdminController constructor.
     *
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        return view('admin.admin.index', $this->adminService->index());
    }

    public function create()
    {
        // dd('Create method called');
        if (count($this->adminService->create()) > 0) {
            return view('admin.admin.create', $this->adminService->create());
        }

        return redirect()->route('admin.admins_index');
    }

    public function store(StoreUserRequest $request)
    {
        return $this->adminService->store($request);
    }

    public function edit(User $admin)
    {

        //dd('Edit method called');
        if (count($this->adminService->edit($admin)) > 0){
            return view('admin.admin.edit',$this->adminService->edit($admin));
        }

        return redirect()->route('admin.admins_index');
    }

    public function update(UpdateUserRequest $request, User $admin)
    {
        return $this->adminService->update($request, $admin);
    }

    public function delete(Request $request)
    {
        return $this->adminService->delete($request);
    }
}
