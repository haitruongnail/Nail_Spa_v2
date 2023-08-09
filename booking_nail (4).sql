-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 09, 2023 lúc 10:23 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `booking_nail`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date_duration` date NOT NULL,
  `time_duration` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `booking`
--

INSERT INTO `booking` (`id`, `company_id`, `service_id`, `staff_id`, `date_duration`, `time_duration`, `user_id`, `create_at`) VALUES
(101, 23, 25, 48, '2023-08-12', '15:00:00', 88, '2023-08-09'),
(102, 23, 26, 49, '2023-08-10', '11:30:00', 85, '2023-08-09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `rand_id` int(4) NOT NULL,
  `company_name` text NOT NULL,
  `img_company` text NOT NULL,
  `hotline` text NOT NULL,
  `address` text NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `password` text NOT NULL,
  `day_start` text NOT NULL,
  `day_end` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `company`
--

INSERT INTO `company` (`id`, `rand_id`, `company_name`, `img_company`, `hotline`, `address`, `time_start`, `time_end`, `status`, `password`, `day_start`, `day_end`) VALUES
(23, 6294, 'Bing 2', 'Ảnh chụp màn hình 2022-11-02 183300.png', '123-777-8888', ' 9912 VIRGINIA 194', '05:30:00', '22:30:00', 1, '11111', 'Monday', 'Sunday');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `header`
--

CREATE TABLE `header` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `logo_company` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `time_start` text NOT NULL,
  `time_end` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `header`
--

INSERT INTO `header` (`id`, `company_name`, `logo_company`, `phone`, `address`, `time_start`, `time_end`) VALUES
(1, 'Nails By The Falls', 'images (3).jpg', '(703) 438-3901', '9912 Virginia 194', '08:00', '22:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nailtype`
--

CREATE TABLE `nailtype` (
  `id` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `type_name` text NOT NULL,
  `img_type` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nailtype`
--

INSERT INTO `nailtype` (`id`, `id_company`, `type_name`, `img_type`, `description`, `status`) VALUES
(9, 23, 'Nail 1', 'Ảnh chụp màn hình 2022-11-02 183300.png', '', 1),
(10, 23, 'Nail 2', 'Ảnh chụp màn hình 2022-11-02 183300.png', '', 1),
(11, 23, 'Hair Extension 1', 'Business_Cadillac-Halo-001 (1).png', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name_service` text NOT NULL,
  `img_service` text NOT NULL,
  `price` int(11) NOT NULL,
  `time_completion` time NOT NULL,
  `type_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name_service`, `img_service`, `price`, `time_completion`, `type_id`, `company_id`, `status`) VALUES
