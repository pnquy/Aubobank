<?php

namespace App\Http\Controllers\frontend;


use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdatePasswordRequest;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Package;

class UserController extends Controller
{

    public function profileView()
    {

        $userId = auth()->id();
        $packages = Package::with(['userPackages' => function ($query) {
            $query->orderBy('time_end', 'asc');
        }])->whereHas('userPackages', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
        return view('frontend.user.profile', compact("packages"));
    }

    public function changePasswordView()
    {
        return view('frontend.user.change_password');
    }


    public function updateProfile(UpdateProfileRequest $request)
    {

        $requestData = $request->except(['_token']);

        $user = auth()->user();
        $user->update($requestData);
        $user->save();

        return redirect()->back();
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();
        $currentPassword = $request->currentPassword;
        $hashedPassword = $user->password;
        if (Hash::check($currentPassword, $hashedPassword)) {

            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('layoutSuccessNotify', 'Cập nhập mật khẩu mới thành công');
        } else {
            return redirect()->back()->with('layoutErrorNotify', 'Nhập sai mật khẩu hiện tại');
        }
    }
}
