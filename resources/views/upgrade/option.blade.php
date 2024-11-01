<div class="package">
    <div class="section-1">
        <div class="name">
            <p class="name-package">{{$name}}</p>
            @if($por)
                <p class="por">{{ $por }}</p>
            @endif
        </div>
        <p class="deadline">{{$deadline}}</p>
    </div>
    <div class="section-2">
        <p class="price" data-base-price="{{$price}}">{{$price}}</p>
        <p class="coin">sCoin</p>
        <p class="month">/tháng</p>
    </div>
    <div class="section-3">
        <p style="margin-bottom: 10px;">Các cổng hoạt động</p>
        <div>
            {!! $gate !!}
        </div>
    </div>
    <div class="section-4">
        <ul>
            <li>Không giới hạn request</li>
            <li>Tốc độ cập nhật 30s/lần</li>
            <li>Không giới hạn tên miền</li>
        </ul>
    </div>
    <form class="time">
        <p>Thời gian sử dụng:</p>
        <select class="durationSelect">
            <option value="" disabled selected>Chọn thời gian sử dụng</option>
            <option value="1">1 tháng</option>
            <option value="2">2 tháng</option>
            <option value="3">3 tháng</option>
            <option value="4">4 tháng</option>
            <option value="5">5 tháng</option>
            <option value="6">6 tháng</option>
            <option value="7">7 tháng</option>
            <option value="8">8 tháng</option>
            <option value="9">9 tháng</option>
            <option value="10">10 tháng</option>
            <option value="11">11 tháng</option>
            <option value="12">12 tháng (giảm giá 10%)</option>
        </select>
        <button type="button" class="extendButton">Gia hạn {{$name}}</button>
        <div class="additionalInfoContainer" style="display: none;">
            <p>Giá sau khi chọn:</p>
            <input type="text" class="priceInput" readonly>
        </div>
    </form>
</div>