(24, 'Cutting hair', 'Ảnh chụp màn hình 2022-11-02 183300.png', 1000, '00:30:00', 9, 23, 1),
(25, 'Watching', 'to_yen_2.png', 500, '00:45:00', 10, 23, 1),
(26, 'Cutting hair 2', 'Ảnh chụp màn hình 2022-11-02 183300.png', 250, '01:00:00', 9, 23, 1),
(27, 'Cutting hair 3', 'Ảnh chụp màn hình 2022-11-02 183300.png', 100, '01:00:00', 10, 23, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `code` int(6) NOT NULL,
  `user_name` text NOT NULL,
  `avatar` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `birth` date NOT NULL,
  `gender` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `staff`
--

INSERT INTO `staff` (`id`, `code`, `user_name`, `avatar`, `phone`, `email`, `address`, `birth`, `gender`, `company_id`, `service_id`, `create_at`) VALUES
(48, 262355, 'Staff 21', 'Ảnh chụp màn hình 2022-11-02 183300.png', '0359893447', 'levanlam3447@gmail.com', ' 9912 VIRGINIA 194', '2023-08-03', 'Male', 23, 25, '2023-08-09'),
(49, 262355, 'Staff 21', 'Ảnh chụp màn hình 2022-11-02 183300.png', '0359893447', 'levanlam3447@gmail.com', ' 9912 VIRGINIA 194', '2023-08-03', 'Male', 23, 26, '2023-08-09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `description` text NOT NULL,
  `ip_user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullname`, `phone`, `email`, `description`, `ip_user`) VALUES
(2, 'test', '0123456789', 'admin@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam voluptatibus repellendus earum impedit nulla sequi quis blanditiis provident, a reprehenderit accusantium doloremque facilis sit quibusdam dolor incidunt, sed doloribus asperiores?', ''),
(3, 'New user ', '1234567890', 'admin@gmail.com', 'nulll', ''),
(4, 'Nguyen Van A', '123', 'Admin@gmail.com', 'đasad', ''),
(5, 'User 2', '1234567890', 'Admin@gmail.com', 'llore', ''),
(6, 'New Hero', '0123456789', 'hero0@gmail.com', '', ''),
(7, 'New test 3', '1234567890', 'admin@gmail.com', 'lorem', ''),
(8, 'test new option', '0359893447', 'levanlam3447@gmail.com', '', ''),
(9, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(10, 'Tesszny', '0123456789', 'admin@gmail.com', '', ''),
(11, 'Tesszny', '0123456789', 'admin@gmail.com', '', ''),
(12, 'asfsf', '01246436245', 'admin@gmail.com', '', ''),
(13, 'Admin', '051523532523', 'admin@gmail.com', '', ''),
(14, 'Le LAM', '035989344721', 'fasdasd@gmail.com', '', ''),
(15, 'dsadsad', '0412421424', 'admin@gmail.com', '', ''),
(16, '323213', '0623535235', 'admin@gmail.com', '', ''),
(17, 'testset', '0854734672', 'admin@gmail.com', '', ''),
(18, 'teste', '021215215215', 'admin@gmail.com', '', ''),
(19, '32132', '06236235623', 'levanlam3447@gmail.com', '', ''),
(20, 'Tesszny', '05125215215', 'admin@gmail.com', '', ''),
(21, 'Tesszny', '051252152152', 'admin@gmail.com', '', ''),
(22, 'Tesszny', '051252152153', 'admin@gmail.com', '', ''),
(23, 'new', '0535745547325', 'admin@gmail.com', '', ''),
(24, 'new', '0854734624', 'admin@gmail.com', '', ''),
(25, 'tetest', '061543243', 'admin@gmail.com', '', ''),
(26, 'testtet', '0834523235', 'admin@gmail.com', '', ''),
(27, 'Me 2', '01213445783', 'admin@gmail.com', '', ''),
(28, 'Tesszny', '067346236', 'admin@gmail.com', '', ''),
(29, 'Tesszny', '0123456789', 'admin@gmail.com', '', ''),
(30, 'tetet', '0359893447', 'levanlam3447@gmail.com', '', ''),
(31, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(32, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(33, 'My name', '0359893447', 'levanlam3447@gmail.com', '', ''),
(34, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(35, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(36, 'tetet', '0123456789', 'admin@gmail.com', '', ''),
(37, 'tetet', '0123456789', 'admin@gmail.com', '', ''),
(38, 'tetet', '0123456789', 'admin@gmail.com', '', ''),
(39, 'tetet', '021215215215', 'admin@gmail.com', '', ''),
(40, 'tetet', '0123456789', 'admin@gmail.com', '', ''),
(41, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(42, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(43, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(44, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(45, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(46, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(47, 'Le LAM', '222222222', 'levanlam3447@gmail.com', '', ''),
(48, 'Le LAM', '222-222-2222', 'levanlam3447@gmail.com', '', ''),
(49, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(50, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(51, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(52, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(53, 'Le LAM', '123-223-6789', 'levanlam3447@gmail.com', '', ''),
(54, 'Le LAM', '123-223-6789', 'levanlam3447@gmail.com', '', ''),
(55, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(56, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(57, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(58, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(59, 'Le LAM', '0359893447', 'levanlam3447@gmail.com', '', ''),
(60, 'Le LAM', '0123456789', 'levanlam3447@gmail.com', '', ''),
(61, 'Le LAM', '0123456347', 'levanlam3447@gmail.com', '', ''),
(62, 'Le LAM', '0123456347', 'levanlam3447@gmail.com', '', ''),
(63, 'Le LAM', '0123456347', 'levanlam3447@gmail.com', '', ''),
(64, 'Le LAM', '0123456337', 'levanlam3447@gmail.com', '', ''),
(65, 'new bi', '03598934472', 'admin@gmail.com', '', ''),
(66, 'Le LAM', '0123456555', 'levanlam3447@gmail.com', '', ''),
(67, 'Le LAM', '0123456555', 'levanlam3447@gmail.com', '', ''),
(68, 'fasfa fsafasf', '0123456555', 'levanlam3447@gmail.com', '', ''),
(69, 'Thuy Hang', '123-456-7890', 'levanlam3447@gmail.com', '', ''),
(70, 'new user', '123-123-1234', '', '', ''),
(71, 'dasds asd a dasw', '0123411111', 'levanlam3447@gmail.com', '', ''),
(72, 'new bi', '321321321323213', '', '', ''),
(73, 'new bi', '321321321323213', '', '', ''),
(74, '123 23132', '123-123-1234', '', '', ''),
(75, 'eqweqw nii', '123-123-1234', '', '', ''),
(76, 'New2 Name3', '123-123-1234', '', '', ''),
(77, 'Devid bk', '123-123-1234', '', '', ''),
(78, 'New User', '123-123-1235', '', '', ''),
(79, 'Van Ty', '123-123-1236', '', '', '::1'),
(80, 'Van Ty2', '123-123-1237', '', '', '::1'),
(85, 'user 32', '+84359893447', '', '', '::1'),
(86, 'user tesst', '(760) 760-2706', '', '', '::1'),
(88, 'user rand', '(760) 760-2707', '', '', '::1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `staff_id_2` (`staff_id`);

--
-- Chỉ mục cho bảng `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nailtype`
--
ALTER TABLE `nailtype`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Chỉ mục cho bảng `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT cho bảng `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `header`
--
ALTER TABLE `header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `nailtype`
--
ALTER TABLE `nailtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `nailtype` (`id`),
  ADD CONSTRAINT `services_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
