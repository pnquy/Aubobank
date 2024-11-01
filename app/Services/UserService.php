<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService
{
    // Update profile phone
    public function updateProfilePhone($user, string $phone)
    {
        $user->phone = $phone;
        $user->save();
    }

    // Update profile organization
    public function updateProfileOrganization($user, string $organization)
    {
        $user->organization = $organization;
        $user->save();
    }

    // Update profile address
    public function updateProfileAddress($user, string $address)
    {
        $user->address = $address;
        $user->save();
    }

    // Update profile OTP
    public function updateProfileOTP($user, string $otp)
    {
        $user->otp = $otp;
        $user->save();
    }

    // Update anti-duplicate field
    public function updateProfileAntiDuplicate($user, string $antiDuplicate)
    {
        $user->anti_duplicate = $antiDuplicate;
        $user->save();
    }

    // Update profile (group function)
    public function updateProfile($user, array $data)
    {
        $this->updateProfilePhone($user, $data['phone']);
        $this->updateProfileOrganization($user, $data['organization']);
        $this->updateProfileAddress($user, $data['address']);
        $this->updateProfileOTP($user, $data['otp']);
        $this->updateProfileAntiDuplicate($user, $data['anti_duplicate']);
    }

    // Validate current password
    public function validateCurrentPassword($user, $currentPassword): bool
    {
        return Hash::check($currentPassword, $user->password);
    }

    // Update new password
    public function updateNewPassword($user, $newPassword)
    {
        $user->password = Hash::make($newPassword);
        $user->save();
    }

    // Change password (group function)
    public function changePassword(ChangePasswordRequest $request): bool
    {
        $user = Auth::user();
        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');

        if (!$this->validateCurrentPassword($user, $currentPassword)) {
            return false;
        }

        $this->updateNewPassword($user, $newPassword);
        return true;
    }

    // Delete old avatar
    public function deleteOldAvatar($user)
    {
        if ($user->avatar) {
            Storage::delete('public/avatars/' . $user->avatar);
        }
    }

    // Store new avatar
    public function storeNewAvatar($request, $user)
    {
        if ($request->file('avatar')) {
            $avatarName = $user->id . '_avatar' . time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);

            $user->avatar = $avatarName;
            $user->save();
        }
    }

    // Update user avatar (group function)
    public function updateUserAvatar($request)
    {
        $user = Auth::user();

        $this->deleteOldAvatar($user);
        $this->storeNewAvatar($request, $user);
    }

    // Deactivate user
    public function deactivateUser($user)
    {
        $user->active = 0;
        $user->save();
    }

    // Deactivate account (group function)
    public function deactivateAccount(): bool
    {
        $user = Auth::user();

        if ($user) {
            $this->deactivateUser($user);
            Auth::logout();
            return true;
        }

        return false;
    }
}
