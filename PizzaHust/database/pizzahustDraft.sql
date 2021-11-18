CREATE TABLE `admin` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50),
  `username` varchar(50),
  `password` varchar(30)
);

CREATE TABLE `user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50),
  `address` varchar(100),
  `phoneNumber` varchar(13)
);

CREATE TABLE `category` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(100),
  `status` varchar(11)
);

CREATE TABLE `product` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `categoryID` int,
  `productName` varchar(350),
  `productPrice` int,
  `statusID` int,
  `productImg` varchar(500),
  `description` varchar(255),
  `sizeID` int
);

CREATE TABLE `gallery` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `productID` int,
  `img` varchar(500)
);

CREATE TABLE `order` (
  `id` int PRIMARY KEY AUTO_INCREMENT, 
  `userID` int,
  `fullname` varchar(50),
  `userPhoneNumber` varchar(13),
  `userAddress` varchar(100),
  `userNote` varchar(255),
  `orderTime` datetime,
  `status` int,
  `payment` int,
  `size_id` int,
  `plinth_id` int
);

CREATE TABLE `orderDetail` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `orderID` int,
  `productID` int,
  `price` int,
  `quatity` int
);

CREATE TABLE `size`(
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(20)
);

CREATE TABLE `status` (
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
  `infomation` varchar(250),
  `discount` int
);

CREATE TABLE `pizzabase`(
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(20),
  `price` int
);

ALTER TABLE `product` ADD FOREIGN KEY (`categoryID`) REFERENCES `category` (`id`);

ALTER TABLE `gallery` ADD FOREIGN KEY (`productID`) REFERENCES `product` (`id`);

ALTER TABLE `orderDetail` ADD FOREIGN KEY (`productID`) REFERENCES `product` (`id`);

ALTER TABLE `orderDetail` ADD FOREIGN KEY (`orderID`) REFERENCES `order` (`id`);

ALTER TABLE `order` ADD FOREIGN KEY (`userID`) REFERENCES `user` (`id`);

ALTER TABLE `product` ADD FOREIGN KEY (`statusID`) REFERENCES `status` (`id`);

ALTER TABLE `product` ADD FOREIGN KEY (`sizeID`) REFERENCES `size` (`id`);




-- ../masterial/image/thuc_don/5_loai_thit.jpg