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
  `description` varchar(255)
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
  `payment` int
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
  `size` varchar(10)
)

CREATE TABLE `status` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `status` varchar(11)
);

ALTER TABLE `product` ADD FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

ALTER TABLE `gallery` ADD FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

ALTER TABLE `orderDetail` ADD FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

ALTER TABLE `orderDetail` ADD FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`);

ALTER TABLE `order` ADD FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

ALTER TABLE `product` ADD FOREIGN KEY (`statusID`) REFERENCES `status` (`statusID`);