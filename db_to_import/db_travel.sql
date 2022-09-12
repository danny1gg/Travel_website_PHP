-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: sept. 12, 2022 la 09:20 PM
-- Versiune server: 10.4.17-MariaDB
-- Versiune PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `db_travel`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `purchased_hotels`
--

CREATE TABLE `purchased_hotels` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(225) NOT NULL,
  `hotel_name` varchar(225) NOT NULL,
  `hotel_country` varchar(225) NOT NULL,
  `hotel_capital` varchar(225) NOT NULL,
  `hotel_check_in` varchar(20) NOT NULL,
  `hotel_check_out` varchar(20) NOT NULL,
  `hotel_nights` varchar(50) NOT NULL,
  `hotel_travelers` varchar(50) NOT NULL,
  `hotel_price` int(11) NOT NULL,
  `flight_company` varchar(30) NOT NULL,
  `flight_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `purchased_hotels`
--

INSERT INTO `purchased_hotels` (`id`, `user_id`, `user_email`, `hotel_name`, `hotel_country`, `hotel_capital`, `hotel_check_in`, `hotel_check_out`, `hotel_nights`, `hotel_travelers`, `hotel_price`, `flight_company`, `flight_price`, `total_price`) VALUES
(79, 0, 'danny@yahoo.com', 'Hotel  Palace  Bucuresti 90', 'Romania', 'Bucuresti', '2022-09-12', '2022-09-16', '4 nights', '1 guest', 109, 'Wizzair', 224, 660),
(80, 0, 'daniel@yahoo.com', 'Hotel  Palace  Santiago de Chile 10', 'Chile', 'Santiago de Chile', '2022-09-14', '2022-09-16', '2 nights', '1 guest', 29, 'Quatar airlines', 144, 202),
(81, 0, 'daniel@yahoo.com', 'Hotel  Palace  Reykjavík 50', 'Iceland', 'Reykjavík', '2022-09-14', '2022-09-16', '2 nights', '1 guest', 69, 'Ryanair', 184, 322);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(225) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `country` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `birth_date` varchar(1000) NOT NULL,
  `created_date` int(11) NOT NULL,
  `profile_picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `country`, `password`, `account_type`, `birth_date`, `created_date`, `profile_picture`) VALUES
(6, 'dd', 'dd', 'dd@dd.dd', 'dd', '$2y$12$5tLycJCKHTg4lyK/qxoJZ.Fw2PnMGzdSkir.o3O.CzosMcoKUNg2i', 'Traveler', '2022-09-01', 1662677438, 'imgs/profile_pic_default.png'),
(18, 'Daniel', 'Danny', 'd@d.d', 'd', '$2y$12$5tLycJCKHTg4lyK/qxoJZ.Fw2PnMGzdSkir.o3O.CzosMcoKUNg2i', 'Traveler', '2022-09-02', 1662737320, 'imgs/profile_pic_default.png'),
(19, 'Danny', 'dani', 'danny@yahoo.com', 'Romania', '$2y$12$7tADSh9DjkZ8y/RxtXqux.bu0/S.J24w9wWXApJojzgcLmh5ZbJpe', 'Traveler', '1990-01-01', 1662737320, 'imgs/profile_pic_default.png'),
(26, 'z', 'z', 'z@z.com', 'z', '$2y$12$r9D9vFEcN2TRGj1tOpAl6e9JQsq7fLSKc8tjyItMjgncQP6Tmcq9S', 'Traveler', '2022-09-02', 1662815197, 'imgs/profile_pic_default.png'),
(30, 'Daniel', 'name', 'daniel@yahoo.com', 'Romania', '$2y$12$OEfeRQviyrFeEYii4VZmcemSJVTKWxEucpoEZ6EnKz2hKKpApvhaK', 'Traveler', '1990-01-01', 1663009054, 'imgs/profile_pic_default.png');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `purchased_hotels`
--
ALTER TABLE `purchased_hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `purchased_hotels`
--
ALTER TABLE `purchased_hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
