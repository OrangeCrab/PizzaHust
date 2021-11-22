-- add bảng coupon và cp_user vào database của hoàng (update 22/11)
CREATE TABLE `coupon`(
 `id_cp` int AUTO_INCREMENT PRIMARY KEY,
 `name_cp` varchar(20),  
 `code_cp` varchar(10) ,                 
 `type_cp` varchar(20),                  
 `value_cp` int,                           
 `description` varchar(250),
 `active_date` datetime,                  
 `expire_date` datetime,                  
 `min_order_value` int DEFAULT 0,         
 `max__order_amount` int DEFAULT 0       
);

CREATE TABLE `cp_user`(
  `cp_id` int,
  `user_id` int , 
  `used` int                               
);

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
  `description` varchar(255),
  `size_id` int
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
  `payment` int,
  `size_id` int,
  `plinth_id` int
);

CREATE TABLE `order_detail` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `order_id` int,
  `product_id` int,
  `price` int,
  `quatity` int
);

CREATE TABLE `size`(
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(20)
);

CREATE TABLE `status_product` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `status` varchar(11)
);

CREATE TABLE `status_order` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `status` varchar(11)
);

CREATE TABLE `plinth`(
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(20),
  `price` int
);

CREATE TABLE `voucher`(
  `code` varchar(20) PRIMARY KEY,
  `picture` varchar(100),
  `information` varchar(250),
  `discount` int
)

ALTER TABLE `product` ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

ALTER TABLE `gallery` ADD FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

ALTER TABLE `order_detail` ADD FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

ALTER TABLE `order_detail` ADD FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

ALTER TABLE `product` ADD FOREIGN KEY (`status_product_id`) REFERENCES `status_product` (`id`);

ALTER TABLE `order` ADD FOREIGN KEY (`status_order_id`) REFERENCES `status_order` (`id`);

ALTER TABLE `order` ADD FOREIGN KEY (`plinth_id`) REFERENCES `plinth` (`id`);

ALTER TABLE `product` ADD FOREIGN KEY (`size_id`) REFERENCES `size` (`id`);

ALTER TABLE `cp_user` ADD FOREIGN KEY (`user_id`) REFERENCES `user_acount` (`id`);

ALTER TABLE `cp_user` ADD FOREIGN KEY (`cp_id`) REFERENCES `coupon` (`id_cp`);

INSERT INTO `category` (`id`, `title`) VALUES (NULL, 'Pizza'), (NULL, 'Gà BBQ');
INSERT INTO `size` (`id`, `name`) VALUES (NULL, 'S'), (NULL, 'M');
INSERT INTO `status_product` (`id`, `status`) VALUES (NULL, 'Còn hàng'), (NULL, 'Hết hàng');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `status_product_id`, `image`, `description`, `size_id`) VALUES (NULL, '1', 'Pizza Thập Cẩm', '99000', '1', '../masterial/image/thuc_don/thap_cam.jpg', 'ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon', '1'), (NULL, '1', 'Pizzaminsea', '100000', '1', '../masterial/image/thuc_don/pizzaminsea.jpg', 'ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon', '1');
INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `status_product_id`, `image`, `description`, `size_id`) VALUES (NULL, '1', 'Pizza Rau Củ', '120000', '1', '../masterial/image/thuc_don/rau_cu.jpg', 'Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon ', '2'), (NULL, '1', 'Pizza 4 Vị', '150000', '1', '../masterial/image/thuc_don/4_vi.jpg', 'Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon ', '2'), 
            (NULL, '1', 'Pizza Thịt Ngập Mõm', '110000', NULL, '../masterial/image/thuc_don/5_loai_thit.jpg', 'Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon ', '1'), (NULL, '2', 'Đùi Gà Con', '60000', '1', '../masterial/image/thuc_don/thap_cam.jpg', 'Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon Ngon ngon ', '2');
