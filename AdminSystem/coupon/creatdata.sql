CREATE TABLE `coupon`(
    `id_cp` int AUTO_INCREMENT PRIMARY KEY,
    `name_cp` nvarchar(20),  
	`code_cp` varchar(10) ,                   -- Mã code
    `type_cp` varchar(20),                    -- Kiểu áp dụng ("PERCENTAGE” hoặc “CURRENCY")  
    `value_cp` int,                            -- giá trị
    `description` nvarchar(250),
    `active_date` datetime,                   -- Ngày bắt đầu
    `expire_date` datetime,                   -- Ngày kết thức
    `min_order_value` int DEFAULT 0,          -- Tiền tối thiểu = 0 là k có
    `max__order_amount` int DEFAULT 0,        -- Giảm tối đa
   -- `condition_id` int                        -- (ĐK áp dụng 0:toàn bộ phân khi có chia cấp khách hàng?) hoặc( có thể là gh số lượng? -1 k GH ? )

);

CREATE TABLE `cp_user`(
    `cp_id` int,
    `user_id` int , 
    `used` int                                -- dã dùng hay hưa
);

ALTER TABLE `cp_user` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `cp_user` ADD FOREIGN KEY (`cp_id`) REFERENCES `coupon` (`id_cp`);
