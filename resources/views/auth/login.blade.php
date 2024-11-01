<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="form">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label class="none" for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="">
                <x-input-label class="none" for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password"
                    placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4 none">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div>
                @if (Route::has('password.request'))
                <a class="color-main text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Quên mật khẩu?') }}
                </a>
                @endif
            </div>
            <div class="button">
                <div class="padding">
                    @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="register">
                        Tạo tài khoản
                    </a>
                    @endif
                </div>
                <div class="padding">

                    <x-primary-button class="login">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </div> 
            <div style="display: block;">
                <p>Bằng cách đăng nhập, bạn đồng ý với </p>
                <a href="#" class="policy" onclick="openTermsPopup()">Các điều khoản và điều kiện</a>
                <p class="content"> & </p><a href="#" class="service">Chính sách bảo mật</a>
                </br>
                <a href="#" class="service">sPayment là gì</a>
            </div>
        </form>
        </div>
        <div id="termsPopup" class="popup" >
      <div class="popup-content">
        <span class="close" onclick="closeTermsPopup()">&times;</span>
        <h2>Các điều khoản và điều kiện</h2>
        <p> <b>THỎA THUẬN SỬ DỤNG PHẦN MỀM SPAYMENT</b></p>

<p> Đây là thỏa thuận pháp lý giữa khách hàng với Công Ty Cổ Phần FUTE. Quy định các điều khoản trong việc khách hàng sử dụng dịch vụ phần mềm sPayment. Thỏa thuận này là hợp đồng điện tử giữa hai bên.</p>

<p> Bằng cách nhấp chuột vào nút “Đồng ý” khi đăng ký sử dụng, khách hàng đồng ý rằng các điều khoản này sẽ được áp dụng nếu khách hàng lựa chọn truy cập hoặc sử dụng dịch vụ và thao tác nhấp chuột này tương đương với việc hai bên đã ký kết hợp đồng.</p>

<p> <b>1.Các thuật ngữ sử dụng trong thỏa thuận</b></p>

1.1 Phần mềm: Phần mềm mang tên sPayment do Công Ty Cổ Phần FUTE cung cấp.</br>

1.2 Hệ thống: Bao gồm các máy chủ đặt tại trung tâm dữ liệu của Web2M, được cài đặt các phần mềm hệ thống và phần mềm sPayment.</br>

1.3 Web2M: Là  Công Ty Cổ Phần FUTE, nhà cung cấp dịch vụ phần mềm sPayment.</br>

1.4 Khách hàng: Là tổ chức hoặc cá nhân đứng ra đăng ký dùng thử hoặc trả tiền sử dụng dịch vụ phần mềm sPayment.</br>

1.5 Phí khởi tạo: Là khoản phí mà khách hàng phải trả một lần duy nhất cho Web2M để khởi tạo sử dụng phần mềm lần đầu tiên.</br>

1.6 Phí thuê bao: Là khoản phí mà khách hàng phải trả cho Web2M để duy trì sử dụng phần mềm. Phí thuê bao được tính hàng tháng và khách hàng có thể thanh toán trước cho nhiều tháng khi đặt mua.</br>

1.7 Thời gian thuê bao: Là khoảng thời gian khách hàng được cấp quyền sử dụng dịch vụ phần mềm sPayment theo yêu cầu đăng ký và thỏa thuận thanh toán phí với Web2M.</br>

1.8 Gia hạn thuê bao: Là việc Web2M cấp thêm thời gian sử dụng dịch vụ phần mềm sPayment cho khách hàng theo thỏa thuận của hai bên.</br>

1.9 Thông tin phái sinh: là các thông tin được tổng hợp, suy luận từ các thông tin gốc do khách hàng tạo ra trong phần mềm của Web2M. Ví dụ: Thông tin phái sinh từ phần mềm quản lý dòng tiền trong kinh doanh có thể là Báo cáo về doanh số trung bình, chi phí trung bình hàng tháng…</br>

<p> <b>2. Quyền sử dụng phần mềm</b></p>
2.1 Khách hàng có quyền sử dụng đầy đủ các tính năng của phần mềm trong thời gian thuê bao còn hạn sử dụng.</br>

2.2 Đối với mỗi thuê bao khách hàng đã đăng ký và thanh toán tiền sử dụng thì sẽ được cấp một API Key theo đăng ký của khách hàng để khách hàng sử dụng.</br>

2.3 Khách hàng không được phép sử dụng dịch vụ phần mềm bao gồm nhưng không giới hạn bởi việc cập nhật dữ liệu, gửi email, viết bài hoặc truyền tải dữ liệu với mục đích sau:</br>

a) Làm tổn hại, làm phiền cho người khác hoặc gây ra thương tổn đến con người và tài sản;</br>

b) Liên quan đến việc công bố các thông tin hoặc tài liệu lừa đảo, gây mất uy tín danh dự, quấy rối hoặc mang tính khiêu dâm;</br>

