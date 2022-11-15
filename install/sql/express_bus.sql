-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2019 a las 00:26:21
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `buses`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch`
--

CREATE TABLE `branch` (
  `id_locations` int(3) NOT NULL,
  `city` varchar(20) NOT NULL,
  `operating_branch` char(2) NOT NULL,
  `address_branch` varchar(30) NOT NULL,
  `phone_branch` int(15) NOT NULL,
  `register_branch` date NOT NULL,
  `emp_autorized` char(2) NOT NULL,
  `order_travel` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `branch`
--

INSERT INTO `branch` (`id_locations`, `city`, `operating_branch`, `address_branch`, `phone_branch`, `register_branch`, `emp_autorized`, `order_travel`) VALUES
(1, 'Default', 'si', 'Default Terminal', 10256487, '2012-11-01', 'si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buses`
--

CREATE TABLE `buses` (
  `id_bus` int(6) NOT NULL,
  `num_places` int(2) NOT NULL,
  `category` int(5) NOT NULL,
  `operating` char(2) NOT NULL,
  `description` varchar(15) NOT NULL,
  `image` char(2) NOT NULL,
  `id_model` int(3) NOT NULL,
  `registration` date NOT NULL,
  `enrrollment` varchar(10) NOT NULL,
  `url_image` varchar(80) NOT NULL,
  `type` char(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `buses`
--

INSERT INTO `buses` (`id_bus`, `num_places`, `category`, `operating`, `description`, `image`, `id_model`, `registration`, `enrrollment`, `url_image`, `type`) VALUES
(2545, 47, 2, 'si', 'Panoramico', 'no', 1, '2012-11-01', 'PQ-542', 'no', 'pp'),
(2030, 48, 3, 'si', 'Normal', 'no', 2, '2012-11-01', 'KP-754', 'no', 'mp'),
(2725, 47, 2, 'si', 'Panoramico', 'no', 3, '2012-11-01', 'PL-142', 'no', 'pp'),
(2630, 56, 4, 'si', 'Normal', 'no', 4, '2012-11-01', 'KK-254', 'no', 'pp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buses_temp`
--

CREATE TABLE `buses_temp` (
  `num_temp` int(20) NOT NULL,
  `id_bus` int(6) NOT NULL,
  `dates` date NOT NULL,
  `place` int(2) NOT NULL,
  `status` char(1) NOT NULL,
  `destination` int(2) NOT NULL,
  `hour` time NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `in_branch` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bus_for_user`
--

CREATE TABLE `bus_for_user` (
  `num_buses` int(15) UNSIGNED NOT NULL,
  `id_bus` int(6) NOT NULL,
  `places` int(2) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `week` date NOT NULL,
  `time_exit` time NOT NULL,
  `model` char(5) NOT NULL,
  `operating` char(2) NOT NULL,
  `close` char(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_rooms`
--

CREATE TABLE `chat_rooms` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `numofuser` int(10) NOT NULL,
  `file` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `chat_rooms`
--

INSERT INTO `chat_rooms` (`id`, `name`, `numofuser`, `file`) VALUES
(1, 'Boletos', 0, 'chatroom-buses.txt'),
(3, 'Informacion', 0, 'chatroom-info.txt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_users`
--

CREATE TABLE `chat_users` (
  `id` tinyint(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `time_mod` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_users_rooms`
--

CREATE TABLE `chat_users_rooms` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `room` varchar(100) NOT NULL,
  `mod_time` int(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `dni_client` int(10) NOT NULL,
  `names` varchar(25) NOT NULL,
  `last_names` varchar(30) NOT NULL,
  `num_travelers` int(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_mp`
--

CREATE TABLE `config_mp` (
  `num_conf` int(11) NOT NULL,
  `id_buses` int(6) NOT NULL,
  `dates` date NOT NULL,
  `operator` char(1) NOT NULL,
  `user_name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinations_bus`
--

CREATE TABLE `destinations_bus` (
  `num_des` int(6) NOT NULL,
  `des_name` varchar(20) NOT NULL,
  `num_bus` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_libs`
--

CREATE TABLE `gen_libs` (
  `id_models` int(3) NOT NULL,
  `name_lib` char(4) NOT NULL,
  `mode` char(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gen_libs`
--

INSERT INTO `gen_libs` (`id_models`, `name_lib`, `mode`) VALUES
(1, 'md-1', 'pp'),
(2, 'md-2', 'mp'),
(3, 'md-3', 'pp'),
(4, 'md-4', 'pp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `global_config`
--

CREATE TABLE `global_config` (
  `company_name` varchar(30) NOT NULL,
  `installed` date NOT NULL,
  `active_system` char(2) NOT NULL,
  `message_sys_off` varchar(128) NOT NULL,
  `type_money` char(4) NOT NULL,
  `id_print` int(3) NOT NULL,
  `ver_sis` char(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `global_config`
--

INSERT INTO `global_config` (`company_name`, `installed`, `active_system`, `message_sys_off`, `type_money`, `id_print`, `ver_sis`) VALUES
('Expreso Panamericano', '2019-10-18', 'no', 'El sistema esta desactivado por razones de mantenimiento', 'Peso', 1, '2.0.1 Be');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id_event` int(10) UNSIGNED NOT NULL,
  `register_time` datetime NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `nam_locations` varchar(20) NOT NULL,
  `event` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mails`
--

CREATE TABLE `mails` (
  `id_mail` int(10) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `file_send` char(2) DEFAULT NULL,
  `read_men` char(2) DEFAULT NULL,
  `remit` varchar(20) NOT NULL,
  `date_send` date NOT NULL,
  `message` text NOT NULL,
  `destin` varchar(20) NOT NULL,
  `mail_location` int(3) NOT NULL,
  `recycling` char(2) NOT NULL,
  `url_archive` varchar(100) DEFAULT NULL,
  `size_file` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paging_settings`
--

CREATE TABLE `paging_settings` (
  `id_user` varchar(20) NOT NULL,
  `views` int(3) NOT NULL,
  `view_date` date NOT NULL,
  `view_date_to` date NOT NULL,
  `nam_loc` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paging_settings`
--

INSERT INTO `paging_settings` (`id_user`, `views`, `view_date`, `view_date_to`, `nam_loc`) VALUES
('admin', 10, '2019-10-18', '2019-10-18', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `record_customers_buses`
--

CREATE TABLE `record_customers_buses` (
  `num_travel` int(14) UNSIGNED NOT NULL,
  `date_travel` date NOT NULL,
  `time_travel` time NOT NULL,
  `place` int(2) NOT NULL,
  `bus_travel` int(6) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `traveled_to` varchar(20) NOT NULL,
  `payment` int(6) NOT NULL,
  `user_emited` varchar(20) NOT NULL,
  `date_register` date NOT NULL,
  `dni_client` int(10) NOT NULL,
  `confirm_pay` char(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sunrise`
--

CREATE TABLE `sunrise` (
  `num_hr` int(6) NOT NULL,
  `hrs` time NOT NULL,
  `num_buses` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `template_prints`
--

CREATE TABLE `template_prints` (
  `id_prints` int(3) NOT NULL,
  `template_name` varchar(20) NOT NULL,
  `installed` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `template_prints`
--

INSERT INTO `template_prints` (`id_prints`, `template_name`, `installed`) VALUES
(1, 'default_tickets', '2012-11-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_name` varchar(20) NOT NULL,
  `name_user` varchar(20) NOT NULL,
  `name_user1` varchar(20) NOT NULL,
  `name_user2` varchar(20) DEFAULT NULL,
  `address_user` varchar(32) NOT NULL,
  `phone_user` int(15) NOT NULL,
  `email` varchar(35) NOT NULL,
  `id_location` int(3) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `dni` int(8) NOT NULL,
  `level` char(2) NOT NULL,
  `registered_user` date NOT NULL,
  `points` int(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_name`, `name_user`, `name_user1`, `name_user2`, `address_user`, `phone_user`, `email`, `id_location`, `pass`, `dni`, `level`, `registered_user`, `points`) VALUES
('admin', 'administrador', 'admin', 'null', 'desconocido', 123456, 'admin@gmail.com', 1, '202cb962ac59075b964b07152d234b70', 123456, 'sa', '2019-10-18', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_online`
--

CREATE TABLE `users_online` (
  `id_user` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `type` char(2) NOT NULL,
  `entry` datetime NOT NULL,
  `points` int(7) NOT NULL,
  `registered` date NOT NULL,
  `show_name` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id_locations`);

--
-- Indices de la tabla `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id_bus`);

--
-- Indices de la tabla `buses_temp`
--
ALTER TABLE `buses_temp`
  ADD PRIMARY KEY (`num_temp`);

--
-- Indices de la tabla `bus_for_user`
--
ALTER TABLE `bus_for_user`
  ADD PRIMARY KEY (`num_buses`);

--
-- Indices de la tabla `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chat_users`
--
ALTER TABLE `chat_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `chat_users_rooms`
--
ALTER TABLE `chat_users_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`dni_client`);

--
-- Indices de la tabla `config_mp`
--
ALTER TABLE `config_mp`
  ADD PRIMARY KEY (`num_conf`);

--
-- Indices de la tabla `destinations_bus`
--
ALTER TABLE `destinations_bus`
  ADD PRIMARY KEY (`num_des`);

--
-- Indices de la tabla `gen_libs`
--
ALTER TABLE `gen_libs`
  ADD PRIMARY KEY (`id_models`);

--
-- Indices de la tabla `global_config`
--
ALTER TABLE `global_config`
  ADD PRIMARY KEY (`company_name`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_event`);

--
-- Indices de la tabla `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id_mail`);

--
-- Indices de la tabla `paging_settings`
--
ALTER TABLE `paging_settings`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `record_customers_buses`
--
ALTER TABLE `record_customers_buses`
  ADD PRIMARY KEY (`num_travel`);

--
-- Indices de la tabla `sunrise`
--
ALTER TABLE `sunrise`
  ADD PRIMARY KEY (`num_hr`);

--
-- Indices de la tabla `template_prints`
--
ALTER TABLE `template_prints`
  ADD PRIMARY KEY (`id_prints`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_name`);

--
-- Indices de la tabla `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `branch`
--
ALTER TABLE `branch`
  MODIFY `id_locations` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `buses_temp`
--
ALTER TABLE `buses_temp`
  MODIFY `num_temp` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bus_for_user`
--
ALTER TABLE `bus_for_user`
  MODIFY `num_buses` int(15) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chat_rooms`
--
ALTER TABLE `chat_rooms`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `chat_users`
--
ALTER TABLE `chat_users`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `chat_users_rooms`
--
ALTER TABLE `chat_users_rooms`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1497;

--
-- AUTO_INCREMENT de la tabla `config_mp`
--
ALTER TABLE `config_mp`
  MODIFY `num_conf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `destinations_bus`
--
ALTER TABLE `destinations_bus`
  MODIFY `num_des` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gen_libs`
--
ALTER TABLE `gen_libs`
  MODIFY `id_models` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id_event` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mails`
--
ALTER TABLE `mails`
  MODIFY `id_mail` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `record_customers_buses`
--
ALTER TABLE `record_customers_buses`
  MODIFY `num_travel` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sunrise`
--
ALTER TABLE `sunrise`
  MODIFY `num_hr` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `template_prints`
--
ALTER TABLE `template_prints`
  MODIFY `id_prints` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
