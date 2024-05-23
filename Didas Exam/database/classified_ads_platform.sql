-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 03:59 PM
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
-- Database: `classified_ads_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `AdID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `CategoryID` int(11) NOT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `DatePosted` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('active','inactive','sold') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`AdID`, `UserID`, `ListingID`, `Title`, `Description`, `Price`, `CategoryID`, `Location`, `DatePosted`, `Status`) VALUES
(1, 1, 204, 'Selling iPhone X', 'Used iPhone X in good condition', 300.00, 1, 'New York', '2024-05-14 22:00:00', 'active'),
(2, 4, 202, 'Gaming Laptop for Sale', 'Powerful gaming laptop with NVIDIA graphics', 1200.00, 2, 'Los Angeles', '0000-00-00 00:00:00', 'active'),
(3, 5, 3, 'Vintage Vinyl Records Collection', 'Classic vinyl records collection from the 80s', 500.00, 3, 'Chicago', '2024-05-12 22:00:00', 'active'),
(4, 2, 205, 'Mountain Bike for Sale', 'Brand new mountain bike, perfect for outdoor adventures', 600.00, 4, 'San Francisco', '2024-05-11 22:00:00', 'active'),
(5, 3, 201, 'Antique Furniture Set', 'Elegant antique furniture set, ideal for collectors', 1500.00, 5, 'Miami', '2024-05-10 22:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `Name`, `Description`) VALUES
(1, 'Technology', 'Category for all things related to technology and gadgets.'),
(2, 'Science', 'Category covering various scientific disciplines and discoveries.'),
(3, 'Health', 'Category focusing on health, fitness, and medical topics.'),
(4, 'Business', 'Category discussing business strategies, entrepreneurship, and economics.'),
(5, 'Art', 'Category encompassing different forms of art such as painting, sculpture, and literature.'),
(6, 'Travel', 'Category for travel destinations, tips, and experiences.'),
(7, 'Food', 'Category dedicated to culinary delights, recipes, and food culture.');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `UserID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`UserID`, `ListingID`) VALUES
(1, 204),
(2, 201),
(3, 202),
(4, 203),
(5, 205);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `FromUserID` int(11) NOT NULL,
  `ToUserID` int(11) NOT NULL,
  `ListingID` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `FromUserID`, `ToUserID`, `ListingID`, `Rating`, `Comments`, `Timestamp`) VALUES
(1, 1, 4, 3, 4, 'Smooth transaction, item as described', '2024-05-16 08:30:00'),
(2, 5, 2, 6, 1, 'Excellent seller, fast shipping', '2024-05-15 09:45:00'),
(3, 3, 1, 2, 3, 'Item quality could be better', '2024-05-14 07:20:00'),
(4, 4, 5, 4, 2, 'Great product, thanks!', '2024-05-13 12:00:00'),
(5, 5, 3, 7, 5, 'Highly recommended seller', '2024-05-12 14:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `ImageID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `ImageURL` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`ImageID`, `ListingID`, `ImageURL`, `Description`) VALUES
(1, 7, 'https://example.com/iphone_image1.jpg', 'Front view of the iPhone X'),
(2, 201, 'https://example.com/iphone_image2.jpg', 'Back view of the iPhone X'),
(3, 202, 'https://example.com/laptop_image1.jpg', 'Gaming laptop with RGB keyboard'),
(4, 203, 'https://example.com/vinyl_image1.jpg', 'Collection of classic vinyl records'),
(5, 204, 'https://example.com/bike_image1.jpg', 'Mountain bike in outdoor setting');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `InstructorID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`InstructorID`, `UserID`, `Bio`) VALUES
(1, 5, 'Experienced teacher specializing in mathematics'),
(2, 4, 'Passionate music instructor offering guitar lessons'),
(3, 1, 'Certified fitness trainer with a focus on weight training'),
(4, 2, 'Yoga instructor promoting holistic wellness'),
(5, 3, 'Language tutor providing personalized lessons in French');

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `ListingID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `CategoryID` int(11) NOT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `DatePosted` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('active','inactive','sold') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`ListingID`, `Title`, `Description`, `Price`, `CategoryID`, `Location`, `DatePosted`, `Status`) VALUES
(1, 'Laptop for Sale', 'Gently used laptop, excellent condition.', 500.00, 1, 'New York', '2024-05-04 17:04:04', 'active'),
(2, 'Science Fiction Books Bundle', 'Collection of classic science fiction novels.', 50.00, 5, 'Los Angeles', '2024-05-04 17:04:04', 'active'),
(3, 'Fitness Equipment Set', 'Complete set of home gym equipment.', 1000.00, 3, 'Chicago', '2024-05-04 17:04:04', 'active'),
(4, 'Artwork - Abstract Painting', 'Original abstract painting by local artist.', 200.00, 5, 'San Francisco', '2024-05-04 17:04:04', 'active'),
(5, 'Business Strategy Consultation', 'Professional consultation for business development.', 150.00, 4, 'Seattle', '2024-05-04 17:04:04', 'active'),
(6, 'Travel Photography Workshop', 'Learn photography skills while exploring scenic locations.', 300.00, 6, 'Miami', '2024-05-04 17:04:04', 'active'),
(7, 'Gourmet Cooking Class', 'Hands-on cooking class with a professional chef.', 80.00, 7, 'Boston', '2024-05-04 17:04:04', 'active'),
(201, 'Math Tutoring Services', 'Offering one-on-one math tutoring sessions', 40.00, 6, 'New York', '2024-05-14 22:00:00', 'active'),
(202, 'Guitar Lessons for Beginners', 'Learn to play guitar from scratch', 25.00, 7, 'Los Angeles', '2024-05-13 22:00:00', 'active'),
(203, 'Weight Training Classes', 'Group fitness sessions focusing on weight training', 20.00, 3, 'Chicago', '2024-05-12 22:00:00', 'active'),
(204, 'Yoga Retreat Weekend', 'Relaxing yoga retreat in the mountains', 200.00, 5, 'San Francisco', '2024-05-11 22:00:00', 'active'),
(205, 'French Language Course', 'Intensive French language course for beginners', 150.00, 1, 'Miami', '2024-05-10 22:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(11) NOT NULL,
  `SenderID` int(11) NOT NULL,
  `ReceiverID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MessageID`, `SenderID`, `ReceiverID`, `ListingID`, `Timestamp`, `Content`) VALUES
