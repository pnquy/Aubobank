<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Kiểm tra rằng người dùng có thể cập nhật mật khẩu thành công.
     *
     * @return void
     */
    public function test_password_can_be_updated(): void
    {
        // Tạo một người dùng với mật khẩu ban đầu và trạng thái hoạt động
        $user = User::factory()->create([
            'password' => Hash::make('password'),
            'active' => true, // Đảm bảo người dùng đang hoạt động
        ]);

        // Thực hiện yêu cầu POST đến route cập nhật mật khẩu
        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->post(route('profile.change-password'), [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        // Kiểm tra rằng không có lỗi trong session và người dùng được chuyển hướng đến /profile
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        // Kiểm tra rằng mật khẩu mới đã được cập nhật trong cơ sở dữ liệu
        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    /**
     * Kiểm tra rằng người dùng phải cung cấp mật khẩu hiện tại đúng để cập nhật mật khẩu.
     *
     * @return void
     */
    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        // Tạo một người dùng với mật khẩu ban đầu và trạng thái hoạt động
        $user = User::factory()->create([
            'password' => Hash::make('password'),
            'active' => true, // Đảm bảo người dùng đang hoạt động
        ]);

        // Thực hiện yêu cầu POST đến route cập nhật mật khẩu với mật khẩu hiện tại sai
        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->post(route('profile.change-password'), [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        // Kiểm tra rằng có lỗi liên quan đến 'current_password' trong session và người dùng được chuyển hướng đến /profile
        $response
            ->assertSessionHasErrors(['current_password'])
            ->assertRedirect('/profile');

        // Kiểm tra rằng mật khẩu chưa được cập nhật
        $this->assertTrue(Hash::check('password', $user->refresh()->password));
    }
}
