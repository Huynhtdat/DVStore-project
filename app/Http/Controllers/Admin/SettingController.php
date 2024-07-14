<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Displays setting website.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.setting.setting', [
            'title' => 'Cấu hình Website',
            'setting' => Setting::first()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            if ($request->logo) {
                $imageName = time().'.'.request()->logo->getClientOriginalExtension();
                request()->logo->move(public_path('asset/client/images/'), $imageName);
                $data['logo'] = $imageName;
            }
            $setting = Setting::first();
            $setting->update($data);
            return back()->with('success', 'Cập nhật thành công');
        } catch (Exception) {
            return back()->with('error', 'Cập nhật thất bại');
        }
    }
}
