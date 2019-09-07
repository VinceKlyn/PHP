create database storedb;

use storedb;

CREATE TABLE `tbl_products`(
  `id` int(11) NOT NULL auto_increment,
  `productname` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `stocks` int NOT NULL,
  `category` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  PRIMARY KEY(`id`)
);