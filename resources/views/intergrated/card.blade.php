@extends('intergrated.index')

@section('content')
@include('intergrated.option', [
'name' => 'Cổng thanh toán MoMo cá nhân',
'content' => '
<ul>
    <li>Plugin MoMo dùng cho WordPress Woocommerce.</li>
    <li>Miễn phí sử dụng API khi mua Plugin (Chỉ dành riêng cho tính năng của plugin)</li>
</ul>',
'price' => '899.000'
])

@include('intergrated.option', [
'name' => 'Cổng thanh toán Vietcombank',
'content' => '
<ul>
    <li>Plugin Vietcombank dùng cho WordPress Woocommerce.</li>
    <li>Chưa bao gồm phí sử dụng API khi mua Plugin. (Chỉ dành riêng cho tính năng của plugin)</li>
</ul>',
'price' => '599.000'
])

@include('intergrated.option', [
'name' => 'Cổng thanh toán Techcombank',
'content' => '
<ul>
    <li>Plugin Techcombank dùng cho WordPress Woocommerce</li>
    <li>Miễn phí sử dụng API khi mua Plugin. (Chỉ dành riêng cho tính năng của plugin)</li>
</ul>',
'price' => '899.000'
])
@endsection