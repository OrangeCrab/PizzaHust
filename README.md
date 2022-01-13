# PizzaHust
* Giới thiệu:
* Website cho cửa hàng PizzaHust - Nhóm 6 lớp Nhập môn công nghệ phần mềm IT3180 128699
* <img width="1440" alt="Ảnh chụp Màn hình 2022-01-13 lúc 11 25 58" src="https://user-images.githubusercontent.com/68985886/149265804-9f5211fe-9472-4926-84eb-8d8a61535468.png">
* Trang web gồm: 
    - Trang Homepage - nơi khách hàng có thể truy cập để xem sản phẩm, voucher và đặt hàng
    - Trang giỏ hàng - nơi hiển thị các sản phẩm mà khách hàng đã lựa chọn
    - Trang tài khoản của khách hàng sau khi đăng nhập - lưu trữ lịch sử mua hàng của khách hàng đó 
      và các voucher đã nhận (voucher chỉ áp dụng đối với khách hàng đăng nhập)
    - Trang đăng nhập, đăng ký cho khách hàng, quên mật khẩu (yêu cầu lấy lại mật khẩu sẽ được gửi về gmail đã đăng ký)
    - Trang đăng nhập cho cửa hàng 
    - Trong giao diện dành cho cửa hàng gồm có:
        - Mục Tổng quan - nơi tổng quan các thông tin của trang web (đơn hàng mới, thống kê doanh thu)
        - Mục Món ăn - nơi quản lý thông tin các sản phẩm của trang web (cửa hàng có thể thêm, sửa, xóa thông tin các món ăn)
        - Mục Đơn hàng - nơi thống kê toàn bộ đơn hàng (chủ cửa hàng có thể bấm vào mã đơn để xác nhận đơn)
        - Mục Khuyến mãi - nơi quản lý các voucher, có thể thêm, sửa, xóa
* Website được xây dựng bằng Html, Css, Js, PHP, chạy server trên XAMPP, quản lý cơ sở dữ liệu bằng mySQL
* Cài đặt:
    - Cài đặt XAMPP ứng với hệ điều hành của máy tính
    - Tải folder của Project tại branch này về và lưu vào thư mục htdocs của XAMPP
    - Khởi động XAMPP và Start All trong phần Manage Server
    - Sau khi đèn báo chuyển xanh, các mục chuyển trạng thái Running, bắt đầu tiến hành tạo CSDL
    - Truy cập http://localhost/phpmyadmin/ , vào mục Database, tạo một CSDL với tên quan_ly_cua_hang_pizza_hust, 
      tại CSDL mới tạp, chạy phần lệnh SQL trong file quan_ly_cua_hang_pizza_hust.sql (nằm trong folder Project) tại mục SQL     
    - Sau khi thông báo thực thi thành công, truy cập http://localhost/PizzaHust/ShowForGuest/homepage/homepage.php để vào trang Homepage của website,
      tại Homepage có thể truy cập vào trang đăng nhập thông qua thanh lựa chọn top-bar, hoặc có thể truy cập đường link 
      http://localhost/PizzaHust/ShowForGuest/login/login_user.php (đăng nhập của khách hàng)
      http://localhost/PizzaHust/AdminSystem/login_form.php (đăng nhập của cửa hàng)
    - Một số chú ý: 
        + Hình ảnh sản phẩm nên sử dụng có tỉ lệ rộng x cao là 3x2
        + Hình ảnh quảng cáo tại slide của Homepage nên sử dụng có tỉ lệ rộng x cao là 8x3
          hiện tại chỉ cố định 5 ảnh lần lượt là head0, head1, head2, head3, head4 trong masterial/image/bgrHomepage, 
          _chỉ có thể thay thế các ảnh đó_
        + **_(độ phân giải cao sẽ giúp hiển thị tốt hơn)_**

* Nhóm sinh viên thực hiện:
    - Vũ Hồng Sơn - 20194161: Trang Homepage + Trang tài khoản của khách hàng sau khi đăng nhập
    - Nguyễn Trung Kiên - 20194078: Trang giỏ hàng
    - Lê Mạnh Cường - 20194000: Trang đăng nhập cho khách hàng, chủ cửa hàng
    - Phạm Văn Điệp - 20194161: Mục Món ăn
    - Đinh Ngọc Huân - 20194065: Cơ sở dữ liệu + Mục Món ăn
    - Trần Minh Hoàng - 20194061: Mục Tổng quan + Mục Khuyến mãi
    - Trương Việt Long - 20194105: Mục Đơn hàng
    - Lê Đức Anh - 20193978: Mục Đơn hàng 
    
    


