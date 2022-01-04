-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th1 04, 2022 lúc 04:03 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dcm2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'Combo'),
(2, 'Pizza'),
(3, 'Khai vị'),
(4, 'Tráng miệng'),
(5, 'Đồ uống'),
(6, 'Món chay'),
(7, 'Dành cho trẻ'),
(8, 'Topping');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `id_cp` int(11) NOT NULL,
  `name_cp` varchar(20) DEFAULT NULL,
  `code_cp` varchar(10) DEFAULT NULL,
  `type_cp` varchar(20) DEFAULT NULL,
  `value_cp` int(11) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `active_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `min_order_value` int(11) DEFAULT 0,
  `max__order_amount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `coupon`
--

INSERT INTO `coupon` (`id_cp`, `name_cp`, `code_cp`, `type_cp`, `value_cp`, `description`, `active_date`, `expire_date`, `min_order_value`, `max__order_amount`) VALUES
(1, 'noel', 'NOELVUIVE', '1', 1, 'Nhập mã NOELVUIVE để giảm 25000đ hoá đơn thanh toán <br>\r\nGiá trị đơn hàng tối thiểu 200k<br>\r\nHiệu lực: hôm nay đến ngày mai <br>\r\n*Chỉ áp dụng với khách hàng đăng nhập', '2021-12-13 15:28:31', '2021-12-13 15:28:31', 200000, 25000),
(2, 'tetduonglich', 'TETDONGDAY', '0', 5, 'Nhập mã TETDONGDAY để giảm 5% tổng giá trị đơn hàng (tối đa 45k)<br>\r\nHiệu lực: hôm nay đến ngày mai <br>\r\n*Chỉ áp dụng với khách hàng đăng nhập', '2021-12-13 13:01:19', '2023-12-13 13:01:19', 500000, 40000),
(3, 'binhan', 'BINHAN', '0', 7, 'Nhập mã BINHAN để giảm 7% tổng giá trị đơn hàng (tối đa 35k)<br>\r\nGiá trị đơn hàng tối thiểu 600k<br>\r\nHiệu lực: hôm nay đến ngày mai <br>\r\n*Chỉ áp dụng với khách hàng đăng nhập', '2021-12-13 13:13:51', '2022-12-13 13:13:51', 600000, 35000),
(4, 'iloveyou', 'ILOVEYOU', '1', 1, 'Nhập mã ILOVEYOU để giảm 15000đ hoá đơn thanh toán <br>\r\nGiá trị đơn hàng tối thiểu 150k<br>\r\nHiệu lực: hôm nay đến ngày mai <br>\r\n*Chỉ áp dụng với khách hàng đăng nhập', '2021-12-13 13:14:34', '2022-12-13 13:14:34', 150000, 15000),
(5, 'hanhphuc', 'hanhphuc', '0', 9, 'Nhập mã TETDONGDAY để giảm 9% tổng giá trị đơn hàng (tối đa 12k)<br>\r\nGiá trị đơn hàng tối thiểu 100k<br>\r\nHiệu lực: hôm nay đến ngày mai <br>\r\n*Chỉ áp dụng với khách hàng đăng nhập', '2021-12-13 13:15:16', '2021-12-13 13:15:16', 100000, 12000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cp_user`
--

CREATE TABLE `cp_user` (
  `cp_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `used` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cp_user`
--

INSERT INTO `cp_user` (`cp_id`, `user_id`, `used`) VALUES
(1, 3, 0),
(2, 3, 0),
(3, 3, 0),
(1, 2, 0),
(2, 2, 0),
(3, 2, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `img` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `phonenumber` varchar(13) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `order_time` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `coupon` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `fullname`, `phonenumber`, `address`, `note`, `order_time`, `status`, `payment`, `coupon`, `user_id`) VALUES
(86, 'Nguyễn Trung Kiên', '0989988888', '136 Nguyễn An Ninh Quận Nam Từ Liêmy', 'erphobnfkldvjosdkcx', '2021-12-25 16:09:30', 'Chờ xác nhận', 842000, NULL, NULL),
(87, 'Nguyễn Văn B', '0123456789', '20 Giải Phóng Quận Thanh Xuân', 'cho ít muối thôi', '2021-12-25 16:10:59', 'Chờ xác nhận', 802000, 40000, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quatity` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `plinth` varchar(30) DEFAULT NULL,
  `topping` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_name`, `price`, `quatity`, `size`, `plinth`, `topping`) VALUES
(121, 86, 'Pizza Thập Cẩm', 110000, 2, 'S', 'Mềm xốp', 'Phô mai viền '),
(122, 86, 'Pizzaminsea', 165000, 2, 'S', 'Mềm xốp', 'Phô mai phủ '),
(123, 86, 'Pizza Tôm Sốt Bơ Tỏi', 105000, 2, 'S', 'Mềm xốp', 'Phô mai phủ '),
(124, 86, 'Mỳ đặc biệt', 60000, 1, '', '', 'Không có'),
(125, 87, 'Pizza Thập Cẩm', 110000, 2, 'S', 'Mềm xốp', 'Phô mai viền '),
(126, 87, 'Pizzaminsea', 165000, 2, 'S', 'Mềm xốp', 'Phô mai phủ '),
(127, 87, 'Pizza Tôm Sốt Bơ Tỏi', 105000, 2, 'S', 'Mềm xốp', 'Phô mai phủ '),
(128, 87, 'Mỳ đặc biệt', 60000, 1, '', '', 'Không có');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `plinth`
--

CREATE TABLE `plinth` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `plinth`
--

INSERT INTO `plinth` (`id`, `name`, `price`) VALUES
(1, 'Giòn', 0),
(2, 'Mềm xốp', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(350) DEFAULT NULL,
  `status_product_id` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price_free_size` int(11) DEFAULT NULL,
  `price_s` int(11) DEFAULT NULL,
  `price_m` int(11) DEFAULT NULL,
  `price_l` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `status_product_id`, `image`, `description`, `price_free_size`, `price_s`, `price_m`, `price_l`) VALUES
