@extends('intergrated.index')

@section('content')
@include('intergrated.option', [
'name' => 'Cổng thanh toán MoMo cá nhân',
'content' => '
<ul>
    <li>Module MoMo dùng cho WHMCS.</li>
    <li>Miễn phí sử dụng API khi mua Plugin (Chỉ dành riêng cho tính năng của plugin)</li>
    <li>Hỗ trợ cài đặt.</li>
</ul>',
'price' => '899.000'
])

@include('intergrated.option', [
'name' => 'Cổng thanh toán Vietcombank',
'content' => '
<ul>
    <li>Module Vietcombank dùng cho WHMCS.</li>
    <li>Chưa bao gồm phí sử dụng API khi mua Plugin. (Chỉ dành riêng cho tính năng của plugin)</li>
    <li>Hỗ trợ cài đặt.</li>
</ul>',
'price' => '599.000'
])

@include('intergrated.option', [
'name' => 'Cổng thanh toán ACB',
'content' => '
<ul>
    <li>Module ACB dùng cho WHMCS.</li>
    <li>Miễn phí sử dụng API khi mua Plugin (Chỉ dành riêng cho tính năng của plugin)</li>
    <li>Hỗ trợ cài đặt.</li>
</ul>',
'price' => '899.000'
])
@endsection