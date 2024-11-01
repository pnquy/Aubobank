<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Stripe\StripeClient;
use Mockery;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_purchase_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('purchase.form'));

        $response->assertStatus(200);
        $response->assertViewIs('purchase.form');
    }

    public function test_process_purchase_success()
    {
        // Tạo user
        $user = User::factory()->create(['balance' => 0]);

        // Mock Stripe
        $stripeMock = Mockery::mock(StripeClient::class);
        $stripeMock->charges = Mockery::mock();
        $stripeMock->charges->shouldReceive('create')->once()->andReturn((object)[
            'id' => 'ch_test',
            'status' => 'succeeded',
        ]);

        $this->app->instance(StripeClient::class, $stripeMock);

        // Gửi yêu cầu nạp tiền
        $response = $this->actingAs($user)->post(route('purchase.process'), [
            'amount' => 50,
            'stripeToken' => 'tok_test',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Nạp tiền thành công!');

        // Kiểm tra số dư đã được cập nhật
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'balance' => 50,
        ]);
    }

    public function test_process_purchase_failure()
    {
        // Tạo user
        $user = User::factory()->create(['balance' => 0]);

        // Mock Stripe để throw exception
        $stripeMock = Mockery::mock(StripeClient::class);
        $stripeMock->charges = Mockery::mock();
        $stripeMock->charges->shouldReceive('create')->once()->andThrow(new \Exception('Stripe Error'));

        $this->app->instance(StripeClient::class, $stripeMock);

        // Gửi yêu cầu nạp tiền
        $response = $this->actingAs($user)->post(route('purchase.process'), [
            'amount' => 50,
            'stripeToken' => 'tok_test',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Lỗi khi nạp tiền: Stripe Error');

        // Kiểm tra số dư không thay đổi
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'balance' => 0,
        ]);
    }
}
