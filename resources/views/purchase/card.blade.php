@extends('purchase.index')

@section('content')
@include('purchase.option', [
'option1' => 'Chuyển khoản bằng mã QR',
'content1' => 'Mở App Ngân hàng quét mã QRCode và nhập số tiền cần chuyển',
'img1' => '',
'option2' => 'Thanh toán thủ công theo thông tin',
'img2' => 'Hết hạn(08:00:00 - 01/01',
'name'=>'Phan Nhật Quý',
'number'=>'1025810870',
'content2' => 'NAP17519',
'bank'=>'Vietcombank'
])
@endsection