c) Xâm phạm các quyền riêng tư hoặc kỳ thị chủng tộc, tôn giáo, giới tính, người tàn tật;</br>

d) Xâm phạm quyền sở hữu trí tuệ hoặc các quyền sở hữu khác;</br>

e) Cản trở hoặc phá hỏng Dịch vụ (bao gồm nhưng không giới hạn bởi việc truy cập Dịch vụ thông qua bất cứ phương tiện máy móc, phần mềm);</br>

f) Vi phạm quy định của pháp luật.</br>

2.4 Trước khi hết hạn, khách hàng cần thực hiện thủ tục gia hạn thuê bao để tiếp tục sử dụng phần mềm. Thời điểm gia hạn là thời điểm tính từ ngày hết hạn của kỳ đăng ký sử dụng trước đó.</br>

2.5 Khi hết hạn thuê bao, khách hàng chỉ được đăng nhập vào để sử dụng phần mềm trong vòng 07 ngày kể từ ngày hết hạn. Quá 07 ngày, phần mềm sẽ không cho phép khách hàng đăng nhập vào để sử dụng nữa.</br>

2.6 Khi thuê bao quá hạn 30 ngày, nếu khách hàng chưa làm thủ tục đăng ký và thanh toán tiền gia hạn thuê bao thì Web2M sẽ làm thủ tục cắt thuê bao và xóa bỏ dữ liệu của khách hàng. Khách hàng sẽ không sử dụng được dịch vụ phần mềm sPayment nữa sau khi Web2M đã cắt thuê bao.</br>

2.7 Khách hàng sẽ bị cắt thuê bao sử dụng phần mềm sPayment trong vòng 07 ngày kể từ khi nhận được thông báo cắt dịch vụ của Web2M gửi qua email hoặc hệ thống tự động thông báo trong trường hợp:</br>

a) Khách hàng không làm thủ tục đăng ký gia hạn, thanh toán với Web2M nếu thuê bao quá hạn sử dụng 30 ngày;</br>

b) Khách hàng yêu cầu cắt thuê bao phần mềm;</br>

c) Khách hàng vi phạm mục đích sử dụng phần mềm được nêu trong thỏa thuận này;</br>

d) Khách hàng vi phạm pháp luật và cơ quan công quyền yêu cầu Web2M ngừng cung cấp dịch vụ thuê bao cho khách hàng.</br>

<p> <b>3. Giá cả và phương thức thanh toán</b></p>
3.1 Lần đầu tiên khi bắt đầu sử dụng phần mềm, khách hàng phải thanh toán phí khởi tạo và phí thuê bao cho Web2M.</br>

3.2 Khách hàng chịu trách nhiệm thanh toán cho Web2M 100% giá trị của gói sản phẩm/dịch vụ mà khách hàng chọn mua ngay sau khi khách hàng gửi đơn đặt hàng cho Web2M.</br>

3.3 Thời điểm bắt đầu tính phí thuê bao được tính từ ngày Web2M bàn giao cho khách hàng thông tin truy cập vào phần mềm căn cứ vào email thông báo của Web2M.</br>

3.4 Việc thanh toán phí thuê bao cho kỳ tiếp theo phải được thực hiện trước ngày hết hạn của kỳ thuê bao trước đó. Web2M sẽ gửi thông báo về việc đóng phí thuê bao trực tiếp trên chính phần mềm sPayment mà khách hàng đang sử dụng (quy định tại điều 6.5a).</br>

3.5 Web2M có quyền điều chỉnh mức phí thuê bao theo giá thị trường và công bố trực tiếp trên website https://web2m.vn. Trong trường hợp khách hàng đã thanh toán trước phí thuê bao cho nhiều kỳ thì mức phí thuê bao sẽ không thay đổi trong suốt thời hạn thuê bao mà khách hàng đã thanh toán.</br>

3.6 Khách hàng chịu trách nhiệm thanh toán cho Web2M bằng tiền mặt, chuyển khoản hoặc thanh toán trực tuyến thông qua ngân hàng hoặc đối tác thứ ba. Trường hợp thanh toán bằng tiền mặt, khách hàng chỉ thanh toán cho cán bộ của Web2M khi có đủ giấy tờ: Giấy giới thiệu của công ty về việc nhận tiền mặt (có ghi rõ số tiền), thẻ nhân viên, chứng minh nhân dân của người được ghi trong giấy giới thiệu.</br>

<p> <b>4. Bàn giao sản phẩm, dịch vụ</b></p>
4.1 Web2M chịu trách nhiệm bàn giao cho khách hàng thông tin truy cập hệ thống qua email. Khi khách hàng nhận được email thì Web2M coi như đã hoàn thành nghĩa vụ bàn giao sản phẩm của mình cho khách hàng.</br>

4.2 Khách hàng chịu trách nhiệm chuẩn bị đầy đủ thiết bị, nhân lực và đường truyền theo đúng khuyến cáo của Web2M ghi trong phần mềm để tổ chức khai thác, vận hành hệ thống phần mềm.</br>

