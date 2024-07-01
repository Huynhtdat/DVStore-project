<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Services\User\ProfileUserService;


class ProfileController extends Controller
{
    /**
     * @var ProfileUserService
     */
    private $profileUserService;

    /**
     * ProfileController constructor.
     *
     * @param ProfileUserService $profileUserService
     */
    public function __construct(ProfileUserService $profileUserService)
    {
        $this->profileUserService = $profileUserService;
    }
    /**
     * Displays home website.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.profile', $this->profileUserService->index());
    }

    public function changeProfile(UpdateProfileRequest $request)
    {
        return $this->profileUserService->changeProfile($request);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        return $this->profileUserService->changePassword($request);
    }
}
