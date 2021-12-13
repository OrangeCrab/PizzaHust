

-- update topping + status_order (13/12)
ALTER TABLE `order_detail` ADD COLUMN `topping` varchar(30);

ALTER TABLE `order` DROP COLUMN `status`;

ALTER TABLE `order` ADD COLUMN `status` varchar(30);

-- update user_id (10/12)
ALTER TABLE `order` ADD COLUMN `user_id` int;

ALTER TABLE `order` ADD FOREIGN KEY (`user_id`) REFERENCES `user_account`(id);

--




CREATE TABLE `coupon`(
 id_cp int AUTO_INCREMENT PRIMARY KEY,
 name_cp varchar(20),  
 code_cp varchar(10) ,                 
 type_cp varchar(20),                  
 value_cp int,                           
 description varchar(250),
 active_date datetime,                  
 expire_date datetime,                  
 min_order_value int DEFAULT 0,         
 max__order_amount int DEFAULT 0       
);

CREATE TABLE `cp_user`(
  cp_id int,
  user_id int , 
  used int                               
);

CREATE TABLE admin (
  id int PRIMARY KEY AUTO_INCREMENT,
  name varchar(50),
  username varchar(50),
  password varchar(30)
);

CREATE TABLE user_account (
  id int PRIMARY KEY AUTO_INCREMENT,
  username varchar(50),
  address varchar(100),
  phonenumber varchar(13),
  email varchar(25),
  password varchar(50)
);

CREATE TABLE category (
  id int PRIMARY KEY AUTO_INCREMENT,
  title varchar(100)
);

CREATE TABLE product (
  id int PRIMARY KEY AUTO_INCREMENT,
  category_id int,
  name varchar(350),
  price int,
  status_product_id int,
  image varchar(500),
  description varchar(255),
  price_free_size int,
  price_s int,
  price_m int,
  price_l int
);

create table `menu`(
  id int PRIMARY KEY AUTO_INCREMENT,
  name varchar(50)
);

CREATE TABLE `menu_detail`(
  product_id int,
  menu_id int
);

CREATE TABLE gallery (
  id int PRIMARY KEY AUTO_INCREMENT,
  product_id int,
  img varchar(500)
);

CREATE TABLE `order` (
  id int PRIMARY KEY AUTO_INCREMENT, 
  fullname varchar(50),
  phonenumber varchar(13),
  address varchar(100),
  note varchar(255),
  order_time datetime,
  status int,
  payment int
);

CREATE TABLE order_detail (
  id int PRIMARY KEY AUTO_INCREMENT,
  order_id int,
  product_id int,
  price int,
  quatity int,
  size varchar(10),
  plinth varchar(30)
);


CREATE TABLE status_product (
  id int PRIMARY KEY AUTO_INCREMENT,
  status varchar(11)
);


CREATE TABLE `plinth`(
  id int PRIMARY KEY AUTO_INCREMENT,
  name varchar(20),
  price int
);

CREATE TABLE `voucher`(
  code varchar(20) PRIMARY KEY,
  picture varchar(100),
  information varchar(250),
  discount int
);

create table `meal`(
  id int AUTO_INCREMENT PRIMARY KEY,
  name varchar(20)
);

create table meal_detail(
  meal_id int,
  product_id int
);

ALTER TABLE product ADD FOREIGN KEY (category_id) REFERENCES category (id);

ALTER TABLE gallery ADD FOREIGN KEY (product_id) REFERENCES product (id);

ALTER TABLE order_detail ADD FOREIGN KEY (product_id) REFERENCES product (id);

ALTER TABLE order_detail ADD FOREIGN KEY (order_id) REFERENCES `order` (id);

ALTER TABLE product ADD FOREIGN KEY (status_product_id) REFERENCES status_product (id);


ALTER TABLE cp_user ADD FOREIGN KEY (user_id) REFERENCES user_account (id);

ALTER TABLE cp_user ADD FOREIGN KEY (cp_id) REFERENCES coupon (id_cp);

ALTER TABLE menu_detail ADD FOREIGN KEY (product_id) REFERENCES product (id);

ALTER TABLE menu_detail ADD FOREIGN KEY (menu_id) REFERENCES menu (id);

ALTER TABLE meal_detail ADD FOREIGN KEY (product_id) REFERENCES product (id);

ALTER TABLE meal_detail ADD FOREIGN KEY (meal_id) REFERENCES meal (id);

INSERT INTO `status_product` (`id`, `status`) VALUES (NULL, `Còn hàng`), (NULL, `Hết hàng`);
INSERT INTO `product` (`id`, `category_id`, `name`, `status_product_id`, `image`, `description`, `price_free_size`, `price_s`, `price_m`, `price_l`) 
     VALUES (NULL, '1', 'Pizza Thập Cẩm', '1', 'thap_cam.jpg', 'ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ', NULL, '90000', '100000', '110000'),
            (NULL, '1', 'Pizzaminsea', '1', 'pizzaminsea.jpg', 'ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ', NULL, '90000', '100000', '110000'),
            (NULL, '1', 'Pizza Rau Củ', '1', 'rau_cu.jpg', 'ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ', NULL, '90000', '100000', '110000'),
            (NULL, '1', 'Pizza 4 Vị', '1', '4_vi.jpg', 'ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ', NULL, '90000', '100000', '110000'),
            (NULL, '1', 'Pizza Thịt Ngập Mõm', '1', '5_loai_thit.jpg', 'ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ', NULL, '90000', '100000', '110000'),
            (NULL, '1', 'Đùi Gà Con', '2', 'ga_BBQ.jpg', 'ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ', NULL, '90000', '100000', '110000'),
            (NULL, '1', 'Pizza Bò Tôm', '1', 'bo_tom.jpg', 'ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ngon ', NULL, '90000', '100000', '110000'),
            (NULL, '8', 'Double sốt', '1', NULL, NULL, NULL, '10000', NULL, NULL), 
            (NULL, '8', 'Phô mai viền', '1', NULL, NULL, NULL, '8000', NULL, NULL), 
            (NULL, '8', 'Phô mai phủ', '1', NULL, NULL, NULL, '15000', NULL, NULL);
INSERT INTO `category` (`id`, `title`)  VALUES (1, `Pizza`),(2, `Gà BBQ`), (3, `Đồ ăn kèm`), (4, `Đồ uống`), (5, `Mỳ ý`), (6, `Combo`), (7,`Menu`),(8, `Topping`)
INSERT INTO meal VALUES (1, 'Bữa sáng'), (2, 'Bữa trưa'), (3,'Bữa tối'); // Bắt buộc
INSERT INTO menu VALUES (1,'Khai vị'), (2, 'Món chính'), (3, 'Tráng miệng'), (4, 'Món chay'), (5, 'Dành cho trẻ em'); // Bắt buộc