4.3 Khách hàng chịu trách nhiệm tiếp nhận, sử dụng phần mềm đúng theo hướng dẫn và khuyến cáo sử dụng của Web2M công bố trong phần mềm.</br>

4.4 Khi tiếp nhận bàn giao tài khoản truy cập từ Web2M, khách hàng có trách nhiệm thay đổi mật khẩu ngầm định ngay trong lần đầu tiên sử dụng phần mềm.</br>

<p> <b>5. Tư vấn và hỗ trợ khách hàng</b></p>
5.1 Web2M chịu trách nhiệm cung cấp dịch vụ tư vấn hỗ trợ cho khách hàng trong suốt quá trình sử dụng thông qua hình thức gọi điện thoại, email, diễn đàn và các hình thức hỗ trợ khác được công bố tại website https://web2m.com</br>

5.2 Khi sử dụng dịch vụ tư vấn qua hình thức gọi điện thoại, khách hàng chấp nhận trả cước phí điện thoại theo quy định của nhà cung cấp dịch vụ viễn thông.</br>

5.3 Các dịch vụ tư vấn hỗ trợ thông qua hình thức khác (như dịch vụ tư vấn hỗ trợ tại các địa điểm theo yêu cầu của khách hàng, dịch vụ tái đào tạo hướng dẫn sử dụng cho khách hàng) sẽ được hai bên thống nhất về chi phí và phương thức cung cấp bằng văn bản bổ sung khi có phát sinh yêu cầu.</br>

<p> <b>6. Bảo hành, bảo trì</b></p>
6.1 Web2M chịu trách nhiệm đảm bảo điều kiện kỹ thuật để khách hàng có thể sử dụng được phần mềm 24h/ngày và 7 ngày/tuần ngoại trừ thời gian bảo trì, nâng cấp, khắc phục sự cố cho hệ thống. Thời gian ngưng hệ thống để bảo trì hoặc nâng cấp hoặc sao lưu sẽ được Web2M báo trước lịch thực hiện cho khách hàng. Lịch bảo trì hoặc nâng cấp hoặc sao lưu sẽ thực hiện theo định kỳ hàng ngày hoặc hàng tuần hoặc hàng tháng hoặc hàng năm và ưu tiên vào buổi đêm khi hệ thống ít sử dụng nhất.</br>

6.2 Web2M có trách nhiệm tiến hành khắc phục sự cố của hệ thống chậm nhất là 8h làm việc kể từ khi tiếp nhận được yêu cầu từ người sử dụng của khách hàng.</br>

6.3 Web2M có trách nhiệm cập nhật phiên bản mới nhất của phần mềm cho khách hàng sử dụng trong thời hạn thuê bao mà khách đã đăng ký và thanh toán cho Web2M.</br>

6.4 Khách hàng đồng ý chấp nhận tất cả sự vá lỗi, sửa lỗi, nâng cấp, bảo trì cần thiết để các tính năng của dịch vụ hoạt động chính xác và đảm bảo tính bảo mật của dịch vụ. Trừ trường hợp khẩn cấp, Web2M sẽ thông báo trước tới khách hàng lịch trình của các hoạt động sửa lỗi, nâng cấp này.</br>

6.5 Khi gần hết hạn sử dụng thuê bao phần mềm sPayment có trách nhiệm thông báo cho khách hàng trực tiếp trên chính phần mềm sPayment như sau:</br>

a) Trong vòng 30 ngày trước ngày hết hạn: Thông báo cho khách hàng biết thời hạn còn lại của thuê bao và hướng dẫn khách hàng thủ tục gia hạn thuê bao;</br>

b) Trong vòng 07 ngày sau ngày hết hạn: Thông báo cho khách hàng biết thuê bao đã quá hạn, cảnh báo cho khách hàng biết nếu quá hạn trên 07 ngày thì khách hàng không dùng được phần mềm nữa và hướng dẫn khách hàng thủ tục gia hạn thuê bao;</br>

c) Trong vòng từ 08 đến 30 ngày sau ngày hết hạn: Thông báo cho khách hàng biết thuê bao đã quá hạn, khách hàng cần phải gia hạn thì mới tiếp tục sử dụng được phần mềm;</br>

d) Quá hạn 30 ngày, Web2M sẽ thực hiện việc cắt thuê bao và xóa bỏ dữ liệu của khách hàng.</br>

6.6 Khách hàng có thể tự chủ động tra cứu thời hạn sử dụng của thuê bao đã sử dụng ngay trên phần mềm theo tài liệu hướng dẫn sử dụng của phần mềm.</br>

<p> <b>7. Dùng thử dịch vụ</b></p>
7.1 Khách hàng tự đăng ký tài khoản dùng thử phần mềm tại website https://api.web2m.com. Khi dùng thử phần mềm sPayment , khách hàng được:</br>

