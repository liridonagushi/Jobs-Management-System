-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for jbms
CREATE DATABASE IF NOT EXISTS `jbms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `jbms`;


-- Dumping structure for table jbms.admin_levels
CREATE TABLE IF NOT EXISTS `admin_levels` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `admin_level` char(50) DEFAULT NULL,
  PRIMARY KEY (`id_level`),
  UNIQUE KEY `id_level` (`id_level`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.admin_levels: 3 rows
/*!40000 ALTER TABLE `admin_levels` DISABLE KEYS */;
INSERT IGNORE INTO `admin_levels` (`id_level`, `admin_level`) VALUES
	(1, 'Admin'),
	(2, 'Employer'),
	(3, 'Employee');
/*!40000 ALTER TABLE `admin_levels` ENABLE KEYS */;


-- Dumping structure for table jbms.adresses
CREATE TABLE IF NOT EXISTS `adresses` (
  `id_adress` int(11) NOT NULL AUTO_INCREMENT,
  `adress` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_adress`),
  UNIQUE KEY `id_adress` (`id_adress`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.adresses: 8 rows
/*!40000 ALTER TABLE `adresses` DISABLE KEYS */;
INSERT IGNORE INTO `adresses` (`id_adress`, `adress`, `city`, `postal_code`, `id_country`) VALUES
	(1, 'nbvnbv', 'nbvnbvnbv', '34243243', 5),
	(2, 'nbvmnbbm', 'mnbvmnbv', 'bnmmnbv', 17),
	(3, 'nbvnbvccvb', 'vcnb', 'vcnb', 18),
	(4, 'vcbbvcbvc', 'bvcbvcbvc', '543543', 3),
	(5, 'vcbbvcbvc', 'bvcbvcbvc', '543543', 3),
	(6, 'vcbbvcbvc', 'bvcbvcbvc', '543543', 3),
	(7, 'S.D. Susaja', 'Presevo', '17523', 192),
	(8, 'vcbbvcbvc', 'bvcbvcbvc', '543543', 3);
/*!40000 ALTER TABLE `adresses` ENABLE KEYS */;


-- Dumping structure for table jbms.banned_users
CREATE TABLE IF NOT EXISTS `banned_users` (
  `id_ban` int(11) NOT NULL AUTO_INCREMENT,
  `ban_period_days` int(11) DEFAULT NULL,
  `ban_date` date DEFAULT NULL,
  `ban_toDate` date DEFAULT NULL,
  `id_user_banned` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ban`),
  UNIQUE KEY `id_ban_user` (`id_user_banned`)
) ENGINE=MyISAM DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

-- Dumping data for table jbms.banned_users: 0 rows
/*!40000 ALTER TABLE `banned_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `banned_users` ENABLE KEYS */;


-- Dumping structure for table jbms.category_expertises
CREATE TABLE IF NOT EXISTS `category_expertises` (
  `id_cat_expertise` int(11) NOT NULL AUTO_INCREMENT,
  `en_expertise_category` varchar(80) DEFAULT NULL,
  `de_expertise_category` varchar(80) DEFAULT NULL,
  `fr_expertise_category` varchar(80) DEFAULT NULL,
  `it_expertise_category` varchar(80) DEFAULT NULL,
  `rs_expertise_category` varchar(80) DEFAULT NULL,
  `al_expertise_category` varchar(80) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cat_expertise`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.category_expertises: 21 rows
/*!40000 ALTER TABLE `category_expertises` DISABLE KEYS */;
INSERT IGNORE INTO `category_expertises` (`id_cat_expertise`, `en_expertise_category`, `de_expertise_category`, `fr_expertise_category`, `it_expertise_category`, `rs_expertise_category`, `al_expertise_category`, `active`) VALUES
	(1, 'Industry', 'Industrie', 'Industrie', 'Industria', 'Industrija', 'Industri', 1),
	(2, 'Technology', 'Technologie', 'Technologie', 'Tecnologia', 'Tehnologija', 'Teknologji', 1),
	(3, 'Informatics', 'Informatik', 'Informatique', 'Informatica', 'Informatika', 'Informatikë', 1),
	(4, 'Pharmacy', 'Apotheke', 'Pharmacie', 'Farmacia', 'Apoteka', 'Farmaci', 1),
	(5, 'Medicine', 'Medizin', 'Médecine', 'Medicina', 'Medicina', 'Medicinë', 1),
	(6, 'Teacher', 'Lehrer', 'Professeur', 'Insegnante', 'Učitelj', 'Mësues', 1),
	(7, ' Finance & Investment', 'Finance & Investment', 'Finance & Investissement', 'Finance & Investment', 'Finansije & investicije', 'Finance & Investim', 1),
	(8, 'Transportation', 'Transport', 'Transport', 'Transport', 'Transport', 'Transport', 1),
	(9, 'Insurance', 'Versicherung', 'Assurance', 'Assicurazione', 'Osiguranje', 'Sigurim', 1),
	(10, 'Education', 'Ausbildung', 'Éducation', 'Educazione', 'Obrazovanje', 'Edukim', 1),
	(11, 'Data/Technology', 'Daten / Technologie', 'Données / Technologie', 'Dati / Tecnologia', 'Podaci / Tehnologija', 'Data / Teknologji', 1),
	(12, 'Healthcare', 'Gesundheitswesen', 'Soins de santé', 'Assistenza sanitaria', 'Zdravstvena zaštita', 'Kujdesi shëndetësor', 1),
	(13, 'Energy', 'Energie', 'Énergie', 'Energia', 'Energija', 'Energji', 1),
	(14, ' Research & Consulting', 'Forschung & Beratung', 'Etudes & Conseils', 'Ricerche e Consulenze', 'Istraživanje i konsalting', 'Hulumtime & Konsulencë', 0),
	(15, ' Lifestyle & Consumer', ' Lifestyle & Consumer', ' Lifestyle & Consumer', ' Lifestyle & Consumer', ' Lifestyle & Consumer', ' Lifestyle & Consumer', 1),
	(16, 'Governance', 'Governance', 'Gouvernance', 'Governance', 'vladavina', 'Qeverisje', 1),
	(18, 'Food & Agriculture', 'Essen & Landwirtschaft', 'Alimentation & Agriculture', 'Alimentazione e l\'Agricoltura', 'Hrana i poljoprivreda', 'Ushqim & Bujqësi', 1),
	(19, 'Scientific Research', 'Wissenschaftliche Forschung', 'Recherche scientifique', 'Ricerca scientifica', 'Naučna istraživanja', 'Kërkimi shkencor', 1),
	(20, 'Media', 'Medien', 'Médias', 'Media', 'Media', 'Media', 1),
	(21, 'Oil and Gas', 'Öl und Gas', 'Pétrole et gaz', 'Olio e gas', 'Nafte i gasa', 'Naftë dhe Gaz', 1),
	(27, 'Super market', 'Supermarkt', 'Supermarché', 'Supermercato', 'Super market', 'Super market', 1);
/*!40000 ALTER TABLE `category_expertises` ENABLE KEYS */;


-- Dumping structure for table jbms.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `id_company` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat_expertise` int(11) DEFAULT NULL,
  `id_employer` varchar(50) DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `company_sn` varchar(50) DEFAULT NULL,
  `logo_img` varchar(20) DEFAULT NULL,
  `number_employees` int(11) DEFAULT NULL COMMENT 'Maximum Number of Employees Working',
  `phone_number` varchar(20) DEFAULT NULL,
  `id_adress` int(11) DEFAULT NULL,
  `company_description` varchar(200) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_company`),
  UNIQUE KEY `id_company` (`id_company`),
  UNIQUE KEY `SN` (`company_sn`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.companies: 1 rows
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT IGNORE INTO `companies` (`id_company`, `id_cat_expertise`, `id_employer`, `company_name`, `company_sn`, `logo_img`, `number_employees`, `phone_number`, `id_adress`, `company_description`, `active`) VALUES
	(1, 11, '67', 'Dot Rond', 'Dot1', '67540.png', 1, '0638002549', 7, 'Informatics, Development, Programming', 1);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;


-- Dumping structure for table jbms.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `country_name` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id_country`)
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

-- Dumping data for table jbms.countries: 246 rows
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT IGNORE INTO `countries` (`id_country`, `country_code`, `country_name`) VALUES
	(1, 'AF', 'Afghanistan'),
	(2, 'AL', 'Albania'),
	(3, 'DZ', 'Algeria'),
	(4, 'DS', 'American Samoa'),
	(5, 'AD', 'Andorra'),
	(6, 'AO', 'Angola'),
	(7, 'AI', 'Anguilla'),
	(8, 'AQ', 'Antarctica'),
	(9, 'AG', 'Antigua and Barbuda'),
	(10, 'AR', 'Argentina'),
	(11, 'AM', 'Armenia'),
	(12, 'AW', 'Aruba'),
	(13, 'AU', 'Australia'),
	(14, 'AT', 'Austria'),
	(15, 'AZ', 'Azerbaijan'),
	(16, 'BS', 'Bahamas'),
	(17, 'BH', 'Bahrain'),
	(18, 'BD', 'Bangladesh'),
	(19, 'BB', 'Barbados'),
	(20, 'BY', 'Belarus'),
	(21, 'BE', 'Belgium'),
	(22, 'BZ', 'Belize'),
	(23, 'BJ', 'Benin'),
	(24, 'BM', 'Bermuda'),
	(25, 'BT', 'Bhutan'),
	(26, 'BO', 'Bolivia'),
	(27, 'BA', 'Bosnia and Herzegovina'),
	(28, 'BW', 'Botswana'),
	(29, 'BV', 'Bouvet Island'),
	(30, 'BR', 'Brazil'),
	(31, 'IO', 'British Indian Ocean Territory'),
	(32, 'BN', 'Brunei Darussalam'),
	(33, 'BG', 'Bulgaria'),
	(34, 'BF', 'Burkina Faso'),
	(35, 'BI', 'Burundi'),
	(36, 'KH', 'Cambodia'),
	(37, 'CM', 'Cameroon'),
	(38, 'CA', 'Canada'),
	(39, 'CV', 'Cape Verde'),
	(40, 'KY', 'Cayman Islands'),
	(41, 'CF', 'Central African Republic'),
	(42, 'TD', 'Chad'),
	(43, 'CL', 'Chile'),
	(44, 'CN', 'China'),
	(45, 'CX', 'Christmas Island'),
	(46, 'CC', 'Cocos (Keeling) Islands'),
	(47, 'CO', 'Colombia'),
	(48, 'KM', 'Comoros'),
	(49, 'CG', 'Congo'),
	(50, 'CK', 'Cook Islands'),
	(51, 'CR', 'Costa Rica'),
	(52, 'HR', 'Croatia (Hrvatska)'),
	(53, 'CU', 'Cuba'),
	(54, 'CY', 'Cyprus'),
	(55, 'CZ', 'Czech Republic'),
	(56, 'DK', 'Denmark'),
	(57, 'DJ', 'Djibouti'),
	(58, 'DM', 'Dominica'),
	(59, 'DO', 'Dominican Republic'),
	(60, 'TP', 'East Timor'),
	(61, 'EC', 'Ecuador'),
	(62, 'EG', 'Egypt'),
	(63, 'SV', 'El Salvador'),
	(64, 'GQ', 'Equatorial Guinea'),
	(65, 'ER', 'Eritrea'),
	(66, 'EE', 'Estonia'),
	(67, 'ET', 'Ethiopia'),
	(68, 'FK', 'Falkland Islands (Malvinas)'),
	(69, 'FO', 'Faroe Islands'),
	(70, 'FJ', 'Fiji'),
	(71, 'FI', 'Finland'),
	(72, 'FR', 'France'),
	(73, 'FX', 'France, Metropolitan'),
	(74, 'GF', 'French Guiana'),
	(75, 'PF', 'French Polynesia'),
	(76, 'TF', 'French Southern Territories'),
	(77, 'GA', 'Gabon'),
	(78, 'GM', 'Gambia'),
	(79, 'GE', 'Georgia'),
	(80, 'DE', 'Germany'),
	(81, 'GH', 'Ghana'),
	(82, 'GI', 'Gibraltar'),
	(83, 'GK', 'Guernsey'),
	(84, 'GR', 'Greece'),
	(85, 'GL', 'Greenland'),
	(86, 'GD', 'Grenada'),
	(87, 'GP', 'Guadeloupe'),
	(88, 'GU', 'Guam'),
	(89, 'GT', 'Guatemala'),
	(90, 'GN', 'Guinea'),
	(91, 'GW', 'Guinea-Bissau'),
	(92, 'GY', 'Guyana'),
	(93, 'HT', 'Haiti'),
	(94, 'HM', 'Heard and Mc Donald Islands'),
	(95, 'HN', 'Honduras'),
	(96, 'HK', 'Hong Kong'),
	(97, 'HU', 'Hungary'),
	(98, 'IS', 'Iceland'),
	(99, 'IN', 'India'),
	(100, 'IM', 'Isle of Man'),
	(101, 'ID', 'Indonesia'),
	(102, 'IR', 'Iran (Islamic Republic of)'),
	(103, 'IQ', 'Iraq'),
	(104, 'IE', 'Ireland'),
	(105, 'IS', 'Israel'),
	(106, 'IT', 'Italy'),
	(107, 'CI', 'Ivory Coast'),
	(108, 'JE', 'Jersey'),
	(109, 'JM', 'Jamaica'),
	(110, 'JP', 'Japan'),
	(111, 'JO', 'Jordan'),
	(112, 'KZ', 'Kazakhstan'),
	(113, 'KE', 'Kenya'),
	(114, 'KI', 'Kiribati'),
	(115, 'KP', 'Korea, Democratic People\'s Republic of'),
	(116, 'KR', 'Korea, Republic of'),
	(117, 'KS', 'Kosovo'),
	(118, 'KW', 'Kuwait'),
	(119, 'KG', 'Kyrgyzstan'),
	(120, 'LA', 'Lao People\'s Democratic Republic'),
	(121, 'LV', 'Latvia'),
	(122, 'LB', 'Lebanon'),
	(123, 'LS', 'Lesotho'),
	(124, 'LR', 'Liberia'),
	(125, 'LY', 'Libyan Arab Jamahiriya'),
	(126, 'LI', 'Liechtenstein'),
	(127, 'LT', 'Lithuania'),
	(128, 'LU', 'Luxembourg'),
	(129, 'MO', 'Macau'),
	(130, 'MK', 'Macedonia'),
	(131, 'MG', 'Madagascar'),
	(132, 'MW', 'Malawi'),
	(133, 'MY', 'Malaysia'),
	(134, 'MV', 'Maldives'),
	(135, 'ML', 'Mali'),
	(136, 'MT', 'Malta'),
	(137, 'MH', 'Marshall Islands'),
	(138, 'MQ', 'Martinique'),
	(139, 'MR', 'Mauritania'),
	(140, 'MU', 'Mauritius'),
	(141, 'TY', 'Mayotte'),
	(142, 'MX', 'Mexico'),
	(143, 'FM', 'Micronesia, Federated States of'),
	(144, 'MD', 'Moldova, Republic of'),
	(145, 'MC', 'Monaco'),
	(146, 'MN', 'Mongolia'),
	(147, 'ME', 'Montenegro'),
	(148, 'MS', 'Montserrat'),
	(149, 'MA', 'Morocco'),
	(150, 'MZ', 'Mozambique'),
	(151, 'MM', 'Myanmar'),
	(152, 'NA', 'Namibia'),
	(153, 'NR', 'Nauru'),
	(154, 'NP', 'Nepal'),
	(155, 'NL', 'Netherlands'),
	(156, 'AN', 'Netherlands Antilles'),
	(157, 'NC', 'New Caledonia'),
	(158, 'NZ', 'New Zealand'),
	(159, 'NI', 'Nicaragua'),
	(160, 'NE', 'Niger'),
	(161, 'NG', 'Nigeria'),
	(162, 'NU', 'Niue'),
	(163, 'NF', 'Norfolk Island'),
	(164, 'MP', 'Northern Mariana Islands'),
	(165, 'NO', 'Norway'),
	(166, 'OM', 'Oman'),
	(167, 'PK', 'Pakistan'),
	(168, 'PW', 'Palau'),
	(169, 'PS', 'Palestine'),
	(170, 'PA', 'Panama'),
	(171, 'PG', 'Papua New Guinea'),
	(172, 'PY', 'Paraguay'),
	(173, 'PE', 'Peru'),
	(174, 'PH', 'Philippines'),
	(175, 'PN', 'Pitcairn'),
	(176, 'PL', 'Poland'),
	(177, 'PT', 'Portugal'),
	(178, 'PR', 'Puerto Rico'),
	(179, 'QA', 'Qatar'),
	(180, 'RE', 'Reunion'),
	(181, 'RO', 'Romania'),
	(182, 'RU', 'Russian Federation'),
	(183, 'RW', 'Rwanda'),
	(184, 'KN', 'Saint Kitts and Nevis'),
	(185, 'LC', 'Saint Lucia'),
	(186, 'VC', 'Saint Vincent and the Grenadines'),
	(187, 'WS', 'Samoa'),
	(188, 'SM', 'San Marino'),
	(189, 'ST', 'Sao Tome and Principe'),
	(190, 'SA', 'Saudi Arabia'),
	(191, 'SN', 'Senegal'),
	(192, 'RS', 'Serbia'),
	(193, 'SC', 'Seychelles'),
	(194, 'SL', 'Sierra Leone'),
	(195, 'SG', 'Singapore'),
	(196, 'SK', 'Slovakia'),
	(197, 'SI', 'Slovenia'),
	(198, 'SB', 'Solomon Islands'),
	(199, 'SO', 'Somalia'),
	(200, 'ZA', 'South Africa'),
	(201, 'GS', 'South Georgia South Sandwich Islands'),
	(202, 'ES', 'Spain'),
	(203, 'LK', 'Sri Lanka'),
	(204, 'SH', 'St. Helena'),
	(205, 'PM', 'St. Pierre and Miquelon'),
	(206, 'SD', 'Sudan'),
	(207, 'SR', 'Suriname'),
	(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
	(209, 'SZ', 'Swaziland'),
	(210, 'SE', 'Sweden'),
	(211, 'CH', 'Switzerland'),
	(212, 'SY', 'Syrian Arab Republic'),
	(213, 'TW', 'Taiwan'),
	(214, 'TJ', 'Tajikistan'),
	(215, 'TZ', 'Tanzania, United Republic of'),
	(216, 'TH', 'Thailand'),
	(217, 'TG', 'Togo'),
	(218, 'TK', 'Tokelau'),
	(219, 'TO', 'Tonga'),
	(220, 'TT', 'Trinidad and Tobago'),
	(221, 'TN', 'Tunisia'),
	(222, 'TR', 'Turkey'),
	(223, 'TM', 'Turkmenistan'),
	(224, 'TC', 'Turks and Caicos Islands'),
	(225, 'TV', 'Tuvalu'),
	(226, 'UG', 'Uganda'),
	(227, 'UA', 'Ukraine'),
	(228, 'AE', 'United Arab Emirates'),
	(229, 'UK', 'United Kingdom'),
	(230, 'US', 'United States'),
	(231, 'UM', 'United States minor outlying islands'),
	(232, 'UY', 'Uruguay'),
	(233, 'UZ', 'Uzbekistan'),
	(234, 'VU', 'Vanuatu'),
	(235, 'VA', 'Vatican City State'),
	(236, 'VE', 'Venezuela'),
	(237, 'VN', 'Vietnam'),
	(238, 'VG', 'Virgin Islands (British)'),
	(239, 'VI', 'Virgin Islands (U.S.)'),
	(240, 'WF', 'Wallis and Futuna Islands'),
	(241, 'EH', 'Western Sahara'),
	(242, 'YE', 'Yemen'),
	(243, 'YU', 'Yugoslavia'),
	(244, 'ZR', 'Zaire'),
	(245, 'ZM', 'Zambia'),
	(246, 'ZW', 'Zimbabwe');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;


-- Dumping structure for table jbms.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `id_currency` int(11) NOT NULL AUTO_INCREMENT,
  `currency` text,
  `symbol` tinytext,
  PRIMARY KEY (`id_currency`),
  UNIQUE KEY `id_currency` (`id_currency`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.currencies: 4 rows
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT IGNORE INTO `currencies` (`id_currency`, `currency`, `symbol`) VALUES
	(1, 'Euro', '€'),
	(2, 'Dollar', '$'),
	(3, 'Pound', '£'),
	(4, 'CHF Franc', 'SFr');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;


-- Dumping structure for table jbms.cv_lm
CREATE TABLE IF NOT EXISTS `cv_lm` (
  `id_cv` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `cv_code` varchar(20) DEFAULT NULL,
  `lm_code` varchar(20) DEFAULT NULL,
  `last_upload` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_cv`),
  UNIQUE KEY `id_cv` (`id_cv`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.cv_lm: 1 rows
/*!40000 ALTER TABLE `cv_lm` DISABLE KEYS */;
INSERT IGNORE INTO `cv_lm` (`id_cv`, `id_user`, `cv_code`, `lm_code`, `last_upload`, `active`) VALUES
	(1, 10, '10593.pdf', '10130.pdf', '2016-10-09 14:45:53', 1);
/*!40000 ALTER TABLE `cv_lm` ENABLE KEYS */;


-- Dumping structure for table jbms.diploma_types
CREATE TABLE IF NOT EXISTS `diploma_types` (
  `id_type_diploma` int(11) NOT NULL AUTO_INCREMENT,
  `en_type_diploma` varchar(50) DEFAULT NULL,
  `de_type_diploma` varchar(50) DEFAULT NULL,
  `fr_type_diploma` varchar(50) DEFAULT NULL,
  `it_type_diploma` varchar(50) DEFAULT NULL,
  `rs_type_diploma` varchar(50) DEFAULT NULL,
  `al_type_diploma` varchar(50) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_type_diploma`),
  UNIQUE KEY `id_diploma` (`id_type_diploma`),
  UNIQUE KEY `en_type_diploma` (`en_type_diploma`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.diploma_types: 16 rows
/*!40000 ALTER TABLE `diploma_types` DISABLE KEYS */;
INSERT IGNORE INTO `diploma_types` (`id_type_diploma`, `en_type_diploma`, `de_type_diploma`, `fr_type_diploma`, `it_type_diploma`, `rs_type_diploma`, `al_type_diploma`, `active`) VALUES
	(2, 'Engineering & Technology', 'Ingenieurwissenschaften', 'Ingénierie & Technologie', 'Ingegneria e tecnologia', 'Inženjering i tehnologija', 'Inxhinieri & Teknologji', 1),
	(3, 'Graphics', 'Grafik', 'Graphique', 'Grafica', 'Grafika', 'Grafikë', 1),
	(4, 'Economics and Administration', 'Wirtschaft und Verwaltung', 'Economie et administration', 'Economia e Amministrazione', 'Ekonomija i administracija', 'Ekonomi dhe Administrimi', 1),
	(6, 'Humanities and Social Sciences', 'Geistes- und Sozialwissenschaften ', 'Sciences humaines et sociales', 'Scienze umane e sociali', 'Humanističke i društvene nauke', 'Shkenca sociale dhe humane', 1),
	(7, 'Business', 'Geschäft', 'Entreprise', 'Commercio', 'Biznis', 'Biznes', 1),
	(8, 'Internet & Technology', 'Internet & Technologie', 'La technologie Internet', 'Internet e Tecnologia', 'Internet i tehnologija', 'Internet & Teknologji', 1),
	(9, 'Tourism and Hospitality', 'Tourismus und Hospitality', 'Le tourisme et l\'hospitalité', 'Turismo e Ospitalità', 'Hoteliersko Turističko', 'Tourism dhe Mirëpritje', 1),
	(10, 'Education', 'Ausbildung', 'Éducation', 'educazione', 'obrazovanje', 'Edukim', 1),
	(11, 'Marketing and Communication', 'Marketing und Kommunikation', 'Marketing et Communication', 'Marketing e Comunicazione', 'Marketing i komunikacije', 'Marketing dhe Komunikim', 1),
	(12, 'Computer Science', 'Computerwissenschaften', 'L\'informatique', 'Scienza del computer', 'Nauka o kompjuterima', 'Shkenca Kompjuterike', 1),
	(13, 'Marketing', 'Marketing', 'Commercialisation', 'Marketing', 'Marketing', 'Marketing', 1),
	(14, 'Food and Beverage Studies', 'Lebensmittel und Getränke Studies', 'Études alimentaires et de boissons', 'Studi alimentari e bevande', 'Hrana i piće studije', 'Studimet ushqim dhe pije', 1),
	(15, 'Mechanical Engineering', 'Maschinenbau', 'Ingénierie mécanique', 'Ingegnere meccanico', 'Mašinstvo', 'Inxhinieri Mekanike', 1),
	(1, 'Business Studies', 'Betriebswirtschaftslehre', 'Études de commerce', 'Studi di settore economico', 'Poslovne studije', 'Studimet e biznesit', 1),
	(16, 'Journalism', 'Journalismus', 'Journalisme', 'Giornalismo', 'novinarstvo', 'gazetari', 1),
	(17, 'General Management', 'Geschäftsleitung', 'Direction générale', 'Gestione generale', 'Opšti menadžment', 'Menaxhimi i përgjithshëm', 1);
/*!40000 ALTER TABLE `diploma_types` ENABLE KEYS */;


-- Dumping structure for table jbms.diploma_users
CREATE TABLE IF NOT EXISTS `diploma_users` (
  `id_diploma_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_level_education` int(11) NOT NULL,
  `id_type_diploma` int(11) NOT NULL,
  `title_diploma` varchar(80) DEFAULT NULL,
  `date_started` varchar(20) DEFAULT NULL,
  `date_finished` varchar(20) DEFAULT NULL,
  `on_load` tinyint(4) DEFAULT '1' COMMENT 'Current Date',
  `active` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_diploma_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.diploma_users: 2 rows
/*!40000 ALTER TABLE `diploma_users` DISABLE KEYS */;
INSERT IGNORE INTO `diploma_users` (`id_diploma_user`, `id_user`, `id_level_education`, `id_type_diploma`, `title_diploma`, `date_started`, `date_finished`, `on_load`, `active`) VALUES
	(1, 10, 2, 2, 'Computer Science', '2016-10-09', '2016-10-09', 0, 0),
	(2, 10, 3, 4, 'nbvnbvnbv', '2016-10-10', '', 1, 0);
/*!40000 ALTER TABLE `diploma_users` ENABLE KEYS */;


-- Dumping structure for table jbms.emails
CREATE TABLE IF NOT EXISTS `emails` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `id_from` int(11) DEFAULT NULL,
  `id_to` int(11) DEFAULT NULL,
  `object_title` varchar(35) DEFAULT NULL,
  `message` longtext,
  `time_message` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `active_employee` tinyint(1) DEFAULT '1',
  `active_employer` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_email`),
  UNIQUE KEY `id_email` (`id_email`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.emails: 17 rows
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT IGNORE INTO `emails` (`id_email`, `id_from`, `id_to`, `object_title`, `message`, `time_message`, `active_employee`, `active_employer`) VALUES
	(1, 67, 10, 'Brooks', ',mcbv,mbvc,m,mbvcbvc', '2016-10-09 14:50:48', 1, 1),
	(2, 67, 10, 'vbnvnbcnvb', 'vbnbvnbvcnbv', '2016-10-09 14:52:04', 1, 1),
	(3, 10, 67, 'vnbnvb', 'nbvcnbvc', '2016-10-09 14:52:29', 1, 1),
	(4, 67, 10, 'nbv', 'nbvnbnbv', '2016-10-09 15:51:04', 1, 1),
	(5, 67, 10, 'bvcbvcbvc', 'bvcbvc', '2016-10-09 15:52:02', 1, 1),
	(6, 67, 10, 'bvcbvcbvc', 'bvcbvc', '2016-10-09 15:52:19', 1, 1),
	(7, 67, 10, 'bvcbvcbvc', 'bvcbvcvcbv', '2016-10-09 15:52:55', 1, 1),
	(8, 67, 10, 'bvcbvcvcbbvc', 'bvccbvbvcbvcbcv', '2016-10-09 15:53:15', 1, 1),
	(9, 67, 10, 'bvcbvc', 'bvcbvcbvc', '2016-10-09 15:54:14', 1, 1),
	(10, 67, 10, 'bvcbvbvcbvcbvc', 'bvcbvcbvcbvcbvcbvc', '2016-10-09 15:54:38', 1, 1),
	(11, 67, 10, 'nbvnbvnbvnbvnbvnbv', 'nbvnbvnbvnbvnbvnbv', '2016-10-09 15:56:13', 1, 1),
	(12, 67, 10, 'bvcbvcbvcbvcbvcbvcbvcbvc', 'bvcbbvcbvcbvc', '2016-10-09 15:59:51', 1, 1),
	(13, 67, 10, 'nbvnbvnbv', 'nbvnnbvnbvnbv', '2016-10-09 16:06:31', 1, 1),
	(14, 67, 10, 'nvbnbvnbv', 'nbvnbvnbvnbv', '2016-10-09 16:15:05', 1, 1),
	(15, 67, 10, 'nbvnbvnbv', 'nbvnbvnbvb', '2016-10-09 16:17:23', 1, 1),
	(16, 67, 10, 'bvcbvcbvbvc', 'bvcbvcbvcvcbvc', '2016-10-09 16:18:17', 1, 1),
	(17, 67, 3, 'bvcbvc', 'bvcbvc', '2016-10-09 16:35:06', 1, 1);
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;


-- Dumping structure for table jbms.expertises
CREATE TABLE IF NOT EXISTS `expertises` (
  `id_expertise` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT NULL,
  `en_expertise_area` varchar(200) DEFAULT NULL,
  `de_expertise_area` varchar(200) DEFAULT NULL,
  `fr_expertise_area` varchar(200) DEFAULT NULL,
  `it_expertise_area` varchar(200) DEFAULT NULL,
  `rs_expertise_area` varchar(200) DEFAULT NULL,
  `al_expertise_area` varchar(200) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_expertise`),
  UNIQUE KEY `id_expertise` (`id_expertise`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.expertises: 1 rows
/*!40000 ALTER TABLE `expertises` DISABLE KEYS */;
INSERT IGNORE INTO `expertises` (`id_expertise`, `id_category`, `en_expertise_area`, `de_expertise_area`, `fr_expertise_area`, `it_expertise_area`, `rs_expertise_area`, `al_expertise_area`, `active`) VALUES
	(1, 3, 'Developer', 'Developer', 'Developer', 'Developer', 'Developer', 'Developer', 1);
/*!40000 ALTER TABLE `expertises` ENABLE KEYS */;


-- Dumping structure for table jbms.genders
CREATE TABLE IF NOT EXISTS `genders` (
  `id_gender` int(11) NOT NULL AUTO_INCREMENT,
  `en_sex` char(50) DEFAULT NULL,
  `de_sex` char(50) DEFAULT NULL,
  `fr_sex` char(50) DEFAULT NULL,
  `it_sex` char(50) DEFAULT NULL,
  `rs_sex` char(50) DEFAULT NULL,
  `al_sex` char(50) DEFAULT NULL,
  PRIMARY KEY (`id_gender`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.genders: 3 rows
/*!40000 ALTER TABLE `genders` DISABLE KEYS */;
INSERT IGNORE INTO `genders` (`id_gender`, `en_sex`, `de_sex`, `fr_sex`, `it_sex`, `rs_sex`, `al_sex`) VALUES
	(1, 'Mr', 'Herr', 'Monsieur\r\n	\r\n', 'Sig', 'Gospodin', 'Zotri'),
	(2, 'Mrs.', 'Frau', 'Madame', 'Signora', 'Gospođa', 'Zonjë'),
	(3, 'Miss', 'Fräulein', 'Mademoiselle', 'Perdere', 'Gospođica', 'Zonjushë');
/*!40000 ALTER TABLE `genders` ENABLE KEYS */;


-- Dumping structure for table jbms.job_candidatures
CREATE TABLE IF NOT EXISTS `job_candidatures` (
  `id_candidature` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Candidatures ppl to companies',
  `id_job` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  `id_company` int(11) DEFAULT NULL,
  `motivation_words` varchar(800) DEFAULT NULL,
  `time_application` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_candidature`),
  UNIQUE KEY `id_candidature` (`id_candidature`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.job_candidatures: 3 rows
/*!40000 ALTER TABLE `job_candidatures` DISABLE KEYS */;
INSERT IGNORE INTO `job_candidatures` (`id_candidature`, `id_job`, `id_employee`, `id_company`, `motivation_words`, `time_application`) VALUES
	(1, 12, 10, 2, 'nbvnbvnbvvcnbvc', '2016-10-09 14:45:59'),
	(2, 11, 10, 2, 'nbvnbvnbvc', '2016-10-09 15:15:02'),
	(3, 1, 10, 1, ' mmnbvmnbmnbmnbmnbmnb', '2016-10-13 01:20:58');
/*!40000 ALTER TABLE `job_candidatures` ENABLE KEYS */;


-- Dumping structure for table jbms.job_offers
CREATE TABLE IF NOT EXISTS `job_offers` (
  `id_job` int(11) NOT NULL AUTO_INCREMENT,
  `job_sn` varchar(10) DEFAULT NULL,
  `job_type` int(11) DEFAULT NULL,
  `id_expertise` tinyint(8) DEFAULT NULL,
  `id_level_experience` tinyint(8) NOT NULL DEFAULT '0',
  `id_level_education` tinyint(8) DEFAULT NULL,
  `id_salary` int(11) DEFAULT NULL,
  `id_company` tinyint(8) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `job_description` varchar(500) DEFAULT NULL,
  `publish_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `start_date` varchar(20) DEFAULT NULL,
  `closing_date` varchar(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_job`),
  UNIQUE KEY `id_job` (`id_job`),
  UNIQUE KEY `job_sn` (`job_sn`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.job_offers: 3 rows
/*!40000 ALTER TABLE `job_offers` DISABLE KEYS */;
INSERT IGNORE INTO `job_offers` (`id_job`, `job_sn`, `job_type`, `id_expertise`, `id_level_experience`, `id_level_education`, `id_salary`, `id_company`, `job_title`, `job_description`, `publish_date`, `start_date`, `closing_date`, `active`) VALUES
	(13, NULL, NULL, 1, 1, 2, 2, 1, 'Agjent Tregtar', 'Kërkohet agjent tregtar në degën e marketingut.\r\n', '2016-10-13 02:11:32', NULL, '2016-11-13', 1),
	(11, NULL, NULL, 1, 1, 3, 3, 2, 'nbvnbv', 'vcnbvcvbnnbvcnbvbvcnbvcn', '2016-10-09 14:25:35', NULL, '2016-11-09', 1),
	(12, NULL, NULL, 1, 1, 1, 2, 2, 'vnbvcnb', 'bvnnbmnbv mnbmnbvnbmvnbmvmnbmnb', '2016-10-09 14:31:00', NULL, '2016-11-09', 1);
/*!40000 ALTER TABLE `job_offers` ENABLE KEYS */;


-- Dumping structure for table jbms.job_rate
CREATE TABLE IF NOT EXISTS `job_rate` (
  `id_rate` int(11) DEFAULT NULL,
  `rate` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.job_rate: 0 rows
/*!40000 ALTER TABLE `job_rate` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_rate` ENABLE KEYS */;


-- Dumping structure for table jbms.job_type
CREATE TABLE IF NOT EXISTS `job_type` (
  `id_job_type` int(11) NOT NULL AUTO_INCREMENT,
  `en_description` varchar(50) DEFAULT NULL,
  `de_description` varchar(50) DEFAULT NULL,
  `fr_description` varchar(50) DEFAULT NULL,
  `it_description` varchar(50) DEFAULT NULL,
  `rs_description` varchar(50) DEFAULT NULL,
  `al_description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_job_type`),
  UNIQUE KEY `id_job_type` (`id_job_type`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.job_type: 3 rows
/*!40000 ALTER TABLE `job_type` DISABLE KEYS */;
INSERT IGNORE INTO `job_type` (`id_job_type`, `en_description`, `de_description`, `fr_description`, `it_description`, `rs_description`, `al_description`) VALUES
	(1, 'Standard', 'Standard', 'Standard', 'Standard', 'Standard', 'Standard'),
	(2, 'Internship', 'Praktikum', 'Stage', 'Tirocinio', 'Internship', 'Internship'),
	(3, 'Temporary Work', 'Zeitarbeit', 'Travail temporaire', 'Lavoro temporaneo', 'Privremeni rad', 'Puna e përkohshme');
/*!40000 ALTER TABLE `job_type` ENABLE KEYS */;


-- Dumping structure for table jbms.languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id_language` int(11) NOT NULL AUTO_INCREMENT,
  `lang_code` varchar(8) DEFAULT NULL,
  `img_code` varchar(20) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_language`),
  UNIQUE KEY `id_language` (`id_language`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.languages: 6 rows
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT IGNORE INTO `languages` (`id_language`, `lang_code`, `img_code`, `language`) VALUES
	(1, 'en', 'flag-icon-en', 'English'),
	(2, 'de', 'flag-icon-de', 'Deutsche'),
	(3, 'fr', 'flag-icon-fr', 'Français'),
	(4, 'it', 'flag-icon-it', 'Italiano'),
	(5, 'rs', 'flag-icon-rs', 'Srpski'),
	(6, 'al', 'flag-icon-al', 'Shqip');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;


-- Dumping structure for table jbms.language_expressions
CREATE TABLE IF NOT EXISTS `language_expressions` (
  `id_lang` int(11) NOT NULL AUTO_INCREMENT,
  `en_expressions` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `de_expressions` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `fr_expressions` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `it_expressions` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rs_expressions` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `al_expressions` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_lang`),
  UNIQUE KEY `id_lang` (`id_lang`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

-- Dumping data for table jbms.language_expressions: ~134 rows (approximately)
/*!40000 ALTER TABLE `language_expressions` DISABLE KEYS */;
INSERT IGNORE INTO `language_expressions` (`id_lang`, `en_expressions`, `de_expressions`, `fr_expressions`, `it_expressions`, `rs_expressions`, `al_expressions`) VALUES
	(1, 'Extended Search', 'Erweiterte Suche', 'Recherche Avance', 'Ricerca Avanzata', 'Detalni Pretraga', 'K&#235rkim i Zgjeruar'),
	(2, 'Inbox', 'Posteingang', 'Boîte de réception', 'Posta in arrivo', 'Primljena Posta', 'Pranuara'),
	(3, 'View All', 'Alle anzeigen', 'Voir tout', 'Guarda tutto', 'Pogledaj sve', 'Shiko t&#235 gjitha'),
	(4, 'Home', 'Home', 'Home', 'Home', 'Home', 'Home'),
	(5, 'Jobs', 'Arbeitsplätze', 'Emplois', 'Lavori', 'Posao', 'Pun&#235t'),
	(6, 'Recent Jobs', 'Aktuelle Jobs', 'Récentes emploi ', 'Lavoro recenti', 'Najnoviji poslovi', 'Pun&#235t e fundit'),
	(7, 'My Candidatures', 'Meine Kandidaturen', 'Mes candidatures', 'Le mie candidature', 'Moja kandidatura', 'Kandidaturat e mia'),
	(8, 'Saved Jobs', 'Gespeicherte Jobs', 'emplois enregistrés', 'Lavori salvati', 'Sacuvani Poslovi', 'Pun&#235t e ruajtura'),
	(9, 'Search Jobs', 'Arbeit suchen', 'Recherche de travail', 'Cerca Lavoro', 'Pretraga Poslovi', 'Pun&#235t e k&#235rkuara'),
	(10, 'Job Title', 'Berufsbezeichnung', 'Titre de l\'emploi', 'Titolo di lavoro', 'Naziv Radnog', 'Titualli Pun&#235s'),
	(11, 'Search', 'Suche', 'Chercher', 'Ricerca', 'Traži', 'K&#235rko'),
	(12, 'RESET', 'Zurückstellen ', 'Réinitialiser', 'Reset', 'Posetovati', 'Reset'),
	(13, 'Job Seeker ', 'Arbeitssuchender', 'Chercheur d\'emploi', 'In cerca di lavoro', 'Trazi Posao', 'K&#235rkues Pune'),
	(14, ' Browse Unlimited Jobs', 'Durchsuchen Sie unbegrenzt Jobs', 'Parcourir les emplois illimités', 'Sfoglia Lavoro illimitati', 'Pogledaj Posao', 'Shfelto Pun&#235t e pafundme'),
	(15, 'Employer', 'Arbeitgeber', 'Employeur', 'Datore di lavoro', 'Poslodavac', 'Pun&#235dh&#235s'),
	(16, ' Browse Qualified Employees ', 'Durchsuchen Qualifizierte Mitarbeiter', 'Parcourir les employés qualifiés', 'Sfoglia personale qualificato', 'Pregledaj kvalifikovani zaposleni', 'Shfleto Pun&#235tor&#235t e kualifikuar'),
	(17, 'Already Registered ?', 'Bereits registriert ?', 'Déj? enregistré ?', 'Gi? registrato ?', 'Vec Registrovani ?', 'I regjistruar ?'),
	(18, 'Sign Up !', 'Anmelden !', 'S\'inscrire !', 'Registrazione !', 'Prijavi se !', 'Registrohu !'),
	(19, 'Tenders For Companies', 'Angebote für Firmen !', 'Appels d\'offres pour entreprises !', 'Le offerte per aziende !', 'Tenderi za Kompaniji !', 'Tenderat p&#235r kompani !'),
	(20, 'Assistance', 'Unterstützung !\r\n \r\n', 'Assistance !', 'Assistenza !', 'Asistencija !', 'Asistanc&#235 !'),
	(21, ' Publish Unlimited Jobs ', 'Veröffentlichen Unbegrenzte Jobs', 'Publier Jobs illimités', 'Pubblicare Lavoro illimitati', 'Objavljivanje negranicen posao !', 'Publikoni Pun&#235 pa Limit !'),
	(22, ' Receive Candidatures ', 'Erhalten Kandidaturen', 'Recevoir Candidatures', 'Ricevere le Candidature', 'Primite Kandidatura', 'Prano Kandidaturat'),
	(23, ' Contact Employees ', 'Kontakt Mitarbeiter', 'Contacts Employés', 'Dipendenti Contatto', 'Kontakt Zaposleni', 'Kontakto Pun&#235tor&#235t'),
	(24, 'Free', 'Frei', 'Gratuit', 'Gratuito', 'Besplatno', 'Falas'),
	(25, 'For Ever', 'Für immer', 'Pour toujours', 'Per sembre', 'Zauvek', 'P&#235r gjithmon&#235'),
	(26, ' Unlimited Jobs', 'Unbegrenzte Arbeitsplätze', 'Emplois illimités', 'Lavoro illimitati', 'Neogranicen Poslovi', 'Pun&#235 pakufi'),
	(27, 'Employers Space', 'Arbeitgeber Raum', 'Espace des Employeurs', 'Datori di lavoro Spazio', 'Poslodavci Prostor', 'Hap&#235sira e pun&#235dh&#235n&#235sve'),
	(28, 'Employee Space', 'Mitarbeiter Raum', 'Espace des Employé', 'Dipedenti Spazio', 'Zaposlenik Prostor', 'Hap&#235sira e pun&#235tor&#235ve'),
	(29, 'Profile', 'Profil', 'Profil', 'Profilo', 'Profil', 'Profil'),
	(30, 'Settings', 'Einstellungen', 'Param?tres', 'Impostazioni', 'Podeshavanja', 'Parametrat'),
	(31, 'No new messages', 'Keine neuen Nachrichten', 'Pas de nouveaux messages', 'Non ci sono nuovi messaggi', 'Nema Novih Poruka', 'Nuk ka mesazhe t&#235 reja'),
	(32, 'Logout', 'Ausloggen', 'Se déconnecter', 'Disconnettersi', 'Odjaviti se', 'Ckyc'),
	(33, 'Login', 'Anmeldung', 'Se connecter', 'Accesso', 'Prijava', 'Konekto'),
	(34, 'All', 'Alle', 'Tout', 'Tutti', 'Sve', 'Gjitha'),
	(35, 'New User !', 'Neuer Benutzer !', 'Nouveau Utilisateur !', 'Nuovo utente !', 'Novi Korisnik !', 'Perdorues i ri !'),
	(36, 'Forgot Password !', 'Passwort vergessen !', 'Mot de passe oublié !', 'Dimenticato la password !', 'Zaboravili ste lozniku !', 'Harruat fjal&#235kalimin !'),
	(37, 'Starting Date', 'Anfangsdatum', 'Date de début', 'Data di inizio', 'Datum Pocetka', 'Data e fillimit'),
	(38, 'Company Name', 'Name der Firma', 'Nom de la Societe', 'Nome della ditta', 'Ime Kompanije', 'Emri Kompanise'),
	(39, 'Job SN', 'Arbeitsplätze Seriennummer ', 'Emplois Numéro de série', 'Lavoro Numero di serie', 'Poslovi Serijski Broj', 'Numri Serial i pun&#235s'),
	(40, 'All Categories', 'Alle Kategorien', 'Toutes catégories', 'Tutte categorie', 'Sve Kategorije', 'T&#235 gjitha kategorit&#235'),
	(41, 'All Publish Dates', 'Alle veröffentlichen Termine', 'Tous Publier Dates', 'Tutto pubblicare le date', 'Sve Odjave Datum', 'Gjitha datat e publikimit'),
	(42, 'All Education Levels', 'Alle Bildungsniveau ', 'Tous les niveaux d\'éducation', 'Tutti i livelli di istruzione', 'Svi nivoe obrazovanja', 'Gjitha nivelet e arsimit'),
	(43, 'Experience Years', 'Jahre Erfahrung', 'Expérience Années', 'Esperienza anni', 'Iskustvo Godina', 'Vitet me Eksperienc?'),
	(44, 'Salary Order', 'Gehalt Bestellen', 'Salaire Ordre', 'Stipendio Ordine', 'Plata Poredak', 'Renditje Page'),
	(45, 'Filter', 'Filter', 'Filtre', 'Filtro', 'Filter', 'Filtro'),
	(46, 'Finishing Date', 'Fertigstellungstermin ', 'Date de finis', 'Data finale', 'Dorada datum', 'Data e mbarimit'),
	(47, 'Select category', 'Kategorie wählen', 'Choisir une catégorie', 'Seleziona categoria', 'Izberite Kategoria', 'Selekto kategorin'),
	(48, 'Expertises', 'Begutachtungen', 'Expertises', 'Expertises', 'Ekspertiza', 'Ekspertizat'),
	(49, 'Publish Date', 'Datum der Veröffentlichung', 'Date de publication', 'Data di pubblicazione', 'Datum Objave', 'Data Publikimit'),
	(50, 'Today', 'Heute', 'Aujourd\'hui', 'Oggi', 'Danas', 'Sot'),
	(51, 'Yesterday', 'Gestern', 'Hier', 'Leri', 'Juce', 'Dje'),
	(52, 'One Week Ago', 'Vor einer Woche', 'Depuis une semaine', 'Una settimana fa', 'Pre nedelju dana', 'Para nj&#235 jave'),
	(53, 'Two Weeks Ago', 'Vor zwei Wochen', 'Depuis deux semaine', 'Due settimane fa', 'Pre dve nedelje', 'Para dy jave'),
	(54, 'One Month Ago', 'Vor einem Monat', 'Depuis un mois', 'Un mese fa', 'Pre mesec dana', 'Para nj&#235 muaji'),
	(55, 'Years', 'Jahre', 'Années', 'Anni', 'Godine', 'Vitet'),
	(56, 'Options', 'Optionen', 'Options', 'Opzioni', 'Opcije', 'Opsionet'),
	(57, 'View', 'Aussicht', 'Vue', 'Vista', 'Pogled', 'Shih'),
	(58, 'Save Job', 'Job speichern', 'Sauvegarder annonce', 'Salva processo', 'Sacuvati Posao', 'Ruaje pun&#235n'),
	(59, 'Revoke Saved Job', 'Entziehen Gespeichert Job', 'Révoquer enregistrées annonce', 'Revoca salvati', 'Ukinuti Sacuvati Posao', 'Revoko Pun&#235n e Ruajtur'),
	(60, 'No data found', 'Keine Daten gefunden', 'Aucune donnée disponible', 'Nessun dato trovato', 'Podaci nisu pronagjenu', 'Nuk u gjet&#235n t&#235 dh&#235na'),
	(61, 'Profile Image', 'Profilbild', 'Photo de profil', 'Profilo Immagine', 'Profil Slika', 'Foto t&#235 profilit'),
	(62, 'Gender', 'Geschlecht', 'Genre', 'Genere', 'Pol', 'Gjinia'),
	(63, 'Male', 'Männlich', 'Mâle', 'Maschio', 'Muski', 'Mashkull'),
	(64, 'Female', 'Weiblich', 'Femelle', 'Femmina', 'Zenski', 'Fem&#235r'),
	(65, 'Choose', 'Wählen', 'Choisir', 'scegliere', 'Izabrati', 'Zgjedh'),
	(66, 'Phone Number', 'Telefonnummer', 'Numéro de téléphone', 'Numero di telefono', 'Broj Telefona', 'Numri Telefonit'),
	(67, 'Adress', 'Adresse', 'Adresse', 'Indirizzo', 'Adresa', 'Adresa'),
	(68, 'Postal code', 'Postleitzahl', 'Code postal', 'Codice postale', 'Postanski Kod', 'Kodi postal'),
	(69, 'City', 'Stadt', 'Ville', 'Citt?', 'Grad', 'Qytet'),
	(70, 'Country', 'Land', 'Pays', 'Nazione', 'Zemla', 'Shteti'),
	(71, 'Update', 'Aktualisieren', 'Mettre à jour', 'Aggiornare', 'Azuriraj', 'Ndrysho'),
	(72, 'Education', 'Ausbildung', 'Éducation', 'Educazione', 'Edukacija', 'Edukimi'),
	(73, 'Education Level', 'Bildungsniveau', 'Niveau d\'éducation', 'Livello di educazione', 'Obrazovni nivo', 'Nivelet edukimit'),
	(74, 'Diploma Type', 'Diplom-Typ', 'Type de diplôme', 'Tipo di diploma', 'Diploma Tip', 'Tipi Diplom&#235s'),
	(75, 'Title', 'Titel', 'Titre', 'Titolo', 'Titula', 'Titulli'),
	(76, 'Are you sure to remove diploma:', 'Sind Sie sicher, Diplom zu entfernen:', 'Etes-vous sûr de supprimer diplome:', 'Sei sicuro di rimuovere il diploma:', 'Dali ste sigurni da uklonite diplomu:', 'A jeni i sigurt p&#235r t&#235 hequr diplom&#235n:'),
	(77, 'Attending !', 'Der Besuch!', 'Participer!', 'Assistere!', 'Pohadjanje', 'Duke ndjekur'),
	(78, 'Remove', 'Entfernen', 'Retirer', 'Rimuovere', 'Ukloniti', 'Fshij'),
	(79, 'New Diploma', 'Neue Diplom', 'Nouveau diplôme', 'Nuovo Diploma', 'Nova diploma', 'Diplom? e re'),
	(80, 'Working Experience', 'Arbeitserfahrung', 'Expérience Professionnelle', 'Esperienza Lavorativa', 'Radno Iskustvo', 'Eksperienc? Pune'),
	(81, 'Description', 'Beschreibung', 'La description', 'Descrizione', 'Opis', 'P&#235rshkrim'),
	(82, 'New Experience', 'Neue Erfahrung', 'Nouvelle expérience', 'Nuova esperienza', 'Novo Iskustvo', 'Eksperienc&#235 e re'),
	(83, 'Attachments', 'Zubehör', 'Pièces jointes', 'Allegati', 'Prilozi', 'Bashkangjitjet'),
	(84, 'Curriculum Vitae', 'Curriculum Vitae', 'Curriculum Vitae', 'Curriculum Vitae', 'Curriculum Vitae', 'Curriculum Vitae'),
	(85, 'Motivation Letter', 'Motivationsschreiben', 'Lettre de motivation', 'Lettera di motivazione', 'Motivaciono Pismo', 'Let&#235r Motivimi'),
	(86, 'Name', 'Name', 'Prénom', 'Nome', 'Ime', 'Emri'),
	(87, 'Surname', 'Familienname', 'Nom', 'Cognome', 'Prezime', 'Mbiemri'),
	(88, 'Password', 'Passwort', 'Mot de passe', 'parola d\'ordine', 'Lozinka', 'Passwordi'),
	(89, 'Privacy Policy', 'Privatsphäre', 'Confidentialité', 'Privata', 'Privatnost', 'Privat&#235sia'),
	(90, 'Anyone can see my profile ?', 'Jeder kann mein Profil sehen?', 'Tout le monde peut voir mon profil?', 'Chiunque pu? vedere il mio profilo?', 'Svako moze da vidi moj profil ?', 'Gjithkush mund t&#235 shoh profilin tim ?'),
	(91, 'Details', 'Einzelheiten', 'Détails', 'Dettagli', 'Detali', 'Detaje'),
	(92, 'Birthday', 'Geburtstag', 'Anniversaire', 'Compleanno', 'Rodjen Dan', 'Dit&#235lindje'),
	(93, 'New Password', 'Neues Kennwort', 'Nouveau mot de passe', 'Nuova password', 'Nova Lozinka', 'Password i ri'),
	(94, 'Confirm New Password', 'Neues Passwort bestätigen', 'Confirmer le nouveau mot de passe', 'Conferma la nuova password', 'Potvrdite novu lozinku', 'Konfirmo Passwordin e ri'),
	(95, 'Job Overview', 'Job-Übersicht', 'Aperçu du poste', 'Descrizione della posizione', 'Posao pregled', 'P&#235rshkrim i pun&#235s'),
	(96, 'Company Overview', 'Firmenüberblick', 'Présentation de l\'entreprise', 'Descrizione della societ?', 'Pregled drustva', 'P&#235rshkrim i kompanis&#235'),
	(97, 'Education Level', 'Bildungsniveau', 'Niveau d\'éducation', 'Livello di Educazione', 'Obrazovni Nivo', 'Niveli Arsimit'),
	(98, 'Expertise Area', 'Expertise Bereich', 'Domaine d\'expertise', 'Area competenza', 'Strucnost Povrsina', 'Fusha ekspertiz&#235s'),
	(99, 'Experience Area', 'Erlebnisraum ', 'Expérience Zone', 'Area Experience', 'Iskustvo Povrsina', 'Fusha Eksperienc&#235s'),
	(100, 'Closing Application', 'Schließen Anwendungs', 'Clôture d\'application', 'Applicazione di chiusura', 'Zatvaranje aplikacija', 'Mbyllja Aplikacionit'),
	(101, 'Job Description', 'Arbeitsbeschreibung', 'Description de l\'emploi', 'Descrizione del lavoro', 'Opis Posla', 'P&#235rshkrim Pun&#235s'),
	(102, 'Number of Employees', 'Anzahl der Angestellten', 'Nombre d\'employés', 'numero di dipendenti', 'Broj Zaposlenih', 'Numri Pun&#235tor&#235ve'),
	(103, 'Company Description', 'Firmen Beschreibung', 'Description de l\'entreprise', 'Descrizione della societ?', 'Opis kompanije', 'P&#235rshkrimi kompanis&#235'),
	(104, 'Short Motivation Words (max. 800 characters)', 'Motivwörter (max. 800 Zeichen)', 'Mots de motivation (max. 800 caractères)', 'Parole motivazionali (max. 800 caratteri)', 'Kratki Motivacioni reči (maks. 800 znakova)', 'Fjal&#235 t&#235 shkurtra motivuese (max. 800 karaktere)'),
	(105, 'Waiting a Response !', 'Warten auf ein Antwort!', 'En attendant une réponse!', 'In attesa di una risposta!', 'Čeka na odgovor!', 'Duke pritur nj&#235 p?rgjigje!'),
	(106, 'Applied Already !', 'Angewandt bereits!', 'Appliqué Déjà!', 'Applicato Già!', 'Primenjuje vec?!', 'Gati aplikuat !'),
	(107, 'Apply !', 'Anwenden', 'Postuler !', 'Applicare !', 'Aplicirati !', 'Apliko !'),
	(108, 'Sending a Message to ', 'Senden einer Nachricht an', 'Envoyer un message à', 'Invio di un messaggio di', 'Slanjem poruke na', 'Duke d&#235rguar nj&#235 mesazh te'),
	(109, 'Write a Message', 'Eine Nachricht schreiben', 'Écrire un message', 'Scrivi un messaggio', 'Napiši Poruku', 'Shkruaj Mesazh'),
	(110, 'Object Message', 'Gegenstand der Nachricht', 'Objet du message', 'Oggetto del messaggio', 'Objekat poruka', 'Objekt Mesazhi'),
	(111, 'Message Area', 'Nachrichtenbereich ', 'Zone de message', 'Area messaggi', 'Poruka Površina', 'Hap&#235sira Mesazhit'),
	(112, 'No messages found for this user', 'Keine Nachrichten für diesen Benutzer gefunden', 'Aucun message trouvé pour cet utilisateur', 'Nessun messaggio trovato per questo utente', 'Nema podataka za traženi korisnika poruke', 'Nuk ka mesazhe t&#235 gjetura p&#235r k&#235t&#235 p&#235rdorues'),
	(113, 'Me', 'Mir', 'Moi', 'Me', 'Mi', 'Un&#235'),
	(114, 'User', 'Benutzer', 'Utilisateur', 'Utente', 'Korisnik', 'P&#235rdorues'),
	(115, 'From', 'Von', 'De', 'Dal', 'Od', 'Nga'),
	(116, 'Header', 'Header', 'Header', 'Header', 'Header', 'Header'),
	(117, 'Time Message', 'Zeit Nachricht', 'L\'heure de message', 'Ora Messaggio', 'Vreme poruke', 'Ora mesazhit'),
	(118, 'You are removing emails with', 'Sie erhalten E-Mails mit', 'Vous recevez des e-mails avec', 'Si sta rimuovendo con', 'Primate e-mailove sa', 'Jeni duke i fshir? emailat me'),
	(119, 'Languages', 'Sprachen', 'Langues', 'Le lingue', 'Jezici', 'Gjuh&#235t'),
	(120, 'Choose your language !', 'Wähle deine Sprache !', 'Choisissez votre langue !', 'Scegli la lingua!', 'Izaberite svoj jezik!', 'Zgjidhni gjuh&#235n tuaj!'),
	(121, 'Applied Jobs', 'Bewerbungen', 'Emplois appliqué', 'Lavoro applicate', 'Primenjena Poslovi', 'Pun&#235t e Aplikuara'),
	(122, 'Insert a Job Experience', 'Legen Sie eine Beruf Erfahrung', 'Insérez une expérience d\'emploi', 'Inserire una esperienza di lavoro', 'Ubacite radno iskustvo', 'Vendos nj&#235 p&#235rvoj pune'),
	(123, 'Company City', 'Stadt der Firma', 'Ville de la société', 'Città della società', 'Grad kompanije', 'Qyteti Kompanis?'),
	(124, 'Company State', 'Land der Firma', 'État de la société', 'Stato della società', 'Država kompanije', 'Shteti Kompanis?'),
	(125, 'Choosing Category', 'Die Wahl Kategorie', 'Choisir Catégorie', 'Scelta Categoria', 'Izbor Kategorija', 'Zgjedhja Kategoris?'),
	(126, 'Leaving Job ?', 'Verlassen Beruf?', 'Laissant Job?', 'Lasciando lavoro?', 'Napuštanja posao?', 'L&#235nia pun&#235s?'),
	(127, 'Insert', 'Einfügen', 'Insérer', 'Inserire', 'Umetak', 'Vendos'),
	(128, 'Graduation Date', 'Abschlussdatum', 'Date de Graduation', 'Data di laurea', 'Diplomski Datum', 'Data diplomimit'),
	(129, 'Are you sure to remove experience:', 'Sind Sie sicher, Erfahrung zu entfernen: ', 'Etes-vous sûr de supprimer l\'expérience:', 'Sei sicuro di rimuovere esperienza:', 'Da li ste sigurni da uklonite iskustvo:', 'A jeni i sigurt t&#235 t&#235rheqni p&#235rvoj&#235n: '),
	(130, 'Graduated ?', 'Abgestufte ?', 'Diplômé ?', 'Laureato ?', 'Diplomirao ?', 'Diplomuar ?'),
	(131, 'Register as Employee !', 'Registrieren Sie sich als Mitarbeiter!', 'Inscrivez-vous comme employé!', 'Registrati come dipendente!', 'Registruju kao radnik!', 'Regjistrohuni si punonj&#235s!'),
	(132, 'Register as Employer !', 'Registrieren Sie sich als Arbeitgeber!', 'Inscrivez-vous comme employeur!', 'Registrati come datore di lavoro!', 'Registruju kao poslodavca!', 'Regjistrohu si Pun&#235dh&#235n&#235s!'),
	(135, 'Email', 'Email', 'Email', 'Email', 'Email', 'Email'),
	(136, 'Agree & Register', 'Akzeptieren und Register', 'Accepter et enregistrer', 'Accetto & Registrazione', 'Slažem se i Registracija', 'Pranoj & Regjistrohu');
/*!40000 ALTER TABLE `language_expressions` ENABLE KEYS */;


-- Dumping structure for table jbms.levels_education
CREATE TABLE IF NOT EXISTS `levels_education` (
  `id_level_education` int(11) NOT NULL AUTO_INCREMENT,
  `level_education` varchar(80) DEFAULT NULL,
  `en_level_education` varchar(80) DEFAULT NULL,
  `de_level_education` varchar(80) DEFAULT NULL,
  `fr_level_education` varchar(80) DEFAULT NULL,
  `it_level_education` varchar(80) DEFAULT NULL,
  `rs_level_education` varchar(80) DEFAULT NULL,
  `al_level_education` varchar(80) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_level_education`),
  UNIQUE KEY `id_level_education` (`id_level_education`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table jbms.levels_education: 6 rows
/*!40000 ALTER TABLE `levels_education` DISABLE KEYS */;
INSERT IGNORE INTO `levels_education` (`id_level_education`, `level_education`, `en_level_education`, `de_level_education`, `fr_level_education`, `it_level_education`, `rs_level_education`, `al_level_education`, `active`) VALUES
	(1, 'High School Diploma', 'High School Diploma', 'Weiterführende Schule Diplom', 'Baccalauréat', 'Diploma di scuola superiore', 'Diploma srednje škole', 'Diploma shkollës lart', 1),
	(2, 'Faculty Diploma', 'Faculty Diploma', 'Fakultät Diplom', 'Faculté diplôme', 'Facoltà Diploma', 'Fakultet diploma', 'Diploma fakultetit', 1),
	(3, 'Masters Diploma', 'Master Diploma', 'Masters-Diplom', 'Diplôme Master', 'Diploma di master', 'Master diploma', 'Diploma master', 1),
	(4, 'Doctorat Diploma', 'Doctoral Diploma', 'Promotionsurkunde ', 'Diplôme de doctorat', 'Diploma di Dottorato', 'Doktorska diploma', 'Diploma doktoraturës', 1),
	(6, 'No diploma', 'No diploma', 'Kein Diplom', 'Aucun diplôme', 'Nessun diploma', 'no diplomu', 'Pa diplomë', 1),
	(5, 'Academic Diploma', 'Academic Diploma', 'Akademischer Diplom', 'Diplôme universitaire', 'Diploma Accademico', 'Akademska diploma', 'Diplomë akademike', 1);
/*!40000 ALTER TABLE `levels_education` ENABLE KEYS */;


-- Dumping structure for table jbms.levels_experience
CREATE TABLE IF NOT EXISTS `levels_experience` (
  `id_level_experience` int(11) NOT NULL AUTO_INCREMENT,
  `en_level_experience` varchar(80) COLLATE hp8_bin DEFAULT NULL,
  `de_level_experience` varchar(80) COLLATE hp8_bin DEFAULT NULL,
  `fr_level_experience` varchar(80) COLLATE hp8_bin DEFAULT NULL,
  `it_level_experience` varchar(80) COLLATE hp8_bin DEFAULT NULL,
  `rs_level_experience` varchar(80) COLLATE hp8_bin DEFAULT NULL,
  `al_level_experience` varchar(80) COLLATE hp8_bin DEFAULT NULL,
  `years_experience` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_level_experience`),
  UNIQUE KEY `id_level` (`id_level_experience`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

-- Dumping data for table jbms.levels_experience: 3 rows
/*!40000 ALTER TABLE `levels_experience` DISABLE KEYS */;
INSERT IGNORE INTO `levels_experience` (`id_level_experience`, `en_level_experience`, `de_level_experience`, `fr_level_experience`, `it_level_experience`, `rs_level_experience`, `al_level_experience`, `years_experience`, `active`) VALUES
	(1, 'Beginner', 'Anfänger', 'Débutant', 'Principiante', 'Pocetnik', 'Fillestar', '0-2', 1),
	(2, 'Medium', 'Mittel', 'Moyen', 'Medio', 'Srednji', 'Mesatar', '2-5', 1),
	(9, 'Advanced', 'Fortgeschritten', 'Avancée', 'Progredire', 'Napredovati', 'Avansuar', '5-10+', 1);
/*!40000 ALTER TABLE `levels_experience` ENABLE KEYS */;


-- Dumping structure for table jbms.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Notification id',
  `msg_type` char(10) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Type of msg',
  PRIMARY KEY (`id_notification`),
  UNIQUE KEY `id_notification` (`id_notification`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

-- Dumping data for table jbms.notifications: ~3 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT IGNORE INTO `notifications` (`id_notification`, `msg_type`) VALUES
	(1, 'log'),
	(2, 'error'),
	(3, 'success');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;


-- Dumping structure for table jbms.profile_favourites
CREATE TABLE IF NOT EXISTS `profile_favourites` (
  `id_favourite` int(11) NOT NULL AUTO_INCREMENT,
  `id_employer` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_favourite`),
  UNIQUE KEY `id_favourite` (`id_favourite`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

-- Dumping data for table jbms.profile_favourites: 0 rows
/*!40000 ALTER TABLE `profile_favourites` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_favourites` ENABLE KEYS */;


-- Dumping structure for table jbms.salary_ranges
CREATE TABLE IF NOT EXISTS `salary_ranges` (
  `id_salary` int(11) NOT NULL AUTO_INCREMENT,
  `salary_range` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_salary`),
  UNIQUE KEY `id_salary` (`id_salary`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

-- Dumping data for table jbms.salary_ranges: 6 rows
/*!40000 ALTER TABLE `salary_ranges` DISABLE KEYS */;
INSERT IGNORE INTO `salary_ranges` (`id_salary`, `salary_range`, `active`) VALUES
	(1, '< 300', 1),
	(2, '300-600', 1),
	(3, '600-800', 1),
	(4, '800-1000', 1),
	(5, '1000-1500', 1),
	(6, '> 1500', 1);
/*!40000 ALTER TABLE `salary_ranges` ENABLE KEYS */;


-- Dumping structure for table jbms.saved_jobs
CREATE TABLE IF NOT EXISTS `saved_jobs` (
  `id_saved_job` int(11) NOT NULL AUTO_INCREMENT,
  `id_job` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_saved_job`),
  UNIQUE KEY `id_saved_job` (`id_saved_job`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

-- Dumping data for table jbms.saved_jobs: 2 rows
/*!40000 ALTER TABLE `saved_jobs` DISABLE KEYS */;
INSERT IGNORE INTO `saved_jobs` (`id_saved_job`, `id_job`, `id_employee`) VALUES
	(1, 1, 10),
	(2, 13, 67);
/*!40000 ALTER TABLE `saved_jobs` ENABLE KEYS */;


-- Dumping structure for table jbms.social_fanpages
CREATE TABLE IF NOT EXISTS `social_fanpages` (
  `id_fanpage` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `img_icon` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `http_direction` mediumtext CHARACTER SET latin1,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_fanpage`),
  UNIQUE KEY `id_fanpage` (`id_fanpage`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

-- Dumping data for table jbms.social_fanpages: 4 rows
/*!40000 ALTER TABLE `social_fanpages` DISABLE KEYS */;
INSERT IGNORE INTO `social_fanpages` (`id_fanpage`, `company_name`, `img_icon`, `http_direction`, `active`) VALUES
	(1, 'Facebook', 'fa fa-facebook fa-2x', 'facebook.com/compname', 1),
	(2, 'Google Plus', 'fa fa-google fa-2x', 'googleplus.com/compname', 1),
	(3, 'Twitter', 'fa fa-twitter fa-2x', 'twitter.com/compname', 1),
	(4, 'Twitter', 'fa fa-twitter fa-2x', 'twitter.com/compname', 1);
/*!40000 ALTER TABLE `social_fanpages` ENABLE KEYS */;


-- Dumping structure for table jbms.social_sdk
CREATE TABLE IF NOT EXISTS `social_sdk` (
  `id_sdk` int(11) NOT NULL AUTO_INCREMENT,
  `name_page` varchar(50) DEFAULT NULL,
  `hyperlink` mediumtext,
  PRIMARY KEY (`id_sdk`),
  UNIQUE KEY `id_sdk` (`id_sdk`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table jbms.social_sdk: ~0 rows (approximately)
/*!40000 ALTER TABLE `social_sdk` DISABLE KEYS */;
INSERT IGNORE INTO `social_sdk` (`id_sdk`, `name_page`, `hyperlink`) VALUES
	(1, 'Facebook', '<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=450&layout=standard&action=like&show_faces=true&share=true&height=80&appId" width="450" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>');
/*!40000 ALTER TABLE `social_sdk` ENABLE KEYS */;


-- Dumping structure for table jbms.tbl_employees
CREATE TABLE IF NOT EXISTS `tbl_employees` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(25) NOT NULL,
  `emp_dept` varchar(50) NOT NULL,
  `emp_salary` varchar(7) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table jbms.tbl_employees: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_employees` DISABLE KEYS */;
INSERT IGNORE INTO `tbl_employees` (`emp_id`, `emp_name`, `emp_dept`, `emp_salary`) VALUES
	(1, 'john doe', 'programmer', '155000'),
	(2, 'test', 'web designer', '500000');
/*!40000 ALTER TABLE `tbl_employees` ENABLE KEYS */;


-- Dumping structure for table jbms.temporary_data
CREATE TABLE IF NOT EXISTS `temporary_data` (
  `id_data` int(11) NOT NULL AUTO_INCREMENT,
  `target` varchar(50) DEFAULT NULL,
  `value1` varchar(50) DEFAULT NULL,
  `value2` varchar(50) DEFAULT NULL,
  `value3` varchar(50) DEFAULT NULL,
  `value4` varchar(50) DEFAULT NULL,
  `value5` varchar(50) DEFAULT NULL,
  `value6` varchar(50) DEFAULT NULL,
  `value7` varchar(50) DEFAULT NULL,
  `value8` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_data`),
  UNIQUE KEY `id_data` (`id_data`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table jbms.temporary_data: ~7 rows (approximately)
/*!40000 ALTER TABLE `temporary_data` DISABLE KEYS */;
INSERT IGNORE INTO `temporary_data` (`id_data`, `target`, `value1`, `value2`, `value3`, `value4`, `value5`, `value6`, `value7`, `value8`) VALUES
	(5, 'import_users', 'Liridon', 'Liridon', '01.01.1986', 'agushi', 'agushi', 'agushi', NULL, NULL),
	(6, 'import_users', 'Liridon', 'Liridon', '01.01.1986', 'agushi', 'agushi', 'agushi', NULL, NULL),
	(7, 'import_users', 'Liridon', 'Liridon', '01.01.1986', 'agushi', 'agushi', 'agushi', NULL, NULL),
	(8, 'import_users', 'Liridon', 'Liridon', '01.01.1986', 'agushi', 'agushi', 'agushi', NULL, NULL),
	(9, 'import_users', 'Liridon', 'Liridon', '01.01.1986', 'agushi', 'agushi', 'agushi', NULL, NULL),
	(10, 'import_users', 'Liridon', 'Liridon', '01.01.1986', 'agushi', 'agushi', 'agushi', NULL, NULL),
	(11, 'import_users', 'Liridon', 'Liridon', '01.01.1986', 'agushi', 'agushi', 'agushi', NULL, NULL),
	(12, 'import_users', 'Liridon', 'Liridon', '01.01.1986', 'agushi', 'agushi', 'agushi', NULL, NULL);
/*!40000 ALTER TABLE `temporary_data` ENABLE KEYS */;


-- Dumping structure for table jbms.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(100) NOT NULL AUTO_INCREMENT,
  `id_language` int(50) NOT NULL DEFAULT '1',
  `name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `surname` varchar(20) CHARACTER SET latin1 NOT NULL,
  `id_adress` int(100) NOT NULL DEFAULT '0',
  `id_currency` int(5) NOT NULL DEFAULT '1',
  `id_expertise` int(11) DEFAULT NULL,
  `birthday` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(10) CHARACTER SET latin1 NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_level` tinyint(1) NOT NULL COMMENT '1 if admin and 0 normal user',
  `phone_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `profile_img` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `generate_pass_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `public_profile` tinyint(4) DEFAULT '1',
  `email_verification` tinyint(4) DEFAULT '1',
  `id_gender` tinyint(4) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

-- Dumping data for table jbms.users: 69 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id_user`, `id_language`, `name`, `surname`, `id_adress`, `id_currency`, `id_expertise`, `birthday`, `email`, `password`, `date_registered`, `admin_level`, `phone_number`, `profile_img`, `generate_pass_key`, `public_profile`, `email_verification`, `id_gender`, `active`) VALUES
	(3, 1, 'Smith', 'Johnson', 4, 1, NULL, '', 'Smith.Johnson@email.com', 'liridon', '2016-07-15 10:19:53', 3, '246', NULL, NULL, NULL, 1, 0, 1),
	(4, 1, 'Williams', 'Jones', 1, 1, NULL, '', 'Williams.Jones@email.com', '', '2016-07-15 10:20:30', 3, '95', NULL, NULL, NULL, 1, 0, 1),
	(5, 1, 'Brown', 'Davis', 1, 1, NULL, '', 'Brown.Davis@email.com', '', '2016-07-15 10:20:50', 3, '90', NULL, NULL, NULL, 1, 0, 1),
	(6, 1, 'Miller', 'Wilson', 4, 1, NULL, '', 'Miller.Wilson@email.com', '', '2016-07-15 10:21:04', 3, '115', NULL, NULL, NULL, 1, 0, 1),
	(7, 1, 'Moore', 'Taylor', 1, 1, NULL, '', 'Moore.Taylor@email.com', '', '2016-07-15 10:21:20', 3, '56', '54120.jpg', NULL, NULL, 1, 0, 1),
	(8, 1, 'Anderson', 'Thomas', 5, 1, NULL, '', 'Anderson.Thomas@email.com', '', '2016-07-15 10:21:33', 3, '84', '2984.jpg', NULL, 1, 1, 0, 1),
	(9, 1, 'Jackson', 'Richardson', 2, 1, NULL, '', 'Jackson.Richardson@email.com', '', '2016-07-15 10:21:50', 3, '205', NULL, NULL, NULL, 1, 0, 1),
	(10, 6, 'Turner', 'Brooks', 1, 1, NULL, '1986-09-11', 'Turner.Brooks@email.com', 'liridon', '2016-07-15 10:22:12', 3, '1201', '10379.jpg', NULL, 1, 1, 1, 1),
	(11, 1, 'Aime', 'Agen', 1, 1, NULL, '', 'Aime.Agen@email.com', '', '2016-07-15 10:22:54', 3, '139', NULL, NULL, NULL, 1, 0, 1),
	(12, 1, 'Alban', 'Alexandre', 3, 1, NULL, '', 'Alban.Alexandre@email.com', 'liridon', '2016-07-15 10:23:07', 3, '82', NULL, NULL, 1, 1, 0, 1),
	(13, 1, 'Alphonse', 'Ancar', 7, 1, NULL, '', 'Alphonse.Ancar@email.com', '', '2016-07-15 10:23:20', 3, '146', NULL, NULL, NULL, 1, 0, 1),
	(14, 1, 'Angers', 'Angles', 2, 1, NULL, '', 'Angers.Angles@email.com', '', '2016-07-15 10:24:07', 3, '235', NULL, NULL, NULL, 1, 0, 1),
	(15, 1, 'Arnette', 'Bacot', 4, 1, NULL, '', 'Arnette.Bacot@email.com', '', '2016-07-15 10:24:30', 3, '87', NULL, NULL, NULL, 1, 0, 1),
	(16, 1, 'Baron', 'Batton', 3, 1, NULL, '', 'Baron.Batton@email.com', '', '2016-07-15 10:24:50', 3, '80', NULL, NULL, NULL, 1, 0, 1),
	(17, 1, 'Beaudet', 'Beaufort', 6, 1, NULL, '', 'Beaudet.Beaufort@email.com', '', '2016-07-15 10:25:05', 3, '91', NULL, NULL, NULL, 1, 0, 1),
	(18, 1, 'Beaupre', 'Bedard', 6, 1, NULL, '', 'Beaupre.Bedard@email.com', '', '2016-07-15 10:25:15', 3, '164', NULL, NULL, NULL, 1, 0, 1),
	(19, 1, 'Ahlers', 'Aerni', 3, 1, NULL, '', 'Ahlers.Aerni@email.com', '', '2016-07-15 10:26:11', 3, '98', NULL, NULL, NULL, 1, 0, 1),
	(20, 1, 'Alm', 'Altermatt', 4, 1, NULL, '', 'Alm.Altermatt@email.com', '', '2016-07-15 10:26:24', 3, '148', NULL, NULL, NULL, 1, 0, 1),
	(21, 1, 'Andros', 'Anspach', 2, 1, NULL, '', 'Andros.Anspach@email.com', '', '2016-07-15 10:26:35', 3, '196', NULL, NULL, NULL, 1, 0, 1),
	(22, 1, 'Arenz', 'Ansted', 6, 1, NULL, '', 'Arenz.Ansted@email.com', '', '2016-07-15 10:26:46', 3, '89', NULL, NULL, NULL, 1, 0, 1),
	(23, 1, ' Müller ', 'Andrle', 5, 1, NULL, '', ' Müller .Andrle@email.com', '', '2016-07-15 10:27:05', 3, '206', NULL, NULL, NULL, 1, 0, 1),
	(24, 1, 'Amend', ' Schäfer ', 3, 1, NULL, '', 'Amend. Schäfer @email.com', '', '2016-07-15 10:27:15', 3, '112', NULL, NULL, NULL, 1, 0, 1),
	(25, 1, 'Aegerter', ' Richter ', 2, 1, NULL, '', 'Aegerter. Richter @email.com', '', '2016-07-15 10:27:31', 3, '93', NULL, NULL, NULL, 1, 0, 1),
	(26, 1, ' Schröder ', 'Alpers', 5, 1, NULL, '', ' Schröder .Alpers@email.com', '', '2016-07-15 10:27:44', 3, '78', NULL, NULL, NULL, 1, 0, 1),
	(27, 1, 'Alberg', 'Alban', 2, 1, NULL, '', 'Alberg.Alban@email.com', '', '2016-07-15 10:27:58', 3, '64', NULL, NULL, NULL, 1, 0, 1),
	(28, 1, 'Andrist', 'Angel', 7, 1, NULL, '', 'Andrist.Angel@email.com', '', '2016-07-15 10:28:09', 3, '235', NULL, NULL, NULL, 1, 0, 1),
	(29, 1, 'Albino', 'Albini', 2, 1, NULL, '', 'Albino.Albini@email.com', '', '2016-07-15 10:29:02', 3, '134', NULL, NULL, NULL, 1, 0, 1),
	(30, 1, 'Allio', 'Amadeo', 6, 1, NULL, '', 'Allio.Amadeo@email.com', '', '2016-07-15 10:29:20', 3, '117', NULL, NULL, NULL, 1, 0, 1),
	(31, 1, 'Argenta', 'Arena', 6, 1, NULL, '', 'Argenta.Arena@email.com', '', '2016-07-15 10:29:30', 3, '131', NULL, NULL, NULL, 1, 0, 1),
	(32, 1, 'Argenti', 'Apollo', 6, 1, NULL, '', 'Argenti.Apollo@email.com', '', '2016-07-15 10:29:43', 3, '55', NULL, NULL, NULL, 1, 0, 1),
	(33, 1, 'Adam', 'Almir', 5, 1, NULL, '', 'Adam.Almir@email.com', '', '2016-07-15 10:31:21', 3, '232', NULL, NULL, NULL, 1, 0, 1),
	(34, 1, 'Amaan', 'Amaar', 6, 1, NULL, '', 'Amaan.Amaar@email.com', '', '2016-07-15 10:31:32', 3, '146', NULL, NULL, NULL, 1, 0, 1),
	(35, 1, 'Ashim', 'Ashik', 7, 1, NULL, '', 'Ashim.Ashik@email.com', '', '2016-07-15 10:31:51', 3, '186', NULL, NULL, NULL, 1, 0, 1),
	(36, 1, 'Alia', 'Alea', 3, 1, NULL, '', 'Alia.Alea@email.com', '', '2016-07-15 10:32:32', 3, '242', NULL, NULL, NULL, 1, 0, 1),
	(37, 1, 'Elanna', 'Hanah', 6, 1, NULL, '', 'Elanna.Hanah@email.com', '', '2016-07-15 10:32:33', 3, '201', NULL, NULL, NULL, 1, 0, 1),
	(38, 1, 'Leora', 'Leron', 6, 1, NULL, '', 'Leora.Leron@email.com', '', '2016-07-15 10:33:01', 3, '229', NULL, NULL, NULL, 1, 0, 1),
	(39, 1, 'Yael', 'Zadok', 2, 1, NULL, '', 'Yael.Zadok@email.com', '', '2016-07-15 10:33:25', 3, '92', NULL, NULL, NULL, 1, 0, 1),
	(40, 1, 'Albana', 'Arjana', 93, 1, NULL, '2004-09-16', 'Albana.Arjana@email.com', '123456', '2016-07-15 10:33:58', 3, '1231', '40441.jpg', NULL, NULL, 1, 2, 1),
	(41, 1, 'Miranda', 'Entela', 4, 1, NULL, '', 'Miranda.Entela@email.com', '', '2016-07-15 10:34:11', 3, '89', NULL, NULL, NULL, 1, 0, 1),
	(42, 1, 'Albion', 'Ardi', 4, 1, NULL, '', 'Albion.Ardi@email.com', '', '2016-07-15 10:34:38', 3, '229', NULL, NULL, NULL, 1, 0, 1),
	(43, 1, 'Arlind', 'Besian', 5, 1, NULL, '', 'Arlind.Besian@email.com', '', '2016-07-15 10:34:59', 3, '228', NULL, NULL, NULL, 1, 0, 1),
	(44, 1, 'Abram', 'Anton', 7, 1, NULL, '', 'Abram.Anton@email.com', '', '2016-07-15 10:35:50', 3, '201', NULL, NULL, NULL, 1, 0, 1),
	(45, 1, 'Artur', 'Albert', 5, 1, NULL, '', 'Artur.Albert@email.com', '', '2016-07-15 10:35:57', 3, '73', NULL, NULL, NULL, 1, 0, 1),
	(46, 1, 'Vadim', 'Viktor', 9, 1, NULL, '', 'Vadim.Viktor@email.com', '', '2016-07-15 10:36:20', 3, '115', NULL, NULL, NULL, 1, 0, 1),
	(47, 1, 'Vladimir', 'Valentin', 2, 1, NULL, '', 'Vladimir.Valentin@email.com', '', '2016-07-15 10:36:27', 3, '103', NULL, NULL, NULL, 1, 0, 1),
	(48, 1, 'Chang', 'Ho', 5, 1, NULL, '', 'Chang.Ho@email.com', '', '2016-07-15 11:08:32', 3, '121', NULL, NULL, NULL, 1, 0, 1),
	(49, 1, 'admin', 'admin', 0, 1, NULL, '1986-01-01', 'admin', 'admin', '2016-08-06 12:52:59', 3, NULL, NULL, NULL, NULL, 1, 0, 1),
	(50, 1, 'Liridon', 'Agushi', 0, 1, NULL, '', 'agushi@email.com', '123456', '2016-08-22 07:59:03', 3, NULL, NULL, NULL, NULL, 1, 0, 1),
	(51, 1, 'mnmnmnmn', 'mnmnmnmn', 0, 1, NULL, '', 'agush1i@email.com', 'mnmnmn,m', '2016-08-22 08:01:57', 3, NULL, NULL, NULL, NULL, 1, 0, 1),
	(52, 1, 'bvcbvcbvc', 'bvcbvcbvc', 0, 1, NULL, '', 'bvcbvbvccbvc@bvc.com', 'bvcbvcvbvc', '2016-08-22 08:03:55', 3, NULL, NULL, NULL, NULL, 1, 0, 1),
	(53, 1, 'Liridon', 'Agushi', 38, 1, NULL, '1986-05-21', 'liridon.agushi@hotmail.com', 'liridon', '2016-08-22 17:27:10', 3, '0638002549', '53279.jpg', NULL, 1, 1, 0, 1),
	(54, 1, 'Adile', 'Agushi', 41, 1, NULL, '24-06-1989', 'adile@hotmail.com', '123456', '2016-08-23 12:41:44', 3, 'Language Teacher1', '54120.jpg', NULL, 1, 1, 0, 1),
	(55, 1, 'Liridon', 'Agushi', 0, 1, NULL, '', 'liridon@gmail.com', '123456', '2016-08-23 14:29:52', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(57, 1, 'bvcbvc', 'bvcbvc', 0, 1, NULL, '', 'vcbcbvbvcbv@nbv', 'bvcbvc', '2016-11-09 15:31:20', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(58, 1, 'Liridon', 'Agushi', 0, 1, NULL, '', 'agushi@gmail.com', '123456', '2016-11-12 10:45:16', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(59, 1, 'nbvnb', 'vnbnbv', 0, 1, NULL, '', 'nbvnbv@nbvnbv', 'nbvnbv', '2016-09-13 14:06:09', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(64, 1, 'Liridon', 'Agushi', 0, 1, NULL, '', 'nbvnbnbv@nbv.com', 'bvcbvcbvc', '2016-09-22 00:34:46', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(60, 1, 'fitore', 'agushi', 82, 1, NULL, '2004-09-02', 'hheeeh@jfj', 'liridon', '2016-09-21 18:41:18', 3, '06525622', NULL, NULL, 1, 1, 2, 1),
	(61, 1, 'fitore', 'agushi', 0, 1, NULL, '', 'fitore@h', 'hhdhd', '2016-09-21 18:50:02', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(62, 1, 'liridon', 'agushi', 0, 1, NULL, '', 'liridon@liridon.comn', 'bvcbvbvc', '2016-09-21 23:29:01', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(63, 1, 'Liridon', 'Agushi', 0, 1, NULL, '', 'agushi1.liridon@gmail.com', 'bvcbvc', '2016-09-22 00:14:10', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(65, 1, 'vnbnbv', 'nbvnbv', 0, 1, NULL, '2004-09-16', 'nvbnbv@nbvnbv', 'nmmnbmn', '2016-09-22 00:38:38', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(66, 1, 'Liridon', 'Agushi', 0, 1, NULL, '', 'agushi11.liridon@gmail.com', '123456', '2016-09-22 18:10:47', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(67, 1, 'Liridon', 'Agushi', 8, 1, NULL, '1986-05-21', 'agushi.liridon@gmail.com', 'liridon', '2016-09-24 18:52:11', 2, '0638002549', NULL, NULL, 1, 1, 1, 1),
	(68, 1, 'Adile', 'Agushi', 90, 1, NULL, '1989-06-24', 'adile_arifi@hotmail.com', 'liridon', '2016-09-24 18:52:46', 2, '0638002549', '68513.jpg', NULL, 1, 1, 2, 1),
	(69, 1, 'Liridon', 'Agushi', 0, 1, NULL, '', 'agushi@agushi.com', '123456', '2016-09-25 16:04:46', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(70, 1, 'mnbvcnbvc', 'mnbmnbmnb', 0, 1, NULL, '2004-10-01', 'nbvnbvn@bvcbvc.com', 'bvcbvcbvc', '2016-10-09 08:38:26', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(71, 1, 'Liridon', 'vnbc', 0, 1, NULL, '2004-10-05', 'cvnb@bvc', 'vcbnnbvc', '2016-10-09 12:44:09', 3, NULL, NULL, NULL, 1, 1, 0, 1),
	(72, 1, 'Agushi', 'liridon', 0, 1, NULL, '2017-02-06', 'agushi12.liridon@gmail.com', '123456', '2017-02-06 14:53:48', 3, NULL, NULL, NULL, 1, 1, NULL, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table jbms.working_experiences
CREATE TABLE IF NOT EXISTS `working_experiences` (
  `id_experience` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `job_title` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `company_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `id_expertise` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `description` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `on_load` varchar(10) CHARACTER SET latin1 DEFAULT '',
  `company_website` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `company_city` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `company_state` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id_experience`),
  UNIQUE KEY `id_experience` (`id_experience`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=hp8 COLLATE=hp8_bin;

-- Dumping data for table jbms.working_experiences: 3 rows
/*!40000 ALTER TABLE `working_experiences` DISABLE KEYS */;
INSERT IGNORE INTO `working_experiences` (`id_experience`, `id_user`, `job_title`, `company_name`, `id_expertise`, `description`, `start_date`, `end_date`, `on_load`, `company_website`, `company_city`, `company_state`, `active`) VALUES
	(1, 10, 'bvcbvcbvc', 'bvcbvc', '1', 'vcxbvcbvcbvcbvc', '1970-01-01', '2016-10-09', '0', 'bvcbvcbvc', '', '', 1),
	(2, 10, 'bnvnbvnbvnbv', 'nbvnbvnbv', '1', 'nbvnbnbvnbvnbvnbv', '2016-10-09', '2016-10-09', '0', '', '', '', 1),
	(3, 10, 'nbvnbvnbv', 'nbvnbvnbv', '1', 'nbvnbvnbvnbvnbv', '2016-10-02', '0000-00-00', '1', 'nbvnbvnbv', '', '', 1);
/*!40000 ALTER TABLE `working_experiences` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
