@extends('upgrade.index')

@section('content')
@include('upgrade.option', [
'name' => 'Gói 1',
'por' => 'Phổ biến',
'deadline' => 'Hết hạn(08:00:00 - 01/01/1970)',
'gate' => '
<div class="gate">
    <div>1 MoMo</div>
    <div>1 ACB</div>
    <div>1 MBBank</div>
    <div>1 Vietinbank</div>
</div>',
'price' => '250000'
])

@include('upgrade.option', [
'name' => 'Gói MoMo',
'por' => '',
'deadline' => 'Hết hạn(08:00:00 - 01/01/1970)',
'gate' => '
<div class="gate">
    <div>1 MoMo</div>
</div>',
'price' => '150000'
])

@include('upgrade.option', [
'name' => 'Gói Vietcombank',
'por' => '',
'deadline' => 'Hết hạn(08:00:00 - 01/01/1970)',
'gate' => '
<div class="gate">
    <div>1 Vietcombank</div>
</div>',
'price' => '200000'
])

@include('upgrade.option', [
'name' => 'Gói BIDV',
'por' => '',
'deadline' => 'Hết hạn(08:00:00 - 01/01/1970)',
'gate' => '
<div class="gate">
    <div>1 BIDV</div>
</div>',
'price' => '150000'
])

@include('upgrade.option', [
'name' => 'Gói MBBank',
'por' => '',
'deadline' => 'Hết hạn(08:00:00 - 01/01/1970)',
'gate' => '
<div class="gate">
    <div>1 MBBank</div>
</div>',
'price' => '100000'
])

@include('upgrade.option', [
'name' => 'Gói Thẻ siêu rẻ',
'por' => '',
'deadline' => 'Hết hạn(08:00:00 - 01/01/1970)',
'gate' => '
<div class="gate">
    <div>1 Thẻ siêu rẻ</div>
</div>',
'price' => '10000'
])

@include('upgrade.option', [
'name' => 'Gói TPBank',
'por' => '',
'deadline' => 'Hết hạn(08:00:00 - 01/01/1970)',
'gate' => '
<div class="gate">
    <div>1 TPBank</div>
</div>',
'price' => '100000'
])

@include('upgrade.option', [
'name' => 'Gói SeaBank',
'por' => '',
'deadline' => 'Hết hạn(08:00:00 - 01/01/1970)',
'gate' => '
<div class="gate">
    <div>1 SeaBank</div>
</div>',
'price' => '100000'
])

@include('upgrade.option', [
'name' => 'Gói ACB',
'por' => 'Khuyên dùng',
'deadline' => 'Hết hạn(08:00:00 - 01/01/1970)',
'gate' => '
<div class="gate">
    <div>1 ACB</div>
</div>',
'price' => '100000'
])

@include('upgrade.option', [
'name' => 'Gói Techcombank',
'por' => '',
'deadline' => 'Hết hạn(08:00:00 - 01/01/1970)',
'gate' => '
<div class="gate">
    <div>1 Techcombank</div>
</div>',
'price' => '200000'
])
@endsection