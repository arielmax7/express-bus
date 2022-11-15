# $Id: express_bus_tickets.sql 677 2012-11-25 02:13:29Z arielmax $

#
# Table structure for table `branch`
#

DROP TABLE IF EXISTS `branch`;

CREATE TABLE `branch` (
  `id_locations` int(3) NOT NULL auto_increment,
  `city` varchar(20) NOT NULL,
  `operating_branch` char(2) NOT NULL,
  `address_branch` varchar(30) NOT NULL,
  `phone_branch` int(15) NOT NULL,
  `register_branch` date NOT NULL,
  `emp_autorized` char(2) NOT NULL,
  `order_travel` int(2) NOT NULL,
  PRIMARY KEY  (`id_locations`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

#
# Dumping data for table `branch`
#

INSERT INTO `branch` VALUES (1, 'Default', 'si', 'Default Terminal', 10256487, '2012-11-01', 'si', 1);

#
# Table structure for table `buses`
#

DROP TABLE IF EXISTS `buses`;

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
  `type` char(2) NOT NULL,
  PRIMARY KEY  (`id_bus`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Dumping data for table `buses`
#

INSERT INTO `buses` VALUES (2545, 47, 2, 'si', 'Panoramico', 'no', 1, '2012-11-01', 'PQ-542', 'no', 'pp');
INSERT INTO `buses` VALUES (2030, 48, 3, 'si', 'Normal', 'no', 2, '2012-11-01', 'KP-754', 'no', 'mp');
INSERT INTO `buses` VALUES (2725, 47, 2, 'si', 'Panoramico', 'no', 3, '2012-11-01', 'PL-142', 'no', 'pp');
INSERT INTO `buses` VALUES (2630, 56, 4, 'si', 'Normal', 'no', 4, '2012-11-01', 'KK-254', 'no', 'pp');


#
# Table structure for table `buses_temp`
#

DROP TABLE IF EXISTS `buses_temp`;

CREATE TABLE `buses_temp` (
  `num_temp` int(20) NOT NULL auto_increment,
  `id_bus` int(6) NOT NULL,
  `dates` date NOT NULL,
  `place` int(2) NOT NULL,
  `status` char(1) NOT NULL,
  `destination` int(2) NOT NULL,
  `hour` time NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `in_branch` int(2) NOT NULL,
  PRIMARY KEY  (`num_temp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

#
# Table structure for table `bus_for_user`
#

DROP TABLE IF EXISTS `bus_for_user`;

CREATE TABLE `bus_for_user` (
  `num_buses` int(15) unsigned NOT NULL auto_increment,
  `id_bus` int(6) NOT NULL,
  `places` int(2) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `week` date NOT NULL,
  `time_exit` time NOT NULL,
  `model` char(5) NOT NULL,
  `operating` char(2) NOT NULL,
  `close` char(2) NOT NULL,
  PRIMARY KEY  (`num_buses`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

#
# Table structure for table `chat_rooms`
#

DROP TABLE IF EXISTS `chat_rooms`;

CREATE TABLE `chat_rooms` (
  `id` tinyint(4) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `numofuser` int(10) NOT NULL,
  `file` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

#
# Dumping data for table `chat_rooms`
#

INSERT INTO `chat_rooms` VALUES (1, 'Boletos', 0, 'chatroom-buses.txt');
INSERT INTO `chat_rooms` VALUES (3, 'Informacion', 0, 'chatroom-info.txt');

# --------------------------------------------------------

#
# Table structure for table `chat_users`
#

DROP TABLE IF EXISTS `chat_users`;

CREATE TABLE `chat_users` (
  `id` tinyint(10) NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `time_mod` int(100) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

#
# Table structure for table `chat_users_rooms`
#

DROP TABLE IF EXISTS `chat_users_rooms`;

CREATE TABLE `chat_users_rooms` (
  `id` int(100) NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `room` varchar(100) NOT NULL,
  `mod_time` int(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1497 ;

#
# Table structure for table `clients`
#

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `dni_client` int(10) NOT NULL,
  `names` varchar(25) NOT NULL,
  `last_names` varchar(30) NOT NULL,
  `num_travelers` int(7) NOT NULL,
  PRIMARY KEY  (`dni_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Table structure for table `config_mp`
#

DROP TABLE IF EXISTS `config_mp`;

CREATE TABLE `config_mp` (
  `num_conf` int(11) NOT NULL auto_increment,
  `id_buses` int(6) NOT NULL,
  `dates` date NOT NULL,
  `operator` char(1) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  PRIMARY KEY  (`num_conf`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

#
# Table structure for table `destinations_bus`
#

DROP TABLE IF EXISTS `destinations_bus`;

CREATE TABLE `destinations_bus` (
  `num_des` int(6) NOT NULL auto_increment,
  `des_name` varchar(20) NOT NULL,
  `num_bus` int(6) NOT NULL,
  PRIMARY KEY  (`num_des`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

#
# Table structure for table `gen_libs`
#

DROP TABLE IF EXISTS `gen_libs`;

CREATE TABLE `gen_libs` (
  `id_models` int(3) NOT NULL auto_increment,
  `name_lib` char(4) NOT NULL,
  `mode` char(2) NOT NULL,
  PRIMARY KEY  (`id_models`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

#
# Dumping data for table `en_libs`
#

INSERT INTO `gen_libs` VALUES (1, 'md-1', 'pp');
INSERT INTO `gen_libs` VALUES (2, 'md-2', 'mp');
INSERT INTO `gen_libs` VALUES (3, 'md-3', 'pp');
INSERT INTO `gen_libs` VALUES (4, 'md-4', 'pp');


# --------------------------------------------------------

#
# Table structure for table `global_config`
#

DROP TABLE IF EXISTS `global_config`;

CREATE TABLE `global_config` (
  `company_name` varchar(30) NOT NULL,
  `installed` date NOT NULL,
  `active_system` char(2) NOT NULL,
  `message_sys_off` varchar(128) NOT NULL,
  `type_money` char(4) NOT NULL,
  `id_print` int(3) NOT NULL,
  `ver_sis` char(8) NOT NULL,
  PRIMARY KEY  (`company_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Table structure for table `logs`
#

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id_event` int(10) unsigned NOT NULL auto_increment,
  `register_time` datetime NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `nam_locations` varchar(20) NOT NULL,
  `event` varchar(128) NOT NULL,
  PRIMARY KEY  (`id_event`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

#
# Table structure for table `mails`
#

DROP TABLE IF EXISTS `mails`;

CREATE TABLE `mails` (
  `id_mail` int(10) NOT NULL auto_increment,
  `subject` varchar(30) NOT NULL,
  `file_send` char(2) default NULL,
  `read_men` char(2) default NULL,
  `remit` varchar(20) NOT NULL,
  `date_send` date NOT NULL,
  `message` text NOT NULL,
  `destin` varchar(20) NOT NULL,
  `mail_location` int(3) NOT NULL,
  `recycling` char(2) NOT NULL,
  `url_archive` varchar(100) default NULL,
  `size_file` varchar(20) default NULL,
  PRIMARY KEY  (`id_mail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

#
# Table structure for table `paging_settings`
#

DROP TABLE IF EXISTS `paging_settings`;

CREATE TABLE `paging_settings` (
  `id_user` varchar(20) NOT NULL,
  `views` int(3) NOT NULL,
  `view_date` date NOT NULL,
  `view_date_to` date NOT NULL,
  `nam_loc` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Table structure for table `record_customers_buses`
#

DROP TABLE IF EXISTS `record_customers_buses`;

CREATE TABLE `record_customers_buses` (
  `num_travel` int(14) unsigned NOT NULL auto_increment,
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
  `confirm_pay` char(2) NOT NULL,
  PRIMARY KEY  (`num_travel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

#
# Table structure for table `sunrise`
#

DROP TABLE IF EXISTS `sunrise`;

CREATE TABLE `sunrise` (
  `num_hr` int(6) NOT NULL auto_increment,
  `hrs` time NOT NULL,
  `num_buses` int(6) NOT NULL,
  PRIMARY KEY  (`num_hr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

#
# Table structure for table `template_prints`
#

DROP TABLE IF EXISTS `template_prints`;

CREATE TABLE `template_prints` (
  `id_prints` int(3) NOT NULL auto_increment,
  `template_name` varchar(20) NOT NULL,
  `installed` date NOT NULL,
  PRIMARY KEY  (`id_prints`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

#
# Dumping data for table `template_prints`
#

INSERT INTO `template_prints` VALUES (1, 'default_tickets', '2012-11-01');

# --------------------------------------------------------

#
# Table structure for table `users`
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_name` varchar(20) NOT NULL,
  `name_user` varchar(20) NOT NULL,
  `name_user1` varchar(20) NOT NULL,
  `name_user2` varchar(20) default NULL,
  `address_user` varchar(32) NOT NULL,
  `phone_user` int(15) NOT NULL,
  `email` varchar(35) NOT NULL,
  `id_location` int(3) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `dni` int(8) NOT NULL,
  `level` char(2) NOT NULL,
  `registered_user` date NOT NULL,
  `points` int(7) NOT NULL,
  PRIMARY KEY  (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_name`, `name_user`, `name_user1`, `name_user2`, `address_user`, `phone_user`, `email`, `id_location`, `pass`, `dni`, `level`, `registered_user`, `points`) VALUES
('admin', 'admin', 'admin2', 'null', 'terminal central', 11111111, 'admin@admin.com', 1, '202cb962ac59075b964b07152d234b70', 1111111, 'sa', '2016-06-10', 0);

#
# Table structure for table `users_online`
#

DROP TABLE IF EXISTS `users_online`;

CREATE TABLE `users_online` (
  `id_user` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `type` char(2) NOT NULL,
  `entry` datetime NOT NULL,
  `points` int(7) NOT NULL,
  `registered` date NOT NULL,
  `show_name` varchar(25) NOT NULL,
  PRIMARY KEY  (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;