a) Sử dụng đầy đủ mọi chức năng của phần mềm;</br>

b) Thời hạn sử dụng là 7 ngày.</br>

7.2 Web2M sẽ thông báo cho khách hàng biết về thời hạn của tài khoản dùng thử dịch vụ phần mềm sPayment như sau:</br>

a) Trong vòng 7 ngày trước ngày hết hạn, Web2M sẽ thông báo cho khách hàng biết về thời hạn sử dụng còn lại và hướng dẫn khách hàng làm thủ tục đăng ký dùng chính thức;</br>

b) Khi hết hạn dùng thử, Web2M sẽ thông báo cho khách hàng biết thuê bao dùng thử đã hết hạn, khách hàng cần phải gia hạn thì mới tiếp tục sử dụng được phần mềm;</br>

c) Quá hạn dùng thử 30 ngày, Web2M sẽ thực hiện việc cắt thuê bao và xóa bỏ dữ liệu dùng thử của khách hàng.</br>

7.3 Khi khách hàng đăng ký sử dụng thử dịch vụ phần mềm sPayment, Web2M sẽ cung cấp miễn phí dịch vụ cho khách hàng cho tới khi:</br>

a) Hết thời hạn dùng thử;</br>

b) Khách hàng chính thức dùng dịch vụ trước khi hết hạn dùng thử.</br>

7.4 Web2M không chịu trách nhiệm về bất cứ quyền lợi nào của khách hàng liên quan tới quá trình dùng thử này.</br>

7.5 Khi hết thời hạn dùng thử, toàn bộ dữ liệu dùng thử của khách hàng sẽ bị xóa bỏ khỏi hệ thống, trừ trường hợp khách hàng đăng ký chuyển sang hình thức thuê bao chính thức và được Web2M chấp nhận.</br>

<p> <b>8. Ủy quyền truy cập và xử lý dữ liệu</b></p>
8.1 Bằng việc cung cấp các thông tin xác thực để Web2M liên kết tài khoản của khách hàng tại các ngân hàng, các tổ chức tín dụng vào hệ thống, khách hàng đã đồng ý ủy quyền cho Web2M được thay mặt khách hàng truy cập và xử lý các dữ liệu cần thiết cho mục đích cung cấp sản phẩm dịch vụ phần mềm.</br>

8.2 Các thông tin Web2M được ủy quyền truy cập bao gồm nhưng không giới hạn bởi các thông tin sau: Thông tin định danh (tên, số điện thoại, CMND/CCCD), thông tin tài khoản giao dịch (số tài khoản, tên tài khoản, đơn vị tiền tệ, số dư hiện tại), thông tin về biến động số dư.</br>

8.3 Mọi truy cập dữ liệu đều ở chế độ chỉ đọc. Web2M không có quyền và khả năng để sử dụng tiền hay thay đổi tình trạng, thông tin tài khoản của khách hàng.</br>

<p> <b>9. Bảo mật</b></p>
9.1 Web2M chịu trách nhiệm thực hiện và duy trì tất cả các biện pháp bảo vệ mang tính hành chính, vật lý và kỹ thuật để bảo vệ cho tính bảo mật và toàn vẹn đối với dữ liệu khách hàng. Web2M cam kết sẽ không:</br>

a) Sửa đổi dữ liệu khách hàng mà không có sự đồng ý của khách hàng hoặc không phải vì mục đích khắc phục lỗi hay sự cố;</br>

b) Không tiết lộ dữ liệu khách hàng trừ trường hợp được khách hàng cho phép;</br>

c) Không truy cập vào dữ liệu và/hoặc làm thay đổi dữ liệu của khách hàng trừ trường hợp khắc phục lỗi kỹ thuật hoặc theo yêu cầu của khách hàng khi sử dụng dịch vụ hỗ trợ.</br>

9.2 Web2M chịu trách nhiệm bảo mật mọi thông tin về dữ liệu của khách hàng và không được phép tiết lộ cho bất kỳ bên thứ ba nào khác. Web2M không chịu trách nhiệm về các thất thoát dữ liệu, bí mật thông tin của khách hàng do khách hàng vô tình hoặc cố ý gây ra.</br>

9.3 Khách hàng chịu trách nhiệm xác định và xác thực quyền của tất cả những người dùng truy nhập vào dữ liệu của khách hàng.</br>

9.4 Khách hàng chịu trách nhiệm đảm bảo bí mật thông tin tài khoản người dùng.</br>

9.5 Khách hàng chịu trách nhiệm đối với toàn bộ các hoạt động thực hiện bởi các tài khoản người dùng của khách hàng và có trách nhiệm ngay lập tức thông báo với Web2M về các truy cập trái phép.</br>

9.6 Web2M sẽ không chịu bất cứ trách nhiệm nào liên quan đến các tổn hại gây ra bởi người dùng của khách hàng, bao gồm các cá nhân không có quyền truy cập vào dịch vụ vẫn có thể lấy được quyền truy cập do lỗi máy tính/ phần mềm hoặc hệ thống mạng nội bộ của khách hàng.</br>

