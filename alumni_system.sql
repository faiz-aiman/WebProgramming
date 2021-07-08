-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2021 at 09:53 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic`
--

CREATE TABLE `academic` (
  `id` int(3) NOT NULL,
  `academic_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic`
--

INSERT INTO `academic` (`id`, `academic_level`) VALUES
(1, 'Bachelor of Computer Science'),
(3, 'Doctorate of Computer Science'),
(2, 'Master of Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `academic_major`
--

CREATE TABLE `academic_major` (
  `id` int(3) NOT NULL,
  `major` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_major`
--

INSERT INTO `academic_major` (`id`, `major`) VALUES
(1, 'Artificial Intelligence'),
(2, 'Computer System and Network'),
(3, 'Information Systems'),
(4, 'Software Engineering'),
(5, 'Multimedia'),
(6, 'Data Science'),
(7, 'Software Engineering (Software Technology) (Coursework and Dissertation)'),
(8, 'Computer Science (Applied Computing) (Coursework and Dissertation)'),
(9, 'Information Technology Management (Coursework)'),
(10, 'Data Science (Coursework)'),
(11, 'Library and Information Science (Coursework)'),
(12, 'Computer Science (Research)'),
(13, 'Information Science (Research)'),
(14, 'Doctor of Philosophy (Ph.D)');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'adminaifan', '$2y$10$EDChmqxg.hhPsOTfHwnLaukwzBWi71LXIZg/17Qp34w4biUWpgnou');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(254) NOT NULL,
  `ic_no` varchar(19) DEFAULT NULL,
  `passport_no` varchar(9) DEFAULT NULL,
  `verified` int(4) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` int(14) NOT NULL DEFAULT 0,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_email` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `username`, `email`, `password`, `ic_no`, `passport_no`, `verified`, `token`, `status`, `date_registered`, `date_email`) VALUES
