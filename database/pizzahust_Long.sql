CREATE TABLE `admin` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50),
  `username` varchar(50),
  `password` varchar(30)
);

CREATE TABLE `user_acount` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(50),
    `address` varchar(100),
    `phonenumber` varchar(13),
    `email` varchar(25),
    `password` varchar(50)
);

CREATE TABLE `category` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `title` varchar(100)
);

CREATE TABLE `product` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `category_id` int,
    `name` varchar(350),
    `price` int,
    `status_product_id` int,
    `image` varchar(500),
    `description` varchar(255)
    
    -- Phần cũ này ko cần thiết
    --`size_id` int
);

CREATE TABLE `gallery` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `product_id` int,
    `img` varchar(500)
);

CREATE TABLE `order` (
    `id` int PRIMARY KEY AUTO_INCREMENT, 
    `fullname` varchar(50),
    `phonenumber` varchar(13),
    `address` varchar(100),
    `note` varchar(255),
    `order_time` datetime,
    `status_order_id` int,
    -- Cái này là tổng giá tiền đơn hàng à?
    `payment` int

    -- Phần cũ này ko cần thiết
    --`size_id` int,
    --`plinth_id` int
);

CREATE TABLE `order_detail` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `order_id` int,
    `product_id` int,
    `price` int,
    `quantity` int,

    -- Thêm phần này
    `topping_id` int,
    `size_id` int,

    -- Cái này theo t sản phẩm ko phải pizza sẽ để là NULL
    -- Lúc xử lý code php đến cái này có thể thêm 1 cái if($item[`plinth_id`] != NULL){ /*Xử lý*/ } 
    `plinth_id` int
);

CREATE TABLE `size`(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(20),

    -- Thêm phần này
    -- category ví dụ: Pizza có name S, M, L; Đồ uống có name: 250ml, 500ml;...
    -- Liệt kê size 1 loại đồ ăn thì chỉ cần chọn đúng category id của món đấy 
    `category_id` int
);

CREATE TABLE `plinth`(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(20),
    `price` int
);

-- Thêm bảng này
CREATE TABLE `topping`(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(20),
    `price` int,

    -- Thêm phần này
    -- category ví dụ: Pizza có name Tôm, Càri,...; Burger (nếu có) có các name khác;...
    -- Liệt kê topping 1 loại đồ ăn thì chỉ cần lọc đúng category id của món đấy
    `category_id` int;
);

CREATE TABLE `status_product` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `status` varchar(11)
);

CREATE TABLE `status_order` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `status` varchar(11)
);

ALTER TABLE `product` ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

ALTER TABLE `gallery` ADD FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

ALTER TABLE `order_detail` ADD FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

ALTER TABLE `order_detail` ADD FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

ALTER TABLE `product` ADD FOREIGN KEY (`status_product_id`) REFERENCES `status_product` (`id`);

ALTER TABLE `order` ADD FOREIGN KEY (`status_order_id`) REFERENCES `status_order` (`id`);

-- Sửa 2 khóa ngoài này
ALTER TABLE `orderDetail` ADD FOREIGN KEY (`plinth_id`) REFERENCES `plinth` (`id`);

ALTER TABLE `orderDetail` ADD FOREIGN KEY (`size_id`) REFERENCES `size` (`id`);

-- Thêm 2 khóa ngoài dưới này
ALTER TABLE `size` ADD FOREIGN KEY(`category_id`) REFERENCES `category` (`id`);

ALTER TABLE `topping` ADD FOREIGN KEY(`category_id`) REFERENCES `category` (`id`);