9.7 Trong phạm vi của thỏa thuận này, “Thông tin bí mật” bao gồm: Dữ liệu của khách hàng, công nghệ độc quyền của mỗi bên, quy trình nghiệp vụ và các thông tin kỹ thuật của sản phẩm, thiết kế, và toàn bộ quá trình trao đổi giữa hai bên liên quan đến dịch vụ. Bất kể những điều đã đề cập ở trên, “Thông tin bí mật” không bao gồm các thông tin mà:</br>

a) Được công chúng biết tới;</br>

b) Được biết tới trong ngành trước khi tiết lộ;</br>

c) Được công chúng biết tới không phải do lỗi của bên nhận thông tin;</br>

d) Dữ liệu tổng hợp trong đó không chứa bất kỳ thông tin cá nhân hoặc thông tin nào cụ thể của khách hàng.</br>

9.8 Khách hàng và Web2M cùng thỏa thuận:</br>

a) Thực hiện các biện pháp cần thiết để giữ bí mật cho tất cả các “Thông tin bí mật”;</br>

b) Không sao chép, cung cấp một phần hay toàn bộ thông tin bảo mật cho bất kỳ bên thứ ba khi chưa có sự chấp thuận của bên có quyền sở hữu đối với “Thông tin bí mật”;</br>

c) Không sử dụng “Thông tin bí mật” mà các bên đã cung cấp cho nhau phục vụ cho các mục đích khác ngoài mục đích thực hiện thỏa thuận này.</br>

<p> <b>10. Bản quyền phần mềm và dữ liệu</b></p>
10.1 Web2M là chủ sở hữu và có toàn quyền tác giả phần mềm sPayment.</br>

10.2 Khách hàng có quyền sử dụng phần mềm để tạo ra dữ liệu phục vụ công việc của đơn vị và có quyền tải về phần dữ liệu do chính đơn vị nhập vào hệ thống trong suốt thời gian được cấp thuê bao sử dụng phần mềm.</br>

10.3 Khách hàng đồng ý rằng sản phẩm/dịch vụ, bao gồm nhưng không giới hạn: giao diện người sử dụng, đoạn âm thanh, đoạn video, nội dung hướng dẫn sử dụng và phần mềm được sử dụng để thực hiện sản phẩm/dịch vụ thuộc sở hữu riêng của Web2M được bảo hộ bởi pháp luật về sở hữu trí tuệ và quyền tác giả. Khách hàng thỏa thuận sẽ không sử dụng các thông tin hoặc tài liệu thuộc sở hữu riêng đó theo bất cứ cách thức nào ngoại trừ cho mục đích sử dụng sản phẩm/dịch vụ theo Thỏa thuận này. Không có phần nào trong sản phẩm/dịch vụ có thể được sao chép lại dưới bất kỳ hình thức nào hoặc bằng bất cứ phương tiện nào, trừ khi được cho phép một cách rõ ràng theo các điều khoản này.</br>

10.4 Khách hàng đồng ý không sửa đổi, thuê, cho thuê, cho vay, bán, phân phối, hoặc tạo ra các sản phẩm phái sinh dựa trên sản phẩm/dịch vụ theo bất cứ phương cách nào, và không khai thác sản phẩm/dịch vụ theo bất cứ phương thức không được phép nào, bao gồm nhưng không giới hạn ở việc xâm phạm hoặc tạo gánh nặng lên dung lượng của hệ thống mạng.</br>

10.5 VIỆC SỬ DỤNG PHẦN MỀM HOẶC BẤT CỨ PHẦN NÀO CỦA SẢN PHẨM/DỊCH VỤ, TRỪ KHI VIỆC SỬ DỤNG SẢN PHẨM/DỊCH VỤ NHƯ ÐƯỢC CHO PHÉP THEO THỎA THUẬN NÀY, ĐỀU BỊ NGHIÊM CẤM VÀ XÂM PHẠM ÐẾN CÁC QUYỀN SỞ HỮU TRÍ TUỆ CỦA NGƯỜI KHÁC, VÀ KHÁCH HÀNG CÓ THỂ PHẢI CHỊU CÁC HÌNH PHẠT DÂN SỰ VÀ HÌNH SỰ, BAO GỒM CẢ VIỆC BỒI THƯỜNG THIỆT HẠI BẰNG TIỀN CÓ THỂ ĐƯỢC ÁP DỤNG ÐỐI VỚI VIỆC XÂM PHẠM QUYỀN TÁC GIẢ.</br>