(1, 'aifanshahran', 'aifanshahran@icloud.com', '$2y$10$WZy8lb2lEeFmIFdLG3/wduaBU7yMKnv69ausIt15Y8I/4n2qcPJ5a', '911111111111', NULL, 2, '3c651e13d3c093791f467f052aeb9cb9b1bee59b651e0c1404', 1, '2020-06-04 13:51:07', '2021-06-18'),
(2, 'ariamarissa', 'ariamarissa@gmail.com', '$2y$10$OuZuN2kDvNmMfNwAxpV8deAHyHH73A8MpxPfFLf4VBqglL6zDI8ju', '981217071112', NULL, 2, 'b70c16e5651ec41eda8e8dc5aa2ab52943c71e6ca34478f593', 1, '2021-06-04 10:00:42', '2021-06-15'),
(3, 'erennoah', 'erennoah@gmail.com', '$2y$10$HoZcmKoCeZ0.eLJEgrFkbOn1J/bVixKV7JNPGg4CudLRylLt/Tsya', '911111111112', NULL, 2, 'a71c16e5651ec41eda8e8dc5aa2ab52943c71e6ca34478f593', 1, '2021-06-02 10:45:29', '2021-06-15'),
(8, 'faizabdul', 'faizabdul12@gmail.com', '$2y$10$WZy8lb2lEeFmIFdLG3/wduaBU7yMKnv69ausIt15Y8I/4n2qcPJ5a', '961109071121', NULL, 2, 'c01b58b59a8a26b239f28b7978cfd16f8a630382801b764915', 1, '2021-06-18 04:56:40', '2021-06-18'),
(9, 'faridna', 'farid123@gmail.com', '$2y$10$WZy8lb2lEeFmIFdLG3/wduaBU7yMKnv69ausIt15Y8I/4n2qcPJ5a', '961109021121', NULL, 2, 'f9479906f6b5b75a36b902a161ce4c969c5cd419ac6c423014', 1, '2021-06-18 05:39:09', '2021-06-18'),
(10, 'leekuanaa', 'leekuan98@gmail.com', '$2y$10$HKPhdy2UA.SwLbYFTKgOkerZCl5gI6P7Wm.Hf/8kPwzz7DtdlajW6', '960525105131', NULL, 2, 'ae5816500a865b8fc7142e9e461dbd00b251845157c0a4f956', 1, '2021-06-18 07:29:03', '2021-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `alumni_list`
--

CREATE TABLE `alumni_list` (
  `id_no` varchar(19) NOT NULL,
  `name` varchar(100) NOT NULL,
  `registration_year` date NOT NULL,
  `course` int(3) NOT NULL,
  `major` int(3) NOT NULL,
  `graduation_year` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumni_list`
--

INSERT INTO `alumni_list` (`id_no`, `name`, `registration_year`, `course`, `major`, `graduation_year`) VALUES
('911111111112', 'Eren Noah Bin Ackerman', '2018-06-12', 1, 1, '2020-08-13'),
('951011054128', 'Barkoba bin Samat', '2009-09-11', 1, 4, '2013-10-10'),
('960525105131', 'Lee Kuan Yew', '2009-09-11', 1, 4, '2013-10-10'),
('961109021121', 'Muhammad Farid Bin Ali', '2009-09-11', 1, 1, '2013-10-10'),
('961109071121', 'Muhammad Faiz Bin Abdul', '2009-09-11', 1, 1, '2013-10-10'),
('96515101703', 'Aminah binti Jijo', '2009-09-11', 1, 6, '2013-10-10'),
('971201061145', 'Ahmad bin Osman', '2009-09-11', 1, 1, '2013-10-10'),
('980717064151', 'Sarah Shimah Sulaiman', '2013-09-12', 3, 7, '2015-10-11'),
('980726011111', 'Ali bin Abu', '2009-09-11', 1, 4, '2013-10-10'),
('981217071111', 'Mohamad Aiman Bin Shahran', '2009-09-11', 1, 4, '2013-10-10'),
('981217071112', 'Nur Aria Marissa Binti Hafizzudin', '2009-09-11', 1, 4, '2013-10-10'),
('E59659321', 'Ong Kim Swee', '2013-09-11', 3, 7, '2015-10-10'),
('M0993353', 'Matt Davies', '2013-09-11', 3, 10, '2015-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `alumni_login`
--

CREATE TABLE `alumni_login` (
  `alumni_id` int(11) NOT NULL,
  `login_info` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumni_login`
--

INSERT INTO `alumni_login` (`alumni_id`, `login_info`) VALUES
(1, '2021-06-15 05:05:25'),
(1, '2021-06-15 05:06:00'),
(1, '2021-06-15 05:06:22'),
(1, '2021-06-15 06:00:12'),
(1, '2021-06-15 06:24:24'),
(1, '2021-06-15 12:09:13'),
(1, '2021-06-15 13:33:52'),
(1, '2021-06-15 14:53:40'),
(1, '2021-06-16 04:50:33'),
(1, '2021-06-16 08:49:46'),
(1, '2021-06-16 12:35:40'),
(1, '2021-06-16 12:43:33'),
(1, '2021-06-16 13:18:39'),
(1, '2021-06-16 19:00:31'),
(1, '2021-06-16 19:01:55'),
(1, '2021-06-17 04:50:42'),
(1, '2021-06-17 05:50:59'),
(1, '2021-06-17 06:03:17'),
(1, '2021-06-17 08:49:41'),
(1, '2021-06-17 15:34:26'),
(1, '2021-06-17 18:11:28'),
(1, '2021-06-17 18:12:44'),
(1, '2021-06-17 18:14:57'),
(1, '2021-06-17 18:15:17'),
(1, '2021-06-17 18:29:43'),
(1, '2021-06-17 18:30:56'),
(1, '2021-06-17 18:52:54'),
(1, '2021-06-17 20:00:49'),
(1, '2021-06-17 20:59:42'),
(1, '2021-06-17 23:04:10'),
(1, '2021-06-18 00:17:28'),
(1, '2021-06-18 01:00:29'),
(1, '2021-06-18 01:05:33'),
(1, '2021-06-18 01:07:04'),
(1, '2021-06-18 04:24:12'),
(1, '2021-06-18 04:42:33'),
(1, '2021-06-18 04:45:59'),
(1, '2021-06-18 06:21:43'),
(1, '2021-06-18 07:02:05'),
(2, '2021-06-17 14:51:23'),
(2, '2021-06-17 15:22:00'),
(2, '2021-06-17 20:31:26'),
(3, '2021-06-17 15:19:28'),
(3, '2021-06-17 15:19:41'),
(3, '2021-06-17 15:25:02'),
(3, '2021-06-17 15:38:01'),
(3, '2021-06-17 17:07:33'),
(3, '2021-06-17 17:39:38'),
(3, '2021-06-17 19:01:46'),
(8, '2021-06-18 04:57:46'),
(8, '2021-06-18 05:09:14'),
(8, '2021-06-18 05:09:56'),
(8, '2021-06-18 05:11:19'),
(9, '2021-06-18 05:39:43'),
(9, '2021-06-18 05:58:30'),
(10, '2021-06-18 07:29:47'),
(10, '2021-06-18 07:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `alumni_profile`
--

CREATE TABLE `alumni_profile` (
  `alumni_id` int(11) NOT NULL,
  `title` varchar(10) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `religion` varchar(10) DEFAULT NULL,
  `degree_id` int(3) DEFAULT NULL,
  `major_id` int(3) DEFAULT NULL,
  `intake_year` date DEFAULT NULL,
  `graduate_year` date DEFAULT NULL,
  `emp_status` varchar(10) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `privacy_contact` int(1) DEFAULT 0,
  `privacy_dob` int(1) DEFAULT 0,
  `privacy_status` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumni_profile`
--

INSERT INTO `alumni_profile` (`alumni_id`, `title`, `fullname`, `birthdate`, `gender`, `religion`, `degree_id`, `major_id`, `intake_year`, `graduate_year`, `emp_status`, `phone_no`, `address`, `postcode`, `state`, `country`, `profile_pic`, `privacy_contact`, `privacy_dob`, `privacy_status`) VALUES
(1, 'Tan Sri', 'Muhammad Irfan Nazifi Bin Shahran', '1970-01-01', 'Male', 'Islam', 1, 4, '2009-09-11', '2013-10-10', 'working', '+60194422123', 'Unit 77, Pavillion Residences, Jalan Raja Chulan Off Pavillion, Bukit Bintang, KL City', '55100', 'Wilayah Persekutuan Kuala Lumpur', 'Malaysia', 'irfannazifi.jpg', 0, 1, 1),
(2, 'Ms', 'Nur Aria Marissa Binti Hafizzudin', '1998-12-17', 'Female', 'Islam', 1, 4, '2009-09-11', '2013-10-10', 'working', '+60192122321', 'No. 1, Jalan Permai', '76211', 'Penang', 'Malaysia', 'profile-picture-3.jpg', 0, 1, 0),
(3, 'Mr', 'Eren Noah Bin Ackerman', '1991-11-11', 'Male', 'Islam', 1, 1, '2018-06-12', '2020-08-13', 'working', '+60192212323', 'No. 232, Jalan Permai Indah, Seksyen 15', '12123', 'Wilayah Persekutuan Putrajaya', 'Malaysia', NULL, 0, 1, 0),
(8, 'Mr', 'Muhammad Faiz Bin Abdul Rahim', '1996-09-11', 'Male', 'Islam', 1, 1, '2009-11-09', '2013-10-10', 'working', '+60192123221', 'No 6, Jalan Singgang Peram Jadah', '12321', 'Melaka', 'Malaysia', NULL, 0, 0, 0),
(9, 'Doctor', 'Muhammad Farid Bin Ali', '1970-01-01', 'Male', 'Islam', 1, 1, '2009-09-11', '2013-10-10', 'unemployed', '+60192123223', 'No. 1123, Jalan Parlimen 12', '12321', 'Wilayah Persekutuan Kuala Lumpur', 'Malaysia', 'profile-picture-2.jpg', 0, 1, 0),
(10, 'Mr', 'Lee Kuan Yew', '1970-01-01', 'Male', 'Islam', 1, 4, '2009-09-11', '2013-10-10', NULL, '019-232 1111', 'No.1, Example', '21223', 'Penang', 'Malaysia', NULL, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `approval_status`
--

CREATE TABLE `approval_status` (
  `id` int(4) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approval_status`
--

INSERT INTO `approval_status` (`id`, `status`) VALUES
(1, 'Pending'),
(2, 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `category` varchar(50) NOT NULL,
  `venue` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `admin_id`, `title`, `date_start`, `date_end`, `category`, `venue`, `description`, `photo`) VALUES
(1, 1, 'UM GlobalWE Connect 2021 Women\'s Empowerment Expo', '2021-06-21 10:00:00', '2021-06-21 12:00:00', 'Lecture/Reading/Talk', 'Google Meet', 'UM GlobalWE Connect Is A New Initiative That Connects University Of Malaya Alumni With Organizations Leading The Way Globally For Women’s Empowerment In The Arts, Entrepreneurship, Policy, STEM, And Other Fields.', 'event1.jpg'),
(2, 1, 'HCSF Salon Talk Series: Veritas On The National Mall', '2021-06-30 14:00:00', '2021-06-30 16:00:00', 'Lecture/Reading/Talk', 'Microsoft Teams', 'The University Board of Directors in a meeting on 28 August 2017 approved the establishment of the UM Endowment Fund.', 'event2.jpg'),
(3, 1, 'Professor Michael Sandel Book Discussion', '2021-06-19 09:00:00', '2021-06-19 12:00:00', 'Lecture/Reading/Talk', 'Google Meet', 'The Alumni Leadership Series is designed to enable UM to engage with alumni who provide leadership in the various sectors as mentors and positive role models.', 'event3.jpg'),
(4, 1, 'Annual Dinner: A Night to Remember', '2021-08-23 20:00:00', '2021-08-23 23:00:00', 'Reunion', 'Dewan Tunku Canselor', 'The Alumni office organizes reunion events to make it easier for our alumni to come together and share their experiences. You can reconnect with your graduating class, meet other alumni and even your former professors and administration. ', 'event4.jpg'),
(5, 1, 'Charity Car Boot Sale', '2021-07-14 09:00:00', '2021-07-16 22:00:00', 'Social', 'Bangunan Canseleri, Universiti Malaya', 'Pusat Hubungan Alumni & Kemajuan Institusi (CARIA) ingin menganjurkan program Charity Car Boot Sale, berhadapan Bangunan Canseleri, Universiti Malaya. Program ini melibatkan warga UM, alumni dan masyarakat awam sekitar Universiti Malaya. ', 'vector-car-boot-sale-illustration.jpg'),
(6, 1, 'UM Endowment Fund', '2021-09-15 00:00:00', '2021-10-15 23:30:00', 'Volunteer', 'UM Payment Gateway', 'University of Malaya Endownment Fund (UMEF) can help fund a scholarship or bursary, it enhances our students’ welfare provision and provides improved facilities to support the learning experience and promote life-changing research. Every contribution made, no matter the size, really does make a difference.', '11623762645::1people-volunteering-donating-money_53876-43051.jpg'),
(7, 1, 'Alumni Leadership Series', '2021-07-14 15:00:00', '2021-07-14 20:00:00', 'Lecture/Reading/Talk', 'Google Meet', 'Our Alumni Leadership Series events are masterclasses on how to become a successful leader, covering topics from leadership pitfalls to leveraging your network during busy times. Surrounded by no more than 20 peers, selected guests get an exclusive opportunity to question, connect and network with leaders from some of the top global organisations.', '11623762854::1conversation-concept-illustration_114360-1102.jpg'),
(8, 1, 'Finding Your Fit with SASS Alumni', '2021-07-14 14:00:00', '2021-07-14 18:00:00', 'Student Engagement', 'Google Meet', 'UM graduates from various countries virtually gathered for a career panel discussion to address and acknowledge the fears and qualms which often arise when graduates and soon-to-be graduates envision their career prospects. The diverse panel included, Aw Yuong Tuck from Malaysia, Lecturer at Help University, Gladys Nathania, Associate Consultant at Michael Page in Indonesia, Kento Mase, Sales and Marketing Associate at Hankyu Hanshin Properties in Japan, Ameer Sobhan from Bangladesh currently a Senior Analyst at United Nations Office for Project Services (UNOPS) in Thailand, and Tay Siao Lin, HR Business Partners for Corporate Services at British American Tobacco Malaysia. Together, they shared their personal career experiences and insight into the current job scene amidst the COVID-19 pandemic.', '11623763743::132020983.jpg'),
(9, 1, 'Webinar: Standing by the Community', '2021-09-15 20:30:00', '2021-09-15 21:30:00', 'Lecture/Reading/Talk', 'Google Meet', 'We are committed to giving back to society via our community pillar. Learn from 3 of our alumni on how they started their initiatives to help and impact the community.\r\n\r\nRinisha VIjayen - Little Helpers KL\r\nRadhika Divya - MYDelivery Heroes\r\nCharis Wong - MYDelivery Heroes', '11623767163::1engaging-interactive-webinar-best-practices-and-formats.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_rsvp`
--

CREATE TABLE `event_rsvp` (
  `event_id` int(11) NOT NULL,
  `alumni_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_rsvp`
--

INSERT INTO `event_rsvp` (`event_id`, `alumni_id`) VALUES
(1, 1),
(1, 10),
(2, 1),
(3, 1),
(3, 2),
(3, 9),
(3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback` text NOT NULL,
  `readstatus` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `feedback`, `readstatus`) VALUES
(1, 'Toh Teng', 'tohteng@gmail.com', 'Hi, I just received the notification about my account status. But until now, I still can\'t view my profile. Can you please assist me?', 1),
(2, 'Nur Atiqah', 'atiqahhasbullah@gmail.com', 'May i know how long it takes to verify my account?', 0),
(3, 'Mohamad Aiman', 'aimanz98@yahoo.com', 'Hi there, can public user register?', 0),
(4, 'Ezairie Rohaizat', 'ezairie98@gmail.com', 'Salam, can i change my password?', 0),
(5, 'Ezuan Sabran', 'ezuansabran@gmail.com', 'Hello there! Thank you for your effort to answer my question! May i know it\'s there any vacancy available here?', 0),
(6, 'Arman Izani', 'armanizani@gmail.com', 'Hi, why i can\'t view my account yet?', 0),
(7, 'Azrin Amran', 'azrinfreeman@gmail.com', 'Hello! What is the benefit in this system?', 0);

-- --------------------------------------------------------

--
-- Table structure for table `friend_list`
--

CREATE TABLE `friend_list` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `approval_status` int(4) NOT NULL DEFAULT 1,
  `date_requested` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_accepted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_list`
--

INSERT INTO `friend_list` (`id`, `sender_id`, `receiver_id`, `approval_status`, `date_requested`, `date_accepted`) VALUES
(1, 9, 1, 2, '2021-06-18 06:23:09', '2021-06-18 14:24:20'),
(2, 10, 1, 2, '2021-06-18 07:35:10', '2021-06-18 15:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `alumni_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `job_type` varchar(100) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `job_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `alumni_id`, `job_title`, `company_name`, `area`, `description`, `job_type`, `salary`, `start_date`, `end_date`, `contact_no`, `email`, `job_pic`) VALUES
(1, 1, 'Data Scientist Internship', 'Malayan Banking Berhad', 'Penang, Malaysia', '<p>Responsibilities:&nbsp;</p>\r\n<p style=\"text-align: justify;\">To assist and support the smooth running of Private Wealth&rsquo;s business unit, with regard to business affairs and to establish &nbsp;and maintain a good rapport/relationship with stakeholders.</p>\r\n<p style=\"text-align: justify;\">Provide secretarial support to Head, Private Wealth by managing schedule, organizing meetings, &nbsp;travelling and appointments by engaging with the relevant parties to ensure schedules are run smoothly &amp; calendar appointments are up to date.</p>\r\n<p style=\"text-align: justify;\">Ensure preparation &amp; readiness of meeting materials and deck prior to meeting schedules.</p>\r\n<p style=\"text-align: justify;\">Coordinate and consolidation of approval paper submission for Head, Private Wealth Business Unit&rsquo;s sign-off and approval.</p>\r\n<p style=\"text-align: justify;\">Provides administrative support by managing claims, staff leaves &amp; other</p>\r\n<p><span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span></p>\r\n<p>Requirement:</p>\r\n<p style=\"text-align: justify;\">Exposure Secretary/Executive Secretary/Personal Assistance supporting Managing Director or C-suites level</p>\r\n<p style=\"text-align: justify;\">Exposure in Event Management</p>\r\n<p style=\"text-align: justify;\">Strong oral and written communication skills in English and Bahasa Malaysia.</p>\r\n<p style=\"text-align: justify;\">Excellent in Microsoft Application i.e. Word, Excel and Power Point.</p>\r\n<p style=\"text-align: justify;\">Ability to perform/work under pressure, independent and a strong team player.</p>\r\n<p style=\"text-align: justify;\">Good interpersonal skills, able to interact with people at all levels and excellent organization and planning skills.</p>', 'Banking', '1,200.00', '2021-06-17 00:00:00', '2021-08-18 23:30:00', '+60194422125', 'hr@maybank.com', '11623831824::1job-banner-1.jpg'),
(10, 1, 'Web Developer', 'Zoom Infinty', 'Melaka, Malaysia', '<p><em><strong>Job Highlights</strong></em></p>\r\n<p>We believe in a good work life balance</p>\r\n<p>We believe bugs come in through open Windows</p>\r\n<p>We work in servitude to the Elders of The Internet</p>\r\n<p><em><strong>Job Description</strong></em></p>\r\n<p>We are looking for experienced Frontend and Backend Developers to join our Global IT Operation Center in Kuala Lumpur.</p>\r\n<p>You will be responsible for the transition and operations of our internally developed services in collaboration with our developers based in Denmark and products owners in the line of business. You will have close co-operation with other IT teams in Kuala Lumpur and our teams located in our headquarters in Denmark.</p>\r\n<p>The Digital Business Services team in Denmark are responsible for our Digitalization initiatives and work closely with our Research &amp; Development division to develop new products.</p>\r\n<p><em><strong>Tasks and Responsibilities</strong></em></p>\r\n<p>- To participate in the development of feature enhancements and technical upgrades for the custom applications.</p>\r\n<p>- Responsible for technical incidents and service request on custom application services.</p>\r\n<p>- To conduct performance testing and optimize services by using tools like Application Insight.&nbsp;</p>\r\n<p>- Technical upgrades of the custom applications.</p>\r\n<p>-&nbsp; Change management on existing custom applications.</p>\r\n<p>- Able to collaborate openly with a mixed team of developers and collaborators from different parts of the world.</p>\r\n<p>- Education and Experience Required</p>\r\n<p>- Bachelor\'s Degree in Computer Science or Information Technology, or equivalent, from a two or four year college or university.&nbsp;</p>\r\n<p>You have a minimum <strong>3-5 years </strong>of professional working experience in developing software.</p>\r\n<p>You have at least 2-3 areas of technical knowledge and work experience with technologies and products like ASP.NET, C#, Entity Framework, Web API, Microsoft Azure or other cloud providers. Good understanding of GIT source control and CI/CD environment or pipelines. Proficient with both NoSQL (Cosmo DB) and MSSQL. Front-end development preferably with ReactJS, TypeScript and Bootstrap. It will also be an advantage if you have experience with Agile development, MS DevOps /Atlassian and knowledge of ITIL.</p>', 'BioTech/Pharmaceutical', '5,000.00', '2021-06-18 00:00:00', '2021-06-27 23:30:00', '+60123212323', 'hr@zoominfinity.com', 'job-banner-2.jpg'),
(11, 1, 'PHP Software Developer / Programmer', 'SiteGiant Sdn. Bhd.', 'Wilayah Persekutuan Kuala Lumpur, Malaysia', '<p><em><strong>Responsibilities</strong></em></p>\r\n<p>- Building new features, new application, working with various API\'s on top of SiteGiant\'s Ecommerce Platform.</p>\r\n<p>- Researches and develops new web technologies.</p>\r\n<p>- Setup web application according to customer requirement.</p>\r\n<p>- Perform variety of tasks, which include debugging and system analysis.</p>\r\n<p>- Providing technical support after software implementation.</p>\r\n<p><em><strong>Requirements:&nbsp;</strong></em></p>\r\n<p>- &nbsp;Candidate must possess at least a Professional Certificate, Diploma, Degree in Engineering (Computer/Telecommunication), Computer Science/Information or equivalent.</p>\r\n<p>- Required skill(s): PHP, MYSQL, HTML 5, CSS, Java Script.</p>\r\n<p>- Fresh graduates are encouraged to apply. Training will be provided</p>\r\n<p>- Applicants must be willing to work in Bayan Baru, Penang, however during MCO, applicants are allowed to work from home.</p>\r\n<p>- Strong interest in developing Web 2.0 applications</p>\r\n<p>- An independent, resourceful, result-oriented and analytical thinker</p>\r\n<p>- Familiarity with MVC Web Application Architecture is a major plus.</p>\r\n<p>- Possess strong skills in application design, implementation, testing and trouble-shooting</p>\r\n<p>- Possess Strong skills in programming and system analysis is an advantage.</p>\r\n<p>- Able to deliver under pressure and tight deadlines</p>\r\n<p>- 10 Full-Time positions are available</p>\r\n<p>&nbsp;</p>\r\n<p><em><strong>Personality Requirements :</strong></em></p>\r\n<p>- Excellent Interpersonal and communication skills</p>\r\n<p>- Self-motivated, able to handle pressure and willing to go extra miles</p>\r\n<p>&nbsp;</p>\r\n<p><em><strong>In SiteGiant, we provide :</strong></em></p>\r\n<p>- A positive environment that foster innovation and performance</p>\r\n<p>- Outstanding career development opportunities</p>\r\n<p>- Attractive salary and remuneration package</p>\r\n<p>- Fantastic products to introduce to eCommerce Industry</p>\r\n<p>- If you are a positive, efficient, and hard-working person, you are encouraged to apply for this job!&nbsp;</p>', 'IT/Software', '3,500.00', '2021-06-19 00:00:00', '2021-07-15 19:00:00', '+60192345331', 'hr@sitegiant.com', 'job-banner-3.jpg'),
(12, 9, 'Developer', 'Chr Hansen Malaysia Sdn Bhd', 'Melaka, Malaysia', '<div class=\"FYwKg _3gJU3_0 _1yPon_0\" style=\"margin: 0px; padding: 48px 0px 0px; border: 0px; box-sizing: border-box; font-size: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">\r\n<div class=\"FYwKg\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: inherit; font-size: inherit; font-style: inherit; font-variant-caps: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline;\" data-automation=\"job-details-job-highlights\">\r\n<div class=\"FYwKg d7v3r _3aoZS_0\" style=\"margin: 0px; padding: 1px 0px 0px; border: 0px; box-sizing: border-box; font-family: inherit; font-size: inherit; font-style: inherit; font-variant-caps: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">\r\n<div class=\"FYwKg fB92N_0\" style=\"margin: 0px; padding: 24px 0px 0px; border: 0px; box-sizing: border-box; font-family: inherit; font-size: inherit; font-style: inherit; font-variant-caps: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline;\">\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">Job Highlights</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">We believe in a good work life balance</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">We believe bugs come in through open Windows</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">We work in servitude to the Elders of The Internet</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">Job Description</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">We are looking for experienced Frontend and Backend Developers to join our Global IT Operation Center in Kuala Lumpur.</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">You will be responsible for the transition and operations of our internally developed services in collaboration with our developers based in Denmark and products owners in the line of business. You will have close co-operation with other IT teams in Kuala Lumpur and our teams located in our headquarters in Denmark.</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">The Digital Business Services team in Denmark are responsible for our Digitalization initiatives and work closely with our Research &amp; Development division to develop new products.</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">Tasks and Responsibilities</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">&nbsp; &nbsp; &nbsp; To participate in the development of feature enhancements and technical upgrades for the custom applications.</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">&nbsp; &nbsp; &nbsp; Responsible for technical incidents and service request on custom application services.</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">&nbsp; &nbsp; &nbsp; To conduct performance testing and optimize services by using tools like Application Insight.&nbsp;</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">&nbsp; &nbsp; &nbsp; Technical upgrades of the custom applications.</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">&nbsp; &nbsp; &nbsp; Change management on existing custom applications.</p>\r\n<p class=\"FYwKg C6ZIU_0 _3nVJR_0 _2VCbC_0 _2DNlq_0 _1VMf3_0\" style=\"margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; font-family: Roboto, \'Helvetica Neue\', HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 18px; font-style: inherit; font-variant-caps: inherit; font-weight: 500; font-stretch: inherit; line-height: 28px; vertical-align: baseline; color: #1e222b;\">Able to collaborate openly with a mixed team of developers and collaborators from different parts of the world.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 'Banking', '5,000.00', '2021-06-19 00:00:00', '2021-06-28 10:00:00', '+60192122233', 'hr@bla.com', '91623997955::1convo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `content_id` int(11) NOT NULL,
  `read_status` int(1) NOT NULL DEFAULT 0,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `receiver_id`, `type`, `content_id`, `read_status`, `time`) VALUES
(1, 1, 'request', 9, 0, '2021-06-18 14:23:09'),
(2, 9, 'acceptFriend', 1, 0, '2021-06-18 14:24:20'),
(5, 1, 'event', 12, 0, '2021-06-18 15:44:04'),
(6, 2, 'event', 12, 0, '2021-06-18 15:44:04'),
(7, 3, 'event', 12, 0, '2021-06-18 15:44:04'),
(8, 8, 'event', 12, 0, '2021-06-18 15:44:04'),
(9, 9, 'event', 12, 0, '2021-06-18 15:44:04'),
(10, 10, 'event', 12, 0, '2021-06-18 15:44:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic`
--
ALTER TABLE `academic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `degree_level` (`academic_level`),
  ADD UNIQUE KEY `degree_level_2` (`academic_level`);

--
-- Indexes for table `academic_major`
--
ALTER TABLE `academic_major`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `ic_no` (`ic_no`),
  ADD UNIQUE KEY `passport_no` (`passport_no`),
  ADD KEY `approval_id` (`verified`);

--
-- Indexes for table `alumni_list`
--
ALTER TABLE `alumni_list`
  ADD PRIMARY KEY (`id_no`),
  ADD UNIQUE KEY `id_no` (`id_no`),
  ADD KEY `course_id` (`course`),
  ADD KEY `major_id` (`major`);

--
-- Indexes for table `alumni_login`
--
ALTER TABLE `alumni_login`
  ADD PRIMARY KEY (`alumni_id`,`login_info`) USING BTREE,
  ADD KEY `alumni_id` (`alumni_id`);

--
-- Indexes for table `alumni_profile`
--
ALTER TABLE `alumni_profile`
  ADD PRIMARY KEY (`alumni_id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`),
  ADD KEY `alumni_id` (`alumni_id`),
  ADD KEY `degree_id` (`degree_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `approval_status`
--
ALTER TABLE `approval_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `event_rsvp`
--
ALTER TABLE `event_rsvp`
  ADD PRIMARY KEY (`event_id`,`alumni_id`) USING BTREE,
  ADD KEY `event_id` (`event_id`),
  ADD KEY `alumni_id` (`alumni_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_list`
--
ALTER TABLE `friend_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approval_status` (`approval_status`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumni_id` (`alumni_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic`
--
ALTER TABLE `academic`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `academic_major`
--
ALTER TABLE `academic_major`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `approval_status`
--
ALTER TABLE `approval_status`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `friend_list`
--
ALTER TABLE `friend_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni`
--
ALTER TABLE `alumni`
  ADD CONSTRAINT `alumni_ibfk_1` FOREIGN KEY (`verified`) REFERENCES `approval_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `alumni_list`
--
ALTER TABLE `alumni_list`
  ADD CONSTRAINT `course_id` FOREIGN KEY (`course`) REFERENCES `academic` (`id`),
  ADD CONSTRAINT `major_id` FOREIGN KEY (`major`) REFERENCES `academic_major` (`id`);

--
-- Constraints for table `alumni_login`
--
ALTER TABLE `alumni_login`
  ADD CONSTRAINT `alumni_login_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `alumni_profile`
--
ALTER TABLE `alumni_profile`
  ADD CONSTRAINT `alumni_profile_ibfk_1` FOREIGN KEY (`degree_id`) REFERENCES `academic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumni_profile_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `academic_major` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `alumni_profile_ibfk_3` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_rsvp`
--
ALTER TABLE `event_rsvp`
  ADD CONSTRAINT `event_rsvp_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_rsvp_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friend_list`
--
ALTER TABLE `friend_list`
  ADD CONSTRAINT `receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `alumni` (`id`),
  ADD CONSTRAINT `sender_id` FOREIGN KEY (`sender_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`receiver_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
