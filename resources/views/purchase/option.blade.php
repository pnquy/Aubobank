<div class="purchase">
    <div class="block block-left">
        <div class="status">
            <p>Mới</p>
        </div>
        <div class="name">
            <p class="bold">Cách 1: </p>
            <p class="name-option">{{$option1}}</p>
        </div>
        <div class="description">
            <p>{{$content1}}</p>
        </div>
        <div class="qr">
            <img src="{{asset('img/bank/1025810870.png')}}" alt="">
        </div>
    </div>
    <div class="block">
        <div class="status">
            <p>Phổ biến</p>
        </div>
        <div class="name">
            <p class="bold">Cách 2: </p>
            <p class="name-option">{{$option2}}</p>
        </div>
        <div class="bank">
            <img src="{{asset('img/bank/9d8ed5_810e9e3b7fad40eca3ec5087da674662~mv2.png')}}" alt="">
        </div>
        <table>
            <tbody class="information">
            <tr class="owner">
                <td>Chủ tài khoản:</td>
                <td class="name-owner">{{$name}}</td>
            </tr>
            <tr class="owner">
                <td>Số tài khoản: </td>
                <td class="number-owner">{{$number}}</td>
            </tr>
            <tr class="owner">
                <td>Nội dung chuyển tiền:</td>
                <td class="banking-owner">{{$content2}}</td>
            </tr>
            <tr class="owner">
                <td>Ngân hàng:</td>
                <td class="bank-owner">{{$bank}}</td>
            </tr>
        </tbody>
        </table>
        
        <div class="wait">
            <p>Đang chờ chuyển khoản</p>
        </div>
        <div class="alert">
            <p>Lưu ý: Nếu sau 2 phút chưa nhận được sCoin vui lòng F5 (Reload) trang này</p>
        </div>
        <div>
            <img src="{{asset('img/gif/Ellipsis@1x-1.0s-200px-200px.gif')}}" alt="">
        </div>
    </div>
</div>