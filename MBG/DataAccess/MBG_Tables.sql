
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `MBG`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(60) NOT NULL,
  `robot` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` ( `login`, `password`, `name`, `human` ) VALUES ( 'admin', 'admin', 'admin', 1 );

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_user_sender` int(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `mail`
--

-- --------------------------------------------------------

--
-- Structure de la table `resource_type`
--

CREATE TABLE IF NOT EXISTS `resource_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `resource_type`
--

INSERT INTO `resource_type` ( `code` ) VALUES ( 'GOLD' );
INSERT INTO `resource_type` ( `code` ) VALUES ( 'OIL' );
INSERT INTO `resource_type` ( `code` ) VALUES ( 'IRON' );
INSERT INTO `resource_type` ( `code` ) VALUES ( 'PLASTIC' );
INSERT INTO `resource_type` ( `code` ) VALUES ( 'RUBBER' );
INSERT INTO `resource_type` ( `code` ) VALUES ( 'RICE' );
INSERT INTO `resource_type` ( `code` ) VALUES ( 'WHEAT' );

-- --------------------------------------------------------

--
-- Structure de la table `port`
--

CREATE TABLE IF NOT EXISTS `port` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_city` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `code` varchar(10) NOT NULL,
  `capacity_storage_m3` int(11) NOT NULL,
  `capacity_vehicle` int(11) NOT NULL,
  `capacity_passenger` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `port`
--

INSERT INTO `port` ( `id_city`, `type`, `name`, `code`, `capacity_storage_m3`, `capacity_vehicle`, `capacity_passenger` ) VALUES ( 1, 1, 'Charles de Gaulle', 'LFPG', 250000, 200, 8000 );
INSERT INTO `port` ( `id_city`, `type`, `name`, `code`, `capacity_storage_m3`, `capacity_vehicle`, `capacity_passenger` ) VALUES ( 1, 1, 'Orly', 'LFPO', 250000, 200, 8000 );

-- --------------------------------------------------------

--
-- Structure de la table `port_type`
--

CREATE TABLE IF NOT EXISTS `port_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `port_type`
--

INSERT INTO `port_type` ( `code` ) VALUES ( 'AIRPORT' );
INSERT INTO `port_type` ( `code` ) VALUES ( 'HELIPORT' );
INSERT INTO `port_type` ( `code` ) VALUES ( 'SEAPORT' );
INSERT INTO `port_type` ( `code` ) VALUES ( 'TRAIN_STATION' );
INSERT INTO `port_type` ( `code` ) VALUES ( 'BUS_STATION' );
INSERT INTO `port_type` ( `code` ) VALUES ( 'TRUCK_STATION' );

-- --------------------------------------------------------

--
-- Structure de la table `transport_line`
--

CREATE TABLE IF NOT EXISTS `transport_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_port_1` int(11) NOT NULL,
  `id_port_2` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `transport_line`
--

-- --------------------------------------------------------

--
-- Structure de la table `transport_line_type`
--

CREATE TABLE IF NOT EXISTS `transport_line_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `transport_line_type`
--

INSERT INTO `transport_line_type` ( `code` ) VALUES ( 'MERCHANDISE' );
INSERT INTO `transport_line_type` ( `code` ) VALUES ( 'PASSENGER' );

-- --------------------------------------------------------

--
-- Structure de la table `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_city` int(11) NOT NULL,
  `id_company_owner` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `type` int(11) NOT NULL,
  `height_m` int(11) NOT NULL,
  `surface_residential_m2` int(11) NOT NULL,
  `surface_industrial_m2` int(11) NOT NULL,
  `surface_commercial_m2` int(11) NOT NULL,
  `surface_storage_m3` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `building`
--

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_ceo` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `number` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `group`
--

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_ceo` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `number` varchar(20) NOT NULL,
  `gold_money` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `company`
--

-- --------------------------------------------------------

--
-- Structure de la table `company_type`
--

CREATE TABLE IF NOT EXISTS `company_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `company_type`
--

INSERT INTO `company_type` ( `code` ) VALUES ( 'PASSENGER_TRANSPORT' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'MERCHANDISE_TRANSPORT' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'RESOURCE_PRODUCTION' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'RESOURCE_VENDOR' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'PRODUCT_PRODUCTION' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'PRODUCT_DISTRIBUTION' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'PRODUCT_VENDOR' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'PERSON_SERVICE' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'COMPUTER_SERVICE' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'ESTATE_PRODUCTION' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'ESTATE_TRADING' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'HOTEL' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'BANK' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'INSURANCE' );
INSERT INTO `company_type` ( `code` ) VALUES ( 'CINEMA' );

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `brand`
--

-- --------------------------------------------------------

--
-- Structure de la table `contract`
--

CREATE TABLE IF NOT EXISTS `contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company_1` int(11) NOT NULL,
  `id_company_2` int(11) NOT NULL,
  `signature_company_1` int(2) NOT NULL,
  `signature_company_2` int(2) NOT NULL,
  `terminated` int(2) NOT NULL,
  `type` int(11) NOT NULL,
  `periodicity` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `cancel_notice_months` int(11) NOT NULL,
  `cancel_fee` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `contract`
--

-- --------------------------------------------------------

--
-- Structure de la table `contract_type`
--

CREATE TABLE IF NOT EXISTS `contract_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `contract_type`
--

INSERT INTO `contract_type` ( `code` ) VALUES ( 'RENT' );
INSERT INTO `contract_type` ( `code` ) VALUES ( 'BRAND_USAGE' );
INSERT INTO `contract_type` ( `code` ) VALUES ( 'BRAND_SELLING' );
INSERT INTO `contract_type` ( `code` ) VALUES ( 'PRODUCT_SELLING' );
INSERT INTO `contract_type` ( `code` ) VALUES ( 'ESTATE_SELLING' );
INSERT INTO `contract_type` ( `code` ) VALUES ( 'COMPANY_PART_SELLING' );
INSERT INTO `contract_type` ( `code` ) VALUES ( 'COMPANY_SELLING' );
INSERT INTO `contract_type` ( `code` ) VALUES ( 'GROUP_SELLING' );

-- --------------------------------------------------------

--
-- Structure de la table `contract_brand`
--

CREATE TABLE IF NOT EXISTS `contract_brand` (
  `id_contract` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `contract_brand`
--

-- --------------------------------------------------------

--
-- Structure de la table `contract_surface`
--

CREATE TABLE IF NOT EXISTS `contract_surface` (
  `id_contract` int(11) NOT NULL,
  `surface_residential_m2` int(11) NOT NULL,
  `surface_industrial_m2` int(11) NOT NULL,
  `surface_commercial` int(11) NOT NULL,
  `surface_storage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `contract_surface`
--

-- --------------------------------------------------------

--
-- Structure de la table `agency`
--

CREATE TABLE IF NOT EXISTS `agency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_building` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `market_percent` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `agency`
--

-- --------------------------------------------------------

--
-- Structure de la table `bank_account`
--

CREATE TABLE IF NOT EXISTS `bank_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company_owner` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `money_balance` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `bank_account`
--

-- --------------------------------------------------------

--
-- Structure de la table `bank_account_type`
--

CREATE TABLE IF NOT EXISTS `bank_account_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `bank_account_type`
--

INSERT INTO `bank_account_type` ( `code` ) VALUES ( 'PERSONAL' );
INSERT INTO `bank_account_type` ( `code` ) VALUES ( 'PROFESSIONAL' );

-- --------------------------------------------------------

--
-- Structure de la table `money_transfer`
--

CREATE TABLE IF NOT EXISTS `money_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bank_account_sender` int(11) NOT NULL,
  `id_bank_account_receiver` int(11) NOT NULL,
  `money_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `money_transfer`
--

-- --------------------------------------------------------

--
-- Structure de la table `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company_lender` int(11) NOT NULL,
  `id_company_beneficiary` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `interest_rate` double NOT NULL,
  `money_due` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `loan`
--

-- --------------------------------------------------------

--
-- Structure de la table `market_value`
--

CREATE TABLE IF NOT EXISTS `market_value` (
  `time` date NOT NULL,
  `id_company` int(11) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `market_value`
--

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_user_owner` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `action`
--

-- --------------------------------------------------------

--
-- Structure de la table `company_part`
--

CREATE TABLE IF NOT EXISTS `company_part` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_user_owner` int(11) NOT NULL,
  `percentage` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `company_part`
--

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `country`
--

INSERT INTO `country` ( `code` ) VALUES ( 'FRANCE' );
INSERT INTO `country` ( `code` ) VALUES ( 'GERMANY' );
INSERT INTO `country` ( `code` ) VALUES ( 'ENGLAND' );
INSERT INTO `country` ( `code` ) VALUES ( 'SPAIN' );
INSERT INTO `country` ( `code` ) VALUES ( 'IRELAND' );
INSERT INTO `country` ( `code` ) VALUES ( 'PORTUGAL' );

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_country` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `population` int(11) NOT NULL,
  `latitude_degree` double NOT NULL,
  `longitude_degree` double NOT NULL,
  `factor_tourism` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `city`
--

INSERT INTO `city` ( `id_country`, `name`, `population`, `latitude`, `longitude`, `factor_tourism` ) VALUES ( 1, 'Paris', 2500000, 48.856614, 2.352222, 1.0 );
INSERT INTO `city` ( `id_country`, `name`, `population`, `latitude`, `longitude`, `factor_tourism` ) VALUES ( 1, 'Lyon', 2500000, 45.764043, 4.835659, 1.0 );
INSERT INTO `city` ( `id_country`, `name`, `population`, `latitude`, `longitude`, `factor_tourism` ) VALUES ( 1, 'Nantes', 2500000, 47.218371, -1.553621, 1.0 );
INSERT INTO `city` ( `id_country`, `name`, `population`, `latitude`, `longitude`, `factor_tourism` ) VALUES ( 2, 'Berlin', 2500000, 52.523405, 13.4114, 1.0 );
INSERT INTO `city` ( `id_country`, `name`, `population`, `latitude`, `longitude`, `factor_tourism` ) VALUES ( 3, 'London', 2500000, 52.523405, 13.4114, 1.0 );

-- --------------------------------------------------------

--
-- Structure de la table `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_city` int(11) NOT NULL,
  `id_resource` int(11) NOT NULL,
  `production_month_m3` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `resource`
--

-- --------------------------------------------------------

--
-- Structure de la table `resource_stock`
--

CREATE TABLE IF NOT EXISTS `resource_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_building` int(11) NOT NULL,
  `id_resource` int(11) NOT NULL,
  `quantity_m3` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `resource_stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `dictionary_fr`
--

CREATE TABLE IF NOT EXISTS `dictionary_fr` (
  `code` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `dictionary_fr`
--

INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'GOLD', 'Or' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'IRON', 'Fer' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'PLASTIC', 'Plastique' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'OIL', 'Pétrole' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'RICE', 'Riz' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'WHEAT', 'Blé' );

INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'FRANCE', 'France' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'SPAIN', 'Espagne' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'ENGLAND', 'Angleterre' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'IRELAND', 'Irlande' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'PORTUGAL', 'Portugal' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'GERMANY', 'Allemagne' );

INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'AIRPORT', 'Aéroport' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'HELIPORT', 'Héliport' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'SEAPORT', 'Port maritime' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'TRAIN_STATION', 'Station de train' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'BUS_STATION', 'Station de bus' );
INSERT INTO `dictionary_fr` ( `code`, `name` ) VALUES ( 'TRUCK_STATION', 'Station routière' );
