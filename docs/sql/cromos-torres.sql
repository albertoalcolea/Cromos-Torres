-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-07-2012 a las 19:49:51
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cromos-torres`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumImage`
--

CREATE TABLE IF NOT EXISTS `albumImage` (
  `albumImage_id` int(11) NOT NULL AUTO_INCREMENT,
  `albumImage_imageUrl` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `album_id` int(11) NOT NULL,
  PRIMARY KEY (`albumImage_id`),
  KEY `album_id` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `albumImage`
--

INSERT INTO `albumImage` (`albumImage_id`, `albumImage_imageUrl`, `album_id`) VALUES
(1, 'http://localhost/cromos-torres/public/images/albums/1.jpg', 3),
(2, 'http://localhost/cromos-torres/public/images/albums/2.jpg', 3),
(3, 'http://localhost/cromos-torres/public/images/albums/3.jpg', 3),
(4, 'http://localhost/cromos-torres/public/images/albums/4.jpg', 3),
(5, 'http://localhost/cromos-torres/public/images/albums/5.jpg', 3),
(6, 'http://localhost/cromos-torres/public/images/albums/1.jpg', 3),
(7, 'http://localhost/cromos-torres/public/images/albums/2.jpg', 3),
(8, 'http://localhost/cromos-torres/public/images/albums/3.jpg', 3),
(9, 'http://localhost/cromos-torres/public/images/albums/4.jpg', 3),
(10, 'http://localhost/cromos-torres/public/images/albums/5.jpg', 3),
(11, 'http://localhost/cromos-torres/public/images/albums/1.jpg', 3),
(12, 'http://localhost/cromos-torres/public/images/albums/2.jpg', 3),
(13, 'http://localhost/cromos-torres/public/images/albums/3.jpg', 3),
(14, 'http://localhost/cromos-torres/public/images/albums/4.jpg', 3),
(15, 'http://localhost/cromos-torres/public/images/albums/5.jpg', 3),
(16, 'http://localhost/cromos-torres/public/images/albums/1.jpg', 3),
(17, 'http://localhost/cromos-torres/public/images/albums/2.jpg', 3),
(18, 'http://localhost/cromos-torres/public/images/albums/3.jpg', 3),
(19, 'http://localhost/cromos-torres/public/images/albums/4.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `category_order` int(2) NOT NULL,
  `collection_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `collection_id` (`collection_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_order`, `collection_id`) VALUES
(1, 'Real Madrid', 1, 1),
(2, 'F.C. Barcelona', 2, 1),
(5, 'test 2', 6, 2),
(11, 'Mundial 2010', 1, 23),
(17, 'test2', 1, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collection`
--

CREATE TABLE IF NOT EXISTS `collection` (
  `collection_id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `collection_year` int(4) NOT NULL,
  `collection_imageUrl` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `editorial_id` int(11) NOT NULL,
  PRIMARY KEY (`collection_id`),
  KEY `editorial_id` (`editorial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `collection`
--

INSERT INTO `collection` (`collection_id`, `collection_name`, `collection_year`, `collection_imageUrl`, `editorial_id`) VALUES
(1, 'UEFA 2010', 2010, 'images/collections/UEFA_2010.jpg', 1),
(2, 'UEFA 2011', 2011, 'images/collections/UEFA_2011.jpg', 1),
(23, 'Mundial 2010', 2010, 'images/collection/mundial_2010.jpg', 5),
(24, 'test', 1965, 'test.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE IF NOT EXISTS `editorial` (
  `editorial_id` int(11) NOT NULL AUTO_INCREMENT,
  `editorial_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `editorial_priority` int(11) NOT NULL,
  `editorial_imageUrl` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`editorial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`editorial_id`, `editorial_name`, `editorial_priority`, `editorial_imageUrl`) VALUES
(1, 'Panini', 1, 'images/panini.jpg'),
(2, 'mundicromo', 1, 'images/mundicromo.jpg'),
(5, 'ed. exter', 5, 'images/ed.exter.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_firstName` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `order_lastName` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `order_address` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `order_city` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `order_postcode` int(5) NOT NULL,
  `order_email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `order_paymentMethod` int(1) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `order`
--

INSERT INTO `order` (`order_id`, `order_date`, `order_firstName`, `order_lastName`, `order_address`, `order_city`, `order_postcode`, `order_email`, `order_paymentMethod`) VALUES
(1, '2012-07-21 21:32:08', 'Julián', 'Pérez Jiménez', 'C\\ Alcalá, 22, 5º dcha', 'Madrid', 20548, 'julian@hotmail.com', 0),
(2, '2012-07-20 21:32:08', 'María', 'Pérez Gómez', 'C\\ Alcalá, 22, 5º dcha', 'Madrid', 20548, 'maria@hotmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orderProducts`
--

CREATE TABLE IF NOT EXISTS `orderProducts` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number_products` int(5) NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `orderProducts`
--

INSERT INTO `orderProducts` (`order_id`, `product_id`, `number_products`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 1),
(2, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` int(1) NOT NULL,
  `sticker_number` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sticker_imageUrl` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `collection_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `product_details` text COLLATE utf8_spanish_ci,
  `product_price` double NOT NULL,
  `product_stock` int(5) NOT NULL,
  `product_dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `collection_id` (`collection_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`product_id`, `product_type`, `sticker_number`, `sticker_imageUrl`, `category_id`, `collection_id`, `product_name`, `product_details`, `product_price`, `product_stock`, `product_dateAdded`) VALUES
(1, 1, 'R11', 'http://localhost/cromos-torres/public/images/sticker/1.jpg', 1, NULL, 'Cristiano Ronaldo', '', 11.25, 1, '2012-07-21 17:08:56'),
(2, 1, 'faaa', 'http://localhost/cromos-torres/public/fdsfdsaa', 5, NULL, 'ffdsfdsfaaa', 'fdsfdsfaaa', 1.25, 2, '2012-07-21 17:08:56'),
(3, 2, NULL, NULL, NULL, 1, 'Álbum UEFA 2011', '', 44.25, 1, '2012-07-21 17:09:39'),
(5, 1, 'M12', 'http://localhost/cromos-torres/public/images/sticker/raul.jpg', 2, NULL, 'Raúl', '', 7.98, 1, '2012-07-21 23:45:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albumImage`
--
ALTER TABLE `albumImage`
  ADD CONSTRAINT `albumImage_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`collection_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`editorial_id`) REFERENCES `editorial` (`editorial_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orderProducts`
--
ALTER TABLE `orderProducts`
  ADD CONSTRAINT `orderProducts_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderProducts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`collection_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