(1, 1, 2, 203, '2024-05-16 08:35:00', 'Hi, Im interested in your tutoring services.'),
(2, 3, 4, 202, '2024-05-15 10:00:00', 'When are your next available guitar lessons?'),
(3, 3, 1, 205, '2024-05-14 07:30:00', 'Can I join your weight training classes?'),
(4, 2, 5, 204, '2024-05-13 12:30:00', 'Id like to book a spot for the yoga retreat.'),
(5, 5, 3, 201, '2024-05-12 14:45:00', 'Are there any upcoming sessions for the French course?');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('pending','completed','failed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `UserID`, `Amount`, `Timestamp`, `Status`) VALUES
(1, 4, 40000.00, '2024-05-15 08:00:00', 'completed'),
(2, 5, 25000.00, '2024-05-14 07:30:00', 'completed'),
(3, 1, 20660.00, '2024-05-13 06:45:00', 'completed'),
(4, 3, 20500.00, '2024-05-12 13:20:00', 'completed'),
(5, 2, 15000.00, '2024-05-11 12:10:00', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `ReportID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`ReportID`, `UserID`, `ListingID`, `Timestamp`, `Reason`) VALUES
(1, 1, 205, '2024-05-16 08:40:00', 'Inappropriate content'),
(2, 5, 203, '2024-05-15 09:50:00', 'Scam suspicion'),
(3, 4, 202, '2024-05-14 07:25:00', 'Seller not responding'),
(4, 2, 204, '2024-05-13 12:15:00', 'Item not as described'),
(5, 3, 201, '2024-05-12 14:50:00', 'Duplicate listing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'John', 'Doe', 'johndoe', 'johndoe@example.com', '123456789', 'hashedpassword', '2024-05-04 17:08:12', 'activation123', 0),
(2, 'Didas', 'BIRIMIMANA', 'Didas03', 'birimimanad@gmail.com', '073876544553', '$2y$10$4goK7AVwiGwYfMSfiUqXJOcdnHRCeXy43ep/zTAfoEe8difF6UtbW', '2024-05-16 13:10:53', NULL, 0),
(3, 'fidelite', 'mbabazi', 'fifi', 'fidelitembabazi34@gmail.com', '07855544423', '$2y$10$LaTh2SJMvAlBtJ80hCxO9.AN/Tyk9SOCmDIEpmmcwGoPFGW/P6Aoe', '2024-05-16 13:13:04', NULL, 0),
(4, 'phocas', 'niyonkuru', 'phocasniyo', 'niyonkuruphocas@gmail.com', '07855544423', '$2y$10$3LH/4UsDgV83dGWIlvxFGedmV5/XigYG.QDFCRHYXar7r.7p12v/O', '2024-05-16 13:14:17', NULL, 0),
(5, 'ELYSEE', 'ishimwe', 'ELYSEE05', 'eee@gmail.com', '0788903506', '$2y$10$6psWtC/qJisREaj0x7uZy.otKiFPHPdtLsQfiYWu/QSD/sr7j3F3e', '2024-05-16 13:15:02', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`AdID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ListingID` (`ListingID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`UserID`,`ListingID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `FromUserID` (`FromUserID`),
  ADD KEY `ToUserID` (`ToUserID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`InstructorID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`ListingID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `SenderID` (`SenderID`),
  ADD KEY `ReceiverID` (`ReceiverID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `AdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `ListingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `ads_ibfk_2` FOREIGN KEY (`ListingID`) REFERENCES `listings` (`ListingID`),
  ADD CONSTRAINT `ads_ibfk_3` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`ListingID`) REFERENCES `listings` (`ListingID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`FromUserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`ToUserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`ListingID`) REFERENCES `listings` (`ListingID`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`ListingID`) REFERENCES `listings` (`ListingID`);

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`SenderID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ReceiverID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`ListingID`) REFERENCES `listings` (`ListingID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`ListingID`) REFERENCES `listings` (`ListingID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
