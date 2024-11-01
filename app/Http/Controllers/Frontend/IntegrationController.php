<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{

    public function  index()
    {
    }
    public function  listView()
    {
        $integrations = [
            (object) [
                'name' => 'Cổng thanh toán MoMo cá nhân',
                'intro' => '1 Tên miền • Đổi tên miền tùy thích',
                'description' => 'Module MoMo dùng cho WHMCS. Miễn phí sử dụng API khi mua Plugin (Chỉ dành riêng cho tính năng của plugin). Hỗ trợ cài đặt.',
                'price' => '899.000'
            ],
            (object) [
                'name' => 'Cổng thanh toán Vietcombank',
                'intro' => '1 Tên miền • Đổi tên miền tùy thích',
                'description' => 'Module MoMo dùng cho WHMCS. Miễn phí sử dụng API khi mua Plugin (Chỉ dành riêng cho tính năng của plugin). Hỗ trợ cài đặt.',
                'price' => '699.000'
            ],
            (object) [
                'name' => 'Cổng thanh toán ACB',
                'intro' => '1 Tên miền • Đổi tên miền tùy thích',
                'description' => 'Module MoMo dùng cho WHMCS. Miễn phí sử dụng API khi mua Plugin (Chỉ dành riêng cho tính năng của plugin). Hỗ trợ cài đặt.',
                'price' => '799.000'
            ]
        ];

        return view('frontend.integration.integration_list', compact('integrations'));
    }
}