10.6 Web2M có quyền nhưng không có nghĩa vụ nào trong việc thực hiện các hành động khắc phục nếu như có bất cứ nội dung nào mà khách hàng vi phạm các điều được liệt kê trong thỏa thuận này. Web2M không có bất kỳ trách nhiệm pháp lý nào đối với khách hàng trong các tình huống Web2M thực hiện hành động khắc phục. Khách hàng là người duy nhất chịu trách nhiệm về tính chính xác, chất lượng, tính toàn vẹn, hợp pháp, tin cậy và phù hợp đối với tất cả dữ liệu của mình.</br>

10.7 Web2M có thể đề nghị và khách hàng có thể lựa chọn đồng ý sử dụng các tính năng chưa được phát hành rộng rãi và chưa được kiểm duyệt hoàn toàn về mặt chất lượng theo quy trình của Web2M (các chức năng Beta). Mục đích của việc này là để khách hàng kiểm duyệt và cung cấp phản hồi cho Web2M. Khách hàng hoàn toàn chịu trách nhiệm về những rủi ro khi sử dụng các chức năng này. Web2M không đảm bảo về tính đúng đắn, đầy đủ của các chức năng Beta cũng như không chịu trách nhiệm cho các lỗi sai hoặc thiệt hại gây ra do việc sử dụng các chức năng Beta.</br>

<p> <b>11. Thông tin/ thông báo</b></p>
Trong quá trình sử dụng, khách hàng đồng ý nhận các thông tin/ thông báo do Web2M gửi với nội dung và phương thức như sau:</br>

11.1 Nội dung các thông báo bao gồm nhưng không giới hạn bởi các loại thông tin như sau:</br>

a) Thông tin về các tính năng mới của sản phẩm</br>

b) Thông tin về các phiên bản mới của sản phẩm</br>

c) Thông tin về các sản phẩm có liên quan</br>

d) Thông tin về nội dung các bài báo hoặc bản tin mà Web2M cho rằng có thể hữu ích cho khách hàng trong quá trình hoạt động.</br>

11.2 Phương thức gửi thông báo bao gồm nhưng không giới hạn bởi các hình thức sau:</br>

a) Thông báo trực tiếp trên màn hình sản phẩm</br>

b) Thông báo qua email</br>

c) Thông báo qua tin nhắn trên điện thoại di động</br>

d) Thông báo qua điện thoại</br>

e) Thông báo qua văn bản
</br>
f) Thông báo bằng cách gặp trao đổi trực tiếp</br>

g) Các hình thức thông báo khác
</br>
<p> <b>12. Thông tin phái sinh</b></p>
Web2M được quyền sử dụng thông tin phái sinh từ một phần hoặc toàn bộ thông tin do khách hàng tạo ra khi sử dụng sản phẩm của Web2M để phục vụ cho các mục đích nghiên cứu cải tiến sản phẩm, thị trường, thói quen tiêu dùng và các mục đích khác có thể mang lại lợi nhuận hoặc không mang lại lợi nhuận. Web2M cam kết các thông tin phái sinh này không chứa đựng bất kể thông tin cụ thể nào về liên hệ (tên, số điện thoại, …), các giao dịch cụ thể hoặc các bí mật sản xuất kinh doanh (đã mô tả trong mục 1)</br>

<p> <b>13. Giới hạn trách nhiệm pháp lý và thực hiện dịch vụ</b></p>
13.1 WEB2M KHÔNG CAM ÐOAN, TUYÊN BỐ, HOẶC BẢO ÐẢM RẰNG VIỆC KHÁCH HÀNG SỬ DỤNG SẢN PHẨM/DỊCH VỤ CỦA WEB2M SẼ KHÔNG BỊ GIÁN ÐOẠN HOẶC KHÔNG BỊ LỖI, HOẶC SẢN PHẨM/DỊCH VỤ SẼ ĐÁP ỨNG YÊU CẦU KHÁCH HÀNG HOẶC TẤT CẢ CÁC LỖI TRÊN PHẦN MỀM VÀ/HOẶC TÀI LIỆU SẼ ĐƯỢC SỬA HOẶC HỆ THỐNG TỔNG THỂ ĐẢM BẢO HOẠT ĐỘNG CỦA SẢN PHẨM/DỊCH VỤ PHẦN MỀM (BAO GỒM NHƯNG KHÔNG GIỚI HẠN: MẠNG INTERNET, CÁC MẠNG TRUYỀN DẪN KHÁC, MẠNG NỘI BỘ VÀ CÁC THIẾT BỊ CỦA KHÁCH HÀNG) SẼ KHÔNG CÓ VIRUS HOẶC KHÔNG CÓ THÀNH PHẦN GÂY HẠI.</br>

