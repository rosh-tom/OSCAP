-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2019 at 10:11 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tomas101`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

DROP TABLE IF EXISTS `tbl_history`;
CREATE TABLE IF NOT EXISTS `tbl_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `order_date`, `user_id`, `pro_id`, `pro_name`, `pro_price`, `qty`, `total`) VALUES
(18, 'December 5, 2019, 9:58 pm', 2, 60, 'Tsuriso', 200, 2, 400),
(17, 'December 5, 2019, 9:23 pm', 2, 58, 'Rib Eye Steak', 220, 1, 220),
(16, 'December 5, 2019, 9:22 pm', 2, 54, 'Celery Root', 100, 3, 300),
(15, 'December 5, 2019, 9:22 pm', 2, 55, 'Turmeric Root', 120, 3, 360),
(14, 'December 5, 2019, 9:11 pm', 2, 47, 'Eggplant', 30, 1, 30),
(19, 'December 5, 2019, 9:58 pm', 2, 46, 'Eggplant', 50, 1, 50),
(20, 'December 5, 2019, 9:58 pm', 2, 45, 'Carrots', 40, 1, 40),
(21, 'December 5, 2019, 10:00 pm', 2, 57, 'Dressed Chicken', 220, 1, 220),
(22, 'December 7, 2019, 6:07 am', 4, 47, 'Eggplant', 30, 1, 30),
(23, 'December 7, 2019, 6:07 am', 4, 53, 'Kamote', 60, 1, 60),
(24, 'December 7, 2019, 6:10 am', 5, 44, 'Napa Cabbage', 100, 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

DROP TABLE IF EXISTS `tbl_messages`;
CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `eEmail` varchar(50) NOT NULL,
  `myMessage` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `fname`, `eEmail`, `myMessage`) VALUES