(1, 2, 'Pizza Thập Cẩm', 1, 'thap_cam.jpg', 'Phủ Giăm Bông Và Thơm Ngọt Dịu Trên Nền Sốt Cà Chua Truyền Thống ', 0, 100000, 120000, 150000),
(2, 2, 'Pizzaminsea', 1, 'pizzaminsea.jpg', 'Pizza Gà Nướng Nấm Trong Cuộc Phiêu Lưu Vị Giác Với Thịt Gà, Nấm, Thơm, Cà Rốt Và Rau Mầm Phủ Xốt Tiêu Đen Thơm Nồng', 0, 150000, 170000, 200000),
(3, 2, 'Pizza Rau Củ', 1, 'rau_cu.jpg', 'Thanh Nhẹ Với Ô Liu Đen Tuyệt Hảo, Cà Chua Bi Tươi Ngon, Nấm, Thơm, Bắp, Hành Tây Và Phô Mai Mozzarella Cho Bạn Bữa Tiệc Rau Củ Tròn Vị ', 0, 90000, 100000, 110000),
(4, 2, 'Pizza 4 Vị', 1, '4_vi.jpg', 'Thịt Gà, Hành Tây, Nấm Và Bắp Ngọt Trên Nền Sốt Pesto, Thêm Chút Tiêu Đen Thơm Nồng Quện Trong Phô Mai Mozzarella, Cuộn Trong Lớp Bánh Pizza Đặc Trưng Của Pizza Hut. ', 0, 110000, 120000, 130000),
(5, 2, 'Pizza Tôm Sốt Bơ Tỏi', 1, '5_loai_thit.jpg', 'Với Tôm, HàNh Tây Và Ớt Chuông Phủ Trên Nền Xốt Bơ Tỏi ', 0, 90000, 100000, 110000),
(6, 3, 'Đùi Gà Con', 1, 'ga_BBQ.jpg', 'Đùi Gà Nướng Thơm Lừng Ngon Tuyệt Với Hương Vị BBQ ', 50000, 90000, 100000, 110000),
(7, 2, 'Pizza Bò Tôm', 1, 'bo_tom.jpg', 'Tôm, Mực, Thanh Cua, Hành Tây, Thơm Phủ Xốt Tiêu Đen Thơm Nóng Và Phô Mai Mozzarella ', 0, 90000, 100000, 110000),
(8, 8, 'Double sốt', 1, '', 'Với lượng sốt BBQ gấp đôi nâng cao hương vị món ăn', 9000, 0, 0, 0),
(9, 8, 'Phô mai viền', 1, '', 'Phô Mai Viền Siêu Thơm Nhập Khẩu Trực Tiếp Tại Mỹ', 10000, 8000, 0, 0),
(10, 8, 'Phô mai phủ', 1, '', 'Phô Mai Phủ Từ Nhà Máy Phô Mai Nổi Tiếng Ở Anh Quốc', 15000, 15000, 0, 0),
(11, 4, 'Mỳ đặc biệt', 1, 'mi_y.jpg', 'Mì Ý Xốt Cà Chua Với Tôm, Mực, Hành Tây Và Ớt Chuông Xanh', 60000, 0, 0, 0),
(12, 3, 'Gà BBQ', 1, 'bbq.jpg', 'Cánh Gà Chiên Giòn Phủ Xốt Hàn Quốc', 60000, 0, 0, 0),
(13, 5, 'Cocacola', 1, 'coca1.jpg', 'CocaCola lon 360ml', 15000, 0, 0, 0),
(14, 1, 'Combo 1', 1, 'combo1.png', '4 Pizza Thập Cẩm, 4 Cocacola, 1 gà BBQ', 300000, 0, 0, 30000),
(15, 1, 'Combo 2', 1, 'combo2.jfif', '1 Pizza Chay, 2 Pepsi, 1 gà BBQ', 180000, 0, 0, 180000),
(16, 1, 'Combo 3', 1, 'combo3.jpg', '2 Pizza + 1 Pepsi', 210000, 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status_product`
--

CREATE TABLE `status_product` (
  `id` int(11) NOT NULL,
  `status` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `status_product`
--

INSERT INTO `status_product` (`id`, `status`) VALUES
(1, 'Còn hàng'),
(2, 'Hết hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phonenumber` varchar(13) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user_account`
--

INSERT INTO `user_account` (`id`, `username`, `address`, `phonenumber`, `email`, `password`) VALUES
(2, 'trungkien', '136 Nguyễn An Ninh Hoàng mai', '0989989998', 'trungkien07yd@gmail.com', '123456'),
(3, 'trungkien1', '124 Gia Viễn,Ninh bình', '0989983025', 'trungkien1@gmail.com', '123456');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id_cp`);

--
-- Chỉ mục cho bảng `cp_user`
--
ALTER TABLE `cp_user`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cp_id` (`cp_id`);

--
-- Chỉ mục cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `plinth`
--
ALTER TABLE `plinth`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `status_product_id` (`status_product_id`);

--
-- Chỉ mục cho bảng `status_product`
--
ALTER TABLE `status_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id_cp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT cho bảng `plinth`
--
ALTER TABLE `plinth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `status_product`
--
ALTER TABLE `status_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cp_user`
--
ALTER TABLE `cp_user`
  ADD CONSTRAINT `cp_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`id`),
  ADD CONSTRAINT `cp_user_ibfk_2` FOREIGN KEY (`cp_id`) REFERENCES `coupon` (`id_cp`);

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`status_product_id`) REFERENCES `status_product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