13.2 WEB2M KHÔNG ĐẢM BẢO DƯỚI BẤT KỲ HÌNH THỨC NÀO, DÙ RÕ RÀNG HAY NGẦM ĐỊNH VỀ CÁC ĐIỀU KIỆN NHƯ SỰ THỎA MÃN VỀ CHẤT LƯỢNG, PHÙ HỢP CHO NHU CẦU SỬ DỤNG ĐẶC THÙ HOẶC KHÔNG XÂM PHẠM CÁC QUYỀN CỦA BÊN THỨ BA. DỊCH VỤ CỦA WEB2M ĐƯỢC CUNG CẤP CHO KHÁCH HÀNG DƯỚI DẠNG “THEO HIỆN TRẠNG – AS IS” VÀ “CÓ SẴN – AS AVAILABLE” CHO KHÁCH HÀNG SỬ DỤNG. KHÁCH HÀNG SẼ CHỊU TOÀN BỘ TRÁCH NHIỆM TRONG VIỆC XÁC ĐỊNH XEM SẢN PHẨM/DỊCH VỤ HOẶC THÔNG TIN ĐƯỢC TẠO RA TỪ SẢN PHẨM/DỊCH VỤ LÀ ĐÚNG ĐẮN VÀ ĐÁP ỨNG ĐẦY ĐỦ CHO MỤC ĐÍCH SỬ DỤNG CỦA KHÁCH HÀNG.</br>

13.3 TRONG BẤT CỨ TRƯỜNG HỢP NÀO WEB2M ĐỀU KHÔNG CHỊU TRÁCH NHIỆM VỀ BẤT KỲ CÁC THIỆT HẠI NÀO TRỰC TIẾP, GIÁN TIẾP, NGẪU NHIÊN, ĐẶC BIỆT, HẬU QUẢ HOẶC MANG TÍNH CHẤT TRỪNG PHẠT, BAO GỒM NHƯNG KHÔNG GIỚI HẠN Ở CÁC THIỆT HẠI DO MẤT DOANH THU, LỢI NHUẬN, LỢI THẾ KINH DOANH, NGỪNG VIỆC, MẤT MÁT DỮ LIỆU DO HẬU QUẢ CỦA:</br>

a) VIỆC SỬ DỤNG HOẶC KHÔNG THỂ SỬ DỤNG SẢN PHẨM/DỊCH VỤ;</br>

b) BẤT KỲ CÁC THAY ĐỔI NÀO ĐƯỢC THỰC HIỆN ĐỐI VỚI SẢN PHẨM/DỊCH VỤ;</br>

c) TRUY CẬP KHÔNG ĐƯỢC PHÉP HOẶC BIẾN ĐỔI CÁC DỮ LIỆU;</br>

d) XÓA, SAI HỎNG, HOẶC KHÔNG LƯU TRỮ DỮ LIỆU CÓ TRÊN HOẶC THÔNG QUA SẢN PHẨM/DỊCH VỤ;</br>

e) CÁC TUYÊN BỐ HAY HÀNH VI CỦA BẤT KỲ BÊN THỨ BA NÀO ĐỐI VỚI SẢN PHẨM/DỊCH VỤ;</br>

f) BẤT KỲ VẤN ĐỀ NÀO KHÁC LIÊN QUAN ĐẾN SẢN PHẨM/DỊCH VỤ.</br>

13.4 TRONG TRƯỜNG HỢP SẢN PHẨM CỦA WEB2M CÓ SỬ DỤNG DỊCH VỤ CỦA BÊN THỨ BA NHƯ THÔNG TIN DỰ BÁO THỜI TIẾT, CHỨNG KHOÁN, TỶ GIÁ, …, WEB2M CAM KẾT KHÔNG TÍNH PHÍ NHƯNG KHÔNG ĐẢM BẢO VỀ TÍNH ĐÚNG SAI CỦA CÁC THÔNG TIN TRONG CÁC ỨNG DỤNG/ DỊCH VỤ HOẶC NẾU BÊN THỨ 3 CÓ CẬP NHẬT HỆ THỐNG MÀ DẪN ĐẾN MẤT SỰ ỔN ĐỊNH HOẶC NGƯNG TRỆ DỊCH VỤ. VÌ VẬY, NGƯỜI DÙNG PHẢI TỰ CÂN NHẮC KHI SỬ DỤNG CÁC DỊCH VỤ NÀY.</br>

13.5 Web2M được miễn trách nhiệm thực hiện nghĩa vụ được nêu trong thỏa thuận này đối với các trường hợp bất khả kháng ghi trong thỏa thuận này.</br>

<p> <b>14. Trách nhiệm xử lý sự cố an ninh</b></p>
14.1 Trong trường hợp khách hàng phát hiện ra các sự cố an ninh của phần mềm sPayment, khách hàng có trách nhiệm thông báo ngay với Web2M. Các sự cố an ninh phần mềm bao gồm nhưng không giới hạn bởi các trường hợp sau:</br>

a) Bị mất hoặc thay đổi dữ liệu trên phần mềm mà không biết nguyên nhân.</br>

b) Bị gián đoạn không sử dụng được sản phẩm.</br>

c) Nghi ngờ bị hacker tấn công.</br>