(1, 'Cory Khong', 'cory@gmail.com', 'fdsfdsfdsfs'),
(2, 'tomas', 'sdfsfsd@gmail.com', 'kalibangon ako ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mycart`
--

DROP TABLE IF EXISTS `tbl_mycart`;
CREATE TABLE IF NOT EXISTS `tbl_mycart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_sdescript` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `quantity` float NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mycart`
--

INSERT INTO `tbl_mycart` (`id`, `user_id`, `image`, `pro_id`, `item_name`, `item_sdescript`, `price`, `quantity`, `total`) VALUES
(97, 1, 'egplnt_chines_z.jpg', 47, 'Eggplant', 'Chinese Eggplant', 30, 2, 60),
(98, 1, 'banana.jpg', 61, 'Bananas', 'Organic Bananas', 25, 1, 25),
(99, 1, 'Papaya.jpg', 37, 'Papaya', 'Tainung Papaya', 40, 1, 40);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `short_description` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `price` float NOT NULL,
  `category` varchar(50) NOT NULL,
  `status` varchar(2) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `name`, `short_description`, `description`, `price`, `category`, `status`, `image`) VALUES
(31, 'Avocados', 'Hash Avocados, Ready-to-Eat', 'These gorgeous Hass avocados are shipped to you ready to eat! Dont delay in enjoying the buttery texture and rich, slightly sweet flavor. We love to plump up burritos, sandwiches and salads with these \"butter pears,\" but they also make a satisfying addition to health smoothies to start your day off right.\r\n\r\n\r\nPlease note: Avocados are ready when the flesh yields to gentle pressure. To promote ripening, store avocados in a paper bag at room temperature. To slow ripening, store in the fridge.', 120, 'Fruits', '1', 'avocado.jpg'),
(32, 'Oranges', 'Navel Oranges', 'Extra-big, beautiful, seedless, very low in acid and filled with mild, sweet flesh. These beauties are supremely simple to peel and section. Bursting with freshly picked juiciness, this is the perfect orange to serve to kids. We also like to toss sections into fruit salad.', 100, 'Fruits', '1', 'orange.jpg'),
(33, 'Mangos', 'Ataulfo Mango Pack', 'Ataulfo mangoes are small, delicately shaped mangoes with golden yellow skins and velvety flesh. Sometimes called champagne mangoes or honey mangoes, this fruit has very little fibrous texture and a skinny pit. Chop into salsas and salads or use in poultry and fish dishes. To soften firm mangoes, leave them at room temperature for several days until the skin wrinkles slightly and the fruit yields to gentle pressure. Ripe mangoes can be refrigerated for up to a week.', 60, 'Fruits', '1', 'mangos.jpg'),
(34, 'Rambutan', 'Fresh and sweet Rambutan', 'Rambutan are still pretty rare stateside. Getting their name for the Malaysian word for \"hairy,\" these close relatives to lychee fruit are covered with short, soft tendrils. Eat as you would a lychee, by slipping off the papery rind and snacking on the sweet, iridescent flesh inside.', 50, 'Fruits', '1', 'rambutan.jpg'),
(35, 'Pineapple', 'Golden Pineapple', 'The Golden is a pineapple thats been to charm school. The tartness has been reined in just a bit. It is sweeter and mellower than other pineapples. The Golden is a good mixer in yogurt or fruit salad and a surefire hit with kids.', 70, 'Fruits', '1', 'pineapple.jpg'),
(36, 'Guavas', 'Green Guavas', 'If you could pack a strawberry, a pineapple, and a banana in a lemon-sized package, youd have a guava. Its texture is papaya-like, and the aroma it exudes is strong and fragrant. The skin is a bonus, soft and tart, with a surprising clove flavor.', 20, 'Fruits', '1', 'Guavas.jpg'),
(37, 'Papaya', 'Tainung Papaya', 'With a melon-like flavor, fragrant aroma and beautiful salmon red interior, red papayas may resemble a strawberry papaya, but they are much sweeter. Red papaya adds color and taste to any salad or can be served chilled topped with a dollop of vanilla ice cream for a tasty tropical sundae!', 40, 'Fruits', '1', 'Papaya.jpg'),
(38, 'Star Fruit', 'Balingbing', 'The balingbing has a licorice-tinged citrus flavor and the texture of a ripe plum. Its juicy and mild and easy to eat. Eat it whole, no need to peel. The name \"star fruit\" comes from the five-pointed shape. Slice it crosswise to make a prettier garnish than the usual orange wedge or parsley sprig.', 10, 'Fruits', '1', 'Star Fruit.jpg'),
(39, 'White Dragon Fruit', 'Fresh White Dragon Fruit', 'A cactus fruit popular in Central and South America and Southeast Asia. With such a striking, unusual appearance, you would expect the dragon fruit to have an over-the-top taste. In truth, dragon fruit have a mild tropical sweetness with notes of kiwi and watermelon. Dragon fruit flesh ranges in color from white to deep magenta (depending on where its from), but the texture is uniformly juicy, slightly crunchy and speckled with tiny edible seeds â€” much like a kiwi. Remove the dragon fruits peel, slice it up and add it to fruit salads or enjoy it on its own.\r\n ', 130, 'Fruits', '1', 'White Dragon Fruit.jpg'),
(40, 'Chinese Long Beans', 'Fresh Chinese Long Beans', 'Chinese long beans should be picked young while it is at its most crisp, sweet and tender. Young beans develop within sixty days of cultivation, and the long pods grow in pairs from the stem. Known for their extraordinary length, beans can grow up to thirty inches in length, but for best flavor and texture it should be harvested when between twelve and eighteen inches. The bean pods have a spindly, cylindrical form with a smooth, grooved, and firm texture and a green-colored shell. The bean pods flesh contains succulent, pale, lime green peas with eyes similar in shape to black eyed peas. If beans can fully mature, they can be shelled, and the seeds used as other shelled beans and peas. The flavor of Chinese long beans is grassy and slightly sweet with a more intense bean flavor than traditional green beans. Of all the Chinese long bean varieties, the green is known to be the sweetest and most tender. (from the vendor)', 30, 'Vegetables', '1', 'Chinese Long Beans.jpg'),
(41, 'Washed Snow Peas', 'Fresh Washed Snow Peas', 'Sweet and crisp, with a nice little snap of sharpness and great crunch. Snow peas are most familiar in Asian dishes. \"Snow pea\" is almost a misnomer, since most of what youre enjoying is not the flat little \"pea\" inside but the chewy-crisp pod. Dont cook them through or they will turn flabby. Just heat them gently (sautÃ© or steam) for less than a minute.', 30, 'Vegetables', '1', 'Washed Snow Peas.jpg'),
(42, 'Broccoli', 'Organic Broccoli', 'With its cabbage-like flavor and satisfying crunch, we think of broccoli as one of the ultimate vegetables. Its nutritious, low in calories, available year-round and hearty. Steam it, stir-fry it, sautÃ© it, bake it in casseroles, purÃ©e it in soups or dunk it raw in dressing or hummus.', 40, 'Vegetables', '1', 'Organic Broccoli.jpg'),
(43, 'Cabbage', 'Organic Green Cabbage', 'The all-time favorite cabbage. It sets the standard. Firmly packed, with smooth, uniformly green skin. The crisp and fleshy leaves are loaded with tart tanginess and a surprisingly pleasing aroma. Green cabbage is loaded with vitamins and antioxidants. Universally popular, because there is so much you can do with it. Tightly wrapped and refrigerated, it stays fresh for a week or longer.', 100, 'Vegetables', '1', 'Cabbage.jpg'),
(44, 'Napa Cabbage', 'Chinese Cabbage', 'All the texture and healthful richness of green cabbage with a more delicate aroma. This brightly flavored cabbage has crispy, wafer-thin leaves. Use in any recipe that calls for standard green cabbage. The name comes from \"nappa,\" a Japanese word for \"greens.\" Napa is a great source of vitamin A, folic acid, and potassium.', 100, 'Vegetables', '1', 'Napa Cabbage.jpg'),
(45, 'Carrots', 'Organic Carrots', 'Intensely sweet. Theyre super crunchy raw. Cut them into disks and flash steam. Five minutes does the trick. Trim the greens so they dont suck the moisture out of the eating part.', 40, 'Vegetables', '1', 'Carrots.jpg'),
(46, 'Eggplant', 'Aubergine Eggplant', 'Lush and creamy, with a mild, earthy flavor, eggplant has the most velvety texture in the vegetable family. Its high in healthy fiber. We love it sliced, brushed with olive oil and salt, and grilled or roasted. We also love it breaded, fried, and smothered in fried onions. Come to think of it, we just plain love it.', 50, 'Vegetables', '1', 'Eggplant.jpg'),
(47, 'Eggplant', 'Chinese Eggplant', 'The flesh of this eggplant is so sweet it can be eaten raw. Delicate and tender, Chinese eggplants (they were first raised in China) must be treated lovingly, or at least tenderly. They are more fragile than other varieties and should be eaten within a few days. Delicious sliced lengthwise into stir fry.', 30, 'Vegetables', '1', 'egplnt_chines_z.jpg'),
(48, 'Ginger Root', 'Organic Ginger Root', 'Ginger is a multitalented flavoring. It is sweet and floral on your tongue, tickles your sinuses, and warms the back of your throat. Ginger brings out all the flavor in sweet and savory foods. It is used a lot in Asian and Indian cuisines because it works so well in curries, dipping sauces, marinades, and stir-fries.', 50, 'Root Crops', '1', 'Ginger Root.jpg'),
(49, 'Red Radish', 'Organic Red Radish', 'These fresh roots will be the natural flavor and local character of the sun and soil. Peppery, hot and zippy, this is the radish most often seen on crudites plates and salads. We love them raw, with just a sprinkle of salt.', 50, 'Root Crops', '1', 'Red Radish.jpg'),
(50, 'Parsnips', 'Fresh Parsnips', 'Parsnips look and cook like white carrots, but their texture is a little softer and more buttery. They have an earthy flavor that goes with roasts and game. A beef stew without parsnips is almost as unthinkable as a beef stew without beef. Chicken soup and turkey stock pick up round sweet flavor from parsnips.', 60, 'Root Crops', '1', 'Parsnips.jpg'),
(52, 'Yucca (Cassava)', 'Fresh Cassava', 'A starchy root vegetable native to South America, yuca cassava is a staple of tropical diets in much the same manner the potato is in temperate ones. Inside its bark brown skin is a dense, creamy white flesh that can be fried, mashed, baked, boiled, or sautÃ©ed. Slightly sweet with a mild flavor, it takes seasonings well and can pretty much be used anywhere youd use potatoes. To prepare, simply peel off the outer skin, chop into pieces, and cook until soft.', 50, 'Root Crops', '1', 'Yucca.jpg'),
(53, 'Kamote', 'Fresh Kamote', 'A kamotehas a turnips dense texture and a cabbages pleasant sharpness. Big and substantial, yellow and thick skinned, it looks like a cross between a turnip and a squash. Like turnips, rutabagas can stand in for potatoes mash them with butter or cube them in stews. They help round out the flavor of chicken soup or any stock.\r\n', 60, 'Root Crops', '1', 'Rutabaga.jpg'),
(54, 'Celery Root', 'Celeriac', 'Celery root has a bracing, snappy taste that is earthy and fresh. Peel away the tough brown skin to uncover the white flesh. Some cookbooks call it celeriac, which is a 100 pesos word but doesnt change the flavor a bit. We add chunks of this homey root to winter veggie soups. You can also boil and mash them with potatoes.', 100, 'Root Crops', '1', 'Celery Root.jpg'),
(55, 'Turmeric Root', 'Fresh Turmeric Root', 'Orange colored with a spicy flavor, turmeric is a yellow ginger that is a staple in Southeast Asian and Indian Cuisines. Peel and grate or finely chop and add to rice, curries, fresh juices or steep for hot tea.', 120, 'Root Crops', '1', 'Turmeric Root.jpg'),
(56, 'Daikon', 'Organic Daikon, Bunch', 'At first bite daikon tastes tame and a bit sweet, with the crisp juiciness of an apple. Wait a second its subtle heat sneaks up on you. Daikon is close enough to red radishes to substitute whenever you like. Its shape and size make it easier to prepare. You can cook it, pickle it, or eat it raw. For a simple condiment for poultry or seafood, mix grated daikon and carrots with rice wine vinegar.', 100, 'Root Crops', '1', 'Daikon.jpg'),
(57, 'Dressed Chicken', 'Organic Whole Chicken', 'Our Organic Whole Chickens are smaller and more tender than the classic roaster, so they dont require as much cooking time. Though these birds were bred for broiling or frying, but dont stop there theyre mighty good for roasting and grilling, too. (Gizzards not included.)', 220, 'Others', '1', 'mea_chicken_p.jpg'),
(58, 'Rib Eye Steak', 'Rib Eye Steak, Value Pack', 'Super velvety texture and intense flavor. This boneless steak is so flavorful and juicy all it needs is a little salt and pepper and a quick broil. Its a melt in your mouth cut that real steak lovers relish. This is the steak that made the reputation  where serious food lovers from Tomas gwapo. ', 220, 'Others', '1', 'steak.jpg'),
(59, 'Sausage', 'Fresh Breakfast Pork Sausage', 'Our breakfast sausage links are 2 oz. instead of the full 3 oz., making them the perfect size to add a savory kick to your breakfast.', 220, 'Others', '1', 'sausage.jpg'),
(60, 'Tsuriso', 'Special Tsuriso', 'Is a meat product usually made from ground meat, often pork, beef, or poultry, along with salt, spices and other flavourings. Other ingredients such as grains or breadcrumbs may be included as fillers or extenders. Some sausages include other ingredients for flavour.', 200, 'Others', '1', 'mea_pid_3335182_z.jpg'),
(61, 'Bananas', 'Organic Bananas', 'The banana is an anytime, year round snack. We like them fully yellow with just a dusting of brown freckles. But super ripe, meltingly sweet bananas and firmer greenish ones have their fans too. Slice them onto cereal or pancakes, fold into fruit salad, blend into smoothies, and bake into muffins. Heat brings out bananas creamy sweetness. Try baking, broiling, or sautÃ©ing them with butter and sugar for a luscious dessert.', 25, 'Fruits', '1', 'banana.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_uname` varchar(50) NOT NULL,
  `user_upass` varchar(50) NOT NULL,
  `user_recovery` varchar(50) NOT NULL,
  `user_status` varchar(2) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_address`, `user_uname`, `user_upass`, `user_recovery`, `user_status`, `user_type`) VALUES
(1, 'tom', 'cadenas', 'tom.cadenas@gmail.com', 'doyos', 'tom', '123', 'joharah', '1', 'admin'),
(4, 'Shelly', 'Espana', 'basta@gmail.com', 'Butuan City', 'shell', '123', 'basta', '1', 'user '),
(5, 'Jerome', 'Sulimanan', 'sulimanan@gmail.com', 'Yekok', 'rom', '123', 'basta', '1', 'user ');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
