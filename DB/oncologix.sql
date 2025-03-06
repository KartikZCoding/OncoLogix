-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2025 at 07:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oncologix`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('Vivek_vara', 'Vivek@69');

-- --------------------------------------------------------

--
-- Table structure for table `cancer`
--

CREATE TABLE `cancer` (
  `can_id` int(11) NOT NULL,
  `cancer_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cancer`
--

INSERT INTO `cancer` (`can_id`, `cancer_name`) VALUES
(1, 'Lung Cancer'),
(2, 'Kidney Cancer'),
(3, 'Stomach Cancer'),
(4, 'Brain Cancer'),
(5, 'Blood Cancer');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `c_id` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL,
  `h_id` int(11) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  `cancer_type` varchar(100) NOT NULL,
  `patient_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`c_id`, `p_id`, `d_id`, `h_id`, `t_id`, `cancer_type`, `patient_date`) VALUES
(10, 11, 11, 11, 11, 'Lung Cancer', '2025-02-12'),
(11, 12, 12, 12, 12, 'Lung Cancer', '2020-05-04'),
(12, 13, 13, 13, 13, 'Lung Cancer', '2019-08-05'),
(13, 14, 14, 14, 14, 'Kidney Cancer', '2012-12-04'),
(14, 15, 15, 15, 15, 'Kidney Cancer', '2009-08-07');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(100) NOT NULL,
  `experience` int(11) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `d_photo` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`d_id`, `d_name`, `experience`, `specialization`, `d_photo`, `email`) VALUES
(11, 'Dr. Nikhil Shah', 15, 'Oncology (Lung Cancer Specialist)', 'd1.jpg', 'dr.nikhilshah@example.com'),
(12, 'Dr. Emily Carter', 8, 'Thoracic Oncologist', 'd2.jpg', 'dr.emilycarter@mdanderson.org'),
(13, 'Dr. Sophie Brown', 19, 'Pulmonary Oncologist', 'd3.jpg', 'dr.sophiebrown@royalmarsden.nhs.uk'),
(14, 'Dr. Olivia Carter', 20, 'Urologic Oncologist', 'd4.jpg', 'dr.oliviacarter@uhn.ca'),
(15, 'Dr. Anna Müller', 18, 'Urologic Oncologist', 'd5.jpg', 'dr.annamuller@charite.de');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `h_id` int(11) NOT NULL,
  `h_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactNo` varchar(15) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`h_id`, `h_name`, `email`, `contactNo`, `country`, `state`, `city`) VALUES
(11, 'Apollo Cancer Institute', 'apollo.cancer@example.com', '+91 98234 56789', 'India', 'Gujarat', 'Ahmedabad'),
(12, 'MD Anderson Cancer Center', 'info@mdanderson.org', '+1 713-792-2121', 'USA', 'Texas', 'Houston'),
(13, 'The Royal Marsden Hospital', 'contact@royalmarsden.nhs.uk', '+44 20 7352 817', 'United Kingdom', 'England', 'London'),
(14, 'Princess Margaret Cancer Centre', 'info@pmcancercentre.ca', '+1 416-946-2000', 'Canada', 'Ontario', 'Toronto'),
(15, 'Charité – Universitätsmedizin Berlin', 'info@charite.de', '+49 30 45050', 'Germany', 'Berlin', 'Berlin');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `p_id` int(11) NOT NULL,
  `P_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `p_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`p_id`, `P_name`, `age`, `p_image`) VALUES
(11, 'Arjun Mehta', 58, 'p1.jpg'),
(12, 'Michael Johnson', 64, 'p2.jpg'),
(13, 'John Williams', 59, 'p3.jpg'),
(14, 'Robert Anderson', 62, 'p4.jpg'),
(15, 'Klaus Schneider', 67, 'p5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `t_id` int(11) NOT NULL,
  `t_given` text NOT NULL,
  `M_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`t_id`, `t_given`, `M_image`) VALUES
(11, 'Diagnosis involves biopsy, CT scan, and genetic testing. Early-stage cases undergo surgery followed by chemotherapy. Advanced cases receive chemotherapy, radiation, targeted therapy (EGFR/ALK inhibitors), or immunotherapy. Regular follow-ups with CT scans and blood tests ensure progress monitoring and adjustments in treatment.', 't1.jpg'),
(12, 'The patient is undergoing a combination of radiation therapy and immunotherapy to target tumor cells while minimizing damage to healthy tissues. A personalized treatment plan includes molecular testing to determine targeted drug therapy. Surgery may be performed if necessary.', 't2.jpg'),
(13, 'The patient is undergoing a combination of chemotherapy and targeted therapy to slow tumor growth. Immunotherapy is also considered based on PD-L1 expression levels. In early-stage cases, minimally invasive lung surgery is performed, followed by adjuvant therapy to prevent recurrence.', 't3.jpg'),
(14, 'The treatment plan includes a partial nephrectomy to remove the tumor while preserving kidney function. Targeted therapy is used post-surgery to prevent recurrence. Immunotherapy is considered for advanced cases to enhance the immune system’s response against cancer cells.', 't4.jpg'),
(15, 'The patient is undergoing robotic-assisted laparoscopic surgery to remove the tumor while preserving kidney function. Targeted therapy is prescribed post-surgery, and immunotherapy is considered for metastasis prevention.', 't5.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `cancer`
--
ALTER TABLE `cancer`
  ADD PRIMARY KEY (`can_id`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `d_id` (`d_id`),
  ADD KEY `h_id` (`h_id`),
  ADD KEY `t_id` (`t_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cancer`
--
ALTER TABLE `cancer`
  MODIFY `can_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `cases_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `patient` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cases_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `doctor` (`d_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cases_ibfk_3` FOREIGN KEY (`h_id`) REFERENCES `hospital` (`h_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cases_ibfk_4` FOREIGN KEY (`t_id`) REFERENCES `treatment` (`t_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
