CREATE TABLE `USERS` (
  `username` VARCHAR(50) PRIMARY KEY,
  `f_name` VARCHAR(50),
  `l_name` VARCHAR(50),
  `gender` VARCHAR(6),
  `email` VARCHAR(50),
  `password` VARCHAR(50)
);

CREATE TABLE `CART` (
  `cart_id` INT PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(50),
  `cart_time` TIME,
  `cart_date` DATE
);

CREATE TABLE `FOOD_CART` (
  `f_c_id` INT PRIMARY KEY AUTO_INCREMENT,
  `food_id` INT,
  `cart_id` INT
);

CREATE TABLE `FOOD` (
  `food_id` INT PRIMARY KEY,
  `food_name` FLOAT,
  `description` FLOAT,
  `carbohydrate` FLOAT,
  `cholesterol` FLOAT,
  `fiber` FLOAT,
  `manganese` FLOAT,
  `protein` FLOAT,
  `sugar_total` FLOAT,
  `water` FLOAT,
  `fat_id` INT,
  `minerals_id` INT,
  `vitamins_id` INT,
  `monosaturated_fat` FLOAT,
  `polysaturated_fat` FLOAT,
  `saturated_fat` FLOAT,
  `total_lipid` FLOAT,
  `calcium` FLOAT,
  `copper` FLOAT,
  `iron` FLOAT,
  `magnesium` FLOAT,
  `phosphorus` FLOAT,
  `potassium` FLOAT,
  `sodium` FLOAT,
  `zinc` FLOAT,
  `a_iu` FLOAT,
  `a_rae` FLOAT,
  `b12` FLOAT,
  `b6` FLOAT,
  `c` FLOAT,
  `e` FLOAT,
  `k` FLOAT
);

ALTER TABLE `CART` ADD FOREIGN KEY (`username`) REFERENCES `USERS` (`username`);

ALTER TABLE `FOOD_CART` ADD FOREIGN KEY (`food_id`) REFERENCES `FOOD` (`food_id`);

ALTER TABLE `FOOD_CART` ADD FOREIGN KEY (`cart_id`) REFERENCES `CART` (`cart_id`);