14.2 Khi xảy ra sự cố an ninh thông tin liên quan đến sản phẩm Web2M cung cấp cho khách hàng, Web2M sẽ có trách nhiệm tổ chức điều tra để xử lý sự cố và khôi phục hoạt động cho khách hàng. Trong quá trình điều tra và khắc phục sự cố, khách hàng phải có trách nhiệm tham gia nếu Web2M có thể yêu cầu.</br>

<p> <b>15. Bất khả kháng</b></p>
Trong trường hợp bất khả kháng hai bên không có nghĩa vụ phải thực hiện trách nhiệm của mình trong thỏa thuận này. Hai bên nhất trí coi các trường hợp sau là bất khả kháng:</br>

a) Thiên tai, địch họa gây cách trở hoặc phá hủy hoặc tắc nghẽn hoặc dừng kết nối đến trung tâm dữ liệu của Web2M.</br>

b) Sự cố mất điện trên diện rộng; Sự cố đứt cáp viễn thông gây tắc nghẽn hoặc ngừng kết nối viễn thông, Internet đến trung tâm dữ liệu của Web2M.</br>

c) Tin tặc (hacker), vi rút máy tính (virus) tấn công vào trung tâm dữ liệu của Web2M làm ngưng trệ, tắc nghẽn hoặc phá hủy phần mềm và dữ liệu.</br>

d) Các sự cố bất khả kháng khác theo quy định của pháp luật.</br>

<p> <b>16. Tạm ngừng và chấm dứt thỏa thuận</b></p>
16.1 Thỏa thuận này bắt đầu kể từ ngày khách hàng đồng ý và chấm dứt khi tất cả các thuê bao được cấp kèm theo thỏa thuận này hết hạn sử dụng. Đối với trường hợp khách hàng dùng thử sản phẩm/dịch vụ mà không chuyển sang hình thức thuê bao trước khi hết hạn dùng thử, thỏa thuận này sẽ được chấm dứt khi hết hạn dùng thử.</br>

16.2 Web2M có quyền tạm ngừng việc sử dụng của khách hàng đối với dịch vụ trong các trường hợp sau:</br>

a) Khách hàng không thực hiện việc đăng ký gia hạn và thanh toán các khoản chi phí sử dụng sản phẩm/dịch vụ sau khi quá hạn 30 ngày;</br>

b) Web2M cho rằng dịch vụ đang được khách hàng sử dụng để tham gia vào các cuộc tấn công từ chối dịch vụ, gửi thư rác, các hoạt động bất hợp pháp hoặc việc sử dụng sản phẩm/dịch vụ của khách hàng gây nguy hại tới Web2M và những người khác.</br>

16.3 Thỏa thuận được coi như chấm dứt trong các trường hợp sau:</br>

a) Web2M đơn phương chấm dứt thỏa thuận do khách hàng không thực hiện nghĩa vụ thanh toán cho Web2M theo thỏa thuận giữa hai bên;</br>

b) Web2M đơn phương chấm dứt thỏa thuận theo yêu cầu của tòa án và cơ quan có thẩm quyền của nhà nước;</br>

c) Khách hàng gửi thông báo yêu cầu chấm dứt thỏa thuận thuê bao cho Web2M bằng văn bản.</br>

16.4. Web2M không có nghĩa vụ hoàn trả bất kể chi phí nào mà khách hàng đã thanh toán trong trường hợp chấm dứt thỏa thuận vì những lý do đã nêu trên. Web2M chỉ chịu trách nhiệm bảo đảm duy trì dữ liệu của khách hàng trên hệ thống tối đa là 30 ngày kể từ ngày chấm dứt thỏa thuận.</br>

<p> <b>17. Căn cứ pháp lý</b></p>
17.1 Căn cứ Bộ Luật dân sự số 91/2015/QH13</br>

17.2 Căn cứ Luật thương mại nước CHXHCN Việt Nam năm 2005;</br>

17.3 Căn cứ Luật Công nghệ thông tin nước CHXHCN Việt Nam năm 2006</br>

17.4 Căn cứ vào nhu cầu của hai bên.</br>

<p> <b>18. Điều khoản chung</b></p>
18.1 Trong quá trình thực hiện thỏa thuận nếu có vấn đề gì nảy sinh thì hai bên sẽ cùng bàn bạc, thống nhất và tìm giải pháp khắc phục.</br>

18.2 Trong trường hợp nảy sinh tranh chấp mà hai bên không thể cùng nhau thương lượng giải quyết được thì hai bên cùng thống nhất mang ra Tòa án TP Hồ Chí Minh để giải quyết.</br>
      </div>
    </div>
        {!! NoCaptcha::renderJs() !!}
    </div>
</x-guest-layout>
<script src="https://www.google.com/recaptcha/api.js?render=6LeMmzIqAAAAAP1Ef9_chsYDykTj_2mpx1Y-K1YZ"></script>
<script>
    function openTermsPopup() {
    document.getElementById('termsPopup').style.display = 'flex';
  }

  function closeTermsPopup() {
    document.getElementById('termsPopup').style.display = 'none';
  }

</script>