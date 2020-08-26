CREATE DATABASE `moneytransfer`;

CREATE TABLE `moneytransfer`.`customers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `document` VARCHAR(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `value_account` DECIMAL(15,2) NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`email`),
  UNIQUE KEY (`document`)
);