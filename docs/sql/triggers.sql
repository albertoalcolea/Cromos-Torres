

-- --------------------------------------------------------

--
-- Triggers para simular ON DELETE CASCADE con motor MYISAM
--

DELIMITER ;;

--
-- Editorial
--

CREATE TRIGGER `del_editorial` AFTER DELETE ON `editorial` FOR EACH ROW BEGIN
	DELETE FROM collection WHERE editorial_id = old.editorial_id;
END;;


--
-- Collection
--

CREATE TRIGGER `del_collection` AFTER DELETE ON `collection` FOR EACH ROW BEGIN
	DELETE FROM category WHERE collection_id = old.collection_id;
	DELETE FROM product WHERE collection_id = old.collection_id;
END;;


--
-- Category
--

CREATE TRIGGER `del_category` AFTER DELETE ON `category` FOR EACH ROW BEGIN
	DELETE FROM product WHERE category_id = old.category_id;
END;;


--
-- Product
--

CREATE TRIGGER `del_product` AFTER DELETE ON `product` FOR EACH ROW BEGIN
	DELETE FROM albumImage WHERE album_id = old.product_id;
	DELETE FROM orderProducts WHERE product_id = old.product_id;
END;;


--
-- Order
--

CREATE TRIGGER `del_order` AFTER DELETE ON `order` FOR EACH ROW BEGIN
	DELETE FROM orderProducts WHERE order_id = old.order_id;
END;;

DELIMITER ;


