-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 01:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diablosignproto1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(255) NOT NULL,
  `name` char(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` bigint(10) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `name`, `email`, `password`, `phone_number`, `reg_date`) VALUES
(1, 'Chris Bhaila', 'chrisbhaila5@gmail.com', 'chrisbha05', 9844379971, '2024-05-24 19:25:34'),
(3, 'Sugam Manandhar', 'sugammanandhar8@gmail.com', 'sugammdhr08', 9880153655, '2024-05-24 19:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `completed_orders`
--

CREATE TABLE `completed_orders` (
  `id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_price` int(255) NOT NULL,
  `order_quantity` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` bigint(255) NOT NULL,
  `completed_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_orders`
--

INSERT INTO `completed_orders` (`id`, `order_id`, `user_id`, `user_name`, `order_name`, `order_price`, `order_quantity`, `email`, `phone_number`, `completed_date`) VALUES
(1, 1, 1, 'Chris Bhaila', 'Club Sandwich', 220, 1, 'chrisbhaila5@gmail.com', 9844379971, '2024-05-24 19:53:34'),
(2, 2, 1, 'Chris Bhaila', 'Egg Sandwich', 160, 1, 'chrisbhaila5@gmail.com', 9844379971, '2024-05-24 19:53:36'),
(3, 3, 1, 'Chris Bhaila', 'Agliolio', 425, 1, 'chrisbhaila5@gmail.com', 9844379971, '2024-05-24 19:53:39'),
(4, 4, 1, 'Chris Bhaila', 'Fresh Farm House', 600, 2, 'chrisbhaila5@gmail.com', 9844379971, '2024-05-24 19:53:43'),
(5, 5, 1, 'Chris Bhaila', 'Salami Pizza', 400, 1, 'chrisbhaila5@gmail.com', 9844379971, '2024-05-24 19:53:45'),
(6, 6, 1, 'Chris Bhaila', 'Mystical Momo Fusion', 555, 1, 'chrisbhaila5@gmail.com', 9844379971, '2024-05-24 19:53:47'),
(7, 7, 1, 'Chris Bhaila', 'Crunchy Chicken Burger', 200, 2, 'chrisbhaila5@gmail.com', 9844379971, '2024-05-27 13:48:00'),
(8, 8, 1, 'Chris Bhaila', 'Penne Arrabbiata', 280, 2, 'chrisbhaila5@gmail.com', 9844379971, '2024-05-30 06:39:59'),
(9, 9, 1, 'Chris Bhaila', 'Penne Rocco', 350, 1, 'chrisbhaila5@gmail.com', 9844379971, '2024-05-30 06:40:00'),
(10, 10, 1, 'Chris Bhaila', 'Fresh Farm House', 600, 1, 'chrisbhaila5@gmail.com', 9844379971, '2024-05-30 06:40:02'),
(11, 11, 1, 'Chris Bhaila', 'Asian Pear Salad', 265, 1, 'chrisbhaila5@gmail.com', 9844379971, '2024-07-12 11:49:06'),
(12, 16, 1, 'Chris Bhaila', 'Chicken Burger', 180, 1, 'chrisbhaila5@gmail.com', 9844379971, '2024-07-12 11:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `placed_order`
--

CREATE TABLE `placed_order` (
  `order_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` char(255) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_price` int(100) NOT NULL,
  `order_quantity` int(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` bigint(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `placed_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `placed_order`
--

INSERT INTO `placed_order` (`order_id`, `user_id`, `name`, `order_name`, `order_price`, `order_quantity`, `email`, `phone_number`, `address`, `status`, `placed_date`) VALUES
(17, 1, 'Chris Bhaila', 'Crunchy Chicken Burger', 200, 2, 'chrisbhaila5@gmail.com', 9844379971, 'Suryabinayak', '', '2024-07-12 11:48:47'),
(18, 1, 'Chris Bhaila', 'Green Papaya Salad', 200, 1, 'chrisbhaila5@gmail.com', 9844379971, 'Suryabinayak', '', '2024-07-12 11:48:47'),
(19, 1, 'Chris Bhaila', 'Buff Burger', 170, 2, 'chrisbhaila5@gmail.com', 9844379971, 'Suryabinayak', '', '2024-07-12 11:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Price` int(255) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `admin_id`, `Name`, `Category`, `Price`, `Description`, `Image`) VALUES
(1, 1, 'Green Papaya Salad', '', 200, 'A taste of exotic Asia. Green papaya strings. Mixed with pork, shrimp, peanut and vegetable', '1.jpg'),
(2, 1, 'Lotus Root Salad', '', 300, 'Lotus root mixed with beef, shrimp, herbs.', '2.jpg'),
(3, 1, 'Cassava Noodle Mix', '', 300, 'Noodle made of cassava powder. Mixed with pork, shrimp, peanut and vegetable', '3.jpg'),
(4, 1, 'Stewed Pork In Claypot', '', 600, 'Delicacy of authentic cooking way', '4.jpg'),
(5, 1, 'Grilled Fingerlings', '', 280, 'Grilled potatoes with a Western flair served with sauce of choice.', '5.jpg'),
(6, 1, 'Asian Pear Salad', '', 265, 'Crisp pears and pecans with tender fries and maple syrup with cheese.', '6.jpg'),
(7, 1, 'Roasted Acorn Squash', '', 200, 'Spicy-sweet, soft wedges potatoes which makes a no-fuss holiday special.', '7.jpg'),
(8, 1, 'Smothered Chicken', '', 399, 'Grilled chicken breast topped with mushrooms, onions and cheese.', '8.jpg'),
(9, 1, 'Spicy Himalayan Diablo', '', 450, 'Chef Devkota\'s signature dish', '9.jpg'),
(10, 1, 'Mystical Momo Fusion', '', 555, 'Chef Devkota\'s signature dish', '10.jpg'),
(11, 1, 'Classic Hawaiian Ham/Chicken', '', 600, 'Tomato sauce, mozzarella, pineapple ham or chicken, your choice', '11.jpg'),
(12, 1, 'Carbonaro bacon', '', 485, 'Creamy carbonara sauce, mozzarella and choices of your bacon or smoke chicken', '12.jpg'),
(13, 1, 'Salami Pizza', '', 400, 'Tomato sauce, mozzarella, salami', '13.jpg'),
(14, 1, 'Agliolio', '', 425, 'Light tomato sauce, mozzarella green capers, black olive, chilly flakes, parsley chunks, olive oil', '14.jpg'),
(15, 1, 'Fresh Farm House', '', 600, 'Tomato sauce, mozarella, sliced potato, purple cabbage, bell pepper, onion', '15.jpg'),
(16, 1, 'Four Cheese Pizza', '', 550, 'Mozzarella, kanchan, feta, cheddar', '16.jpg'),
(17, 1, 'Smoke Chicken', '', 400, 'Tomato sauce, mozzarella, smoke chicken', '17.jpg'),
(18, 1, 'Spaghetti Bolognese', '', 300, 'Spaghetti (long strings of pasta) with an Italian ragù (meat sauce) made with minced beef, bacon and tomatoes, served with Parmesan cheese', '18.jpg'),
(19, 1, 'Penne Rocco', '', 350, 'Penne pasta toasted in crispy bacon, cherry tomato, white onion and mint leaves served with garlic bread', '19.jpg'),
(20, 1, 'Penne Arrabbiata', '', 280, 'Creamy white sauce, cheese and chicken fillet served with garlic bread', '20.jpg'),
(21, 1, 'Chicken Sandwich', '', 200, '', '21.jpg'),
(22, 1, 'Egg Sandwich', '', 160, '', '22.jpg'),
(23, 1, 'Club Sandwich', '', 220, '', '23.jpg'),
(24, 1, 'Grilled Cheese Sandwich', '', 200, '', '24.jpg'),
(25, 1, 'Ham Sandwich', '', 190, '', '25.JPG'),
(26, 1, 'Buff Burger', '', 170, '', '26.jpg'),
(27, 1, 'Chicken Burger', '', 180, '', '27.jpg'),
(28, 1, 'Crunchy Chicken Burger', '', 200, '', '29.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `msg_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `Name` char(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Number` bigint(10) NOT NULL,
  `MessageType` varchar(191) NOT NULL,
  `Message` varchar(1024) NOT NULL,
  `msg_reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`msg_id`, `user_id`, `Name`, `Email`, `Number`, `MessageType`, `Message`, `msg_reg_date`) VALUES
(1, 1, 'Chris Bhaila', 'chrisbhaila5@gmail.com', 9844379971, 'Review', 'Very Good', '2024-05-30 06:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `order_name` char(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `order_name`, `quantity`, `amount`, `customer_id`, `image`) VALUES
(35, 'Cassava Noodle Mix', 1, 300, 2, '3.jpg'),
(36, 'Lotus Root Salad', 1, 300, 2, '2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` char(20) NOT NULL,
  `phone_number` bigint(10) NOT NULL,
  `Address` char(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`ID`, `Email`, `Password`, `Name`, `phone_number`, `Address`, `reg_date`) VALUES
(1, 'chrisbhaila5@gmail.com', 'skrtt', 'Chris Bhaila', 9844379971, 'Suryabinayak', '2024-05-24 19:23:54'),
(2, 'sugammanandhar8@gmail.com', 'skrtt', 'Sugam Manandhar', 9843738638, 'Kathmandu', '2024-07-12 11:50:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `completed_orders`
--
ALTER TABLE `completed_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `placed_order`
--
ALTER TABLE `placed_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `iduser` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `userreview` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `cartuse` (`customer_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `completed_orders`
--
ALTER TABLE `completed_orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `placed_order`
--
ALTER TABLE `placed_order`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `placed_order`
--
ALTER TABLE `placed_order`
  ADD CONSTRAINT `iduser` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`ID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `userreview` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`ID`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `cartuse` FOREIGN KEY (`customer_id`) REFERENCES `user_info` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
