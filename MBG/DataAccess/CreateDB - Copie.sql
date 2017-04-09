
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `MBG`
--

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Robot` int(2) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `User`
--

INSERT INTO `user` ( `Login`, `Password`, `Name`, `Robot` ) VALUES ( 'admin', 'admin', 'admin', 0 );
INSERT INTO `user` ( `Login`, `Password`, `Name`, `Robot` ) VALUES ( 'test', 'test', 'test', 0 );

-- --------------------------------------------------------

--
-- Structure de la table `Mail`
--

CREATE TABLE IF NOT EXISTS `Mail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_User` int(11) NOT NULL,
  `ID_User_Sender` int(11) NOT NULL,
  `Text` varchar(500) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Mail`
--

-- --------------------------------------------------------

--
-- Structure de la table `ResourceType`
--

CREATE TABLE IF NOT EXISTS `ResourceType` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `ResourceType`
--

INSERT INTO `ResourceType` ( `Code` ) VALUES ( 'GOLD' );
INSERT INTO `ResourceType` ( `Code` ) VALUES ( 'OIL' );
INSERT INTO `ResourceType` ( `Code` ) VALUES ( 'IRON' );
INSERT INTO `ResourceType` ( `Code` ) VALUES ( 'PLASTIC' );
INSERT INTO `ResourceType` ( `Code` ) VALUES ( 'RUBBER' );
INSERT INTO `ResourceType` ( `Code` ) VALUES ( 'RICE' );
INSERT INTO `ResourceType` ( `Code` ) VALUES ( 'WHEAT' );

-- --------------------------------------------------------

--
-- Structure de la table `Port`
--

CREATE TABLE IF NOT EXISTS `Port` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_City` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `Capacity_Storage_M3` int(11) NOT NULL,
  `Capacity_Vehicle` int(11) NOT NULL,
  `Capacity_Passenger` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Port`
--

INSERT INTO `Port` ( `ID_City`, `Type`, `Name`, `Code`, `CapacityStorageM3`, `CapacityVehicle`, `CapacityPassenger` ) VALUES ( 1, 1, 'Charles de Gaulle', 'LFPG', 250000, 200, 8000 );
INSERT INTO `Port` ( `ID_City`, `Type`, `Name`, `Code`, `CapacityStorageM3`, `CapacityVehicle`, `CapacityPassenger` ) VALUES ( 1, 1, 'Orly', 'LFPO', 250000, 200, 8000 );

-- --------------------------------------------------------

--
-- Structure de la table `PortType`
--

CREATE TABLE IF NOT EXISTS `PortType` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `PortType`
--

INSERT INTO `PortType` ( `Code` ) VALUES ( 'AIRPORT' );
INSERT INTO `PortType` ( `Code` ) VALUES ( 'HELIPORT' );
INSERT INTO `PortType` ( `Code` ) VALUES ( 'SEAPORT' );
INSERT INTO `PortType` ( `Code` ) VALUES ( 'TRAIN_STATION' );
INSERT INTO `PortType` ( `Code` ) VALUES ( 'BUS_STATION' );
INSERT INTO `PortType` ( `Code` ) VALUES ( 'TRUCK_STATION' );

-- --------------------------------------------------------

--
-- Structure de la table `TransportLine`
--

CREATE TABLE IF NOT EXISTS `TransportLine` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Company` int(11) NOT NULL,
  `ID_Port_1` int(11) NOT NULL,
  `ID_Port_2` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `TransportLine`
--

-- --------------------------------------------------------

--
-- Structure de la table `TransportLineType`
--

CREATE TABLE IF NOT EXISTS `TransportLineType` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `TransportLineType`
--

INSERT INTO `TransportLineType` ( `Code` ) VALUES ( 'MERCHANDISE' );
INSERT INTO `TransportLineType` ( `Code` ) VALUES ( 'PASSENGER' );

-- --------------------------------------------------------

--
-- Structure de la table `Building`
--

CREATE TABLE IF NOT EXISTS `Building` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_City` int(11) NOT NULL,
  `ID_Company_Owner` int(11) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Type` int(11) NOT NULL,
  `Height_M` int(11) NOT NULL,
  `Surface_Residential_M2` int(11) NOT NULL,
  `Surface_Industrial_M2` int(11) NOT NULL,
  `Surface_Commercial_M2` int(11) NOT NULL,
  `Surface_Storage_M3` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Building`
--

-- --------------------------------------------------------

--
-- Structure de la table `Group`
--

CREATE TABLE IF NOT EXISTS `Group` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_User_Ceo` int(11) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Number` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Group`
--

-- --------------------------------------------------------

--
-- Structure de la table `Company`
--

CREATE TABLE IF NOT EXISTS `Company` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_User_Ceo` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Number` varchar(20) NOT NULL,
  `Gold_Money` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Company`
--

INSERT INTO `Company` ( `ID_User_Ceo`, `Type`, `Name`, `Number`, `Gold_Money` ) VALUES ( 'PASSENGER_TRANSPORT', 1, 'Microsoft', '123456789', 250000 );

-- --------------------------------------------------------

--
-- Structure de la table `Company_Type`
--

CREATE TABLE IF NOT EXISTS `Company_Type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Company_Type`
--

INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'PASSENGER_TRANSPORT' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'MERCHANDISE_TRANSPORT' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'RESOURCE_PRODUCTION' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'RESOURCE_VENDOR' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'PRODUCT_PRODUCTION' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'PRODUCT_DISTRIBUTION' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'PRODUCT_VENDOR' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'PERSON_SERVICE' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'COMPUTER_SERVICE' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'ESTATE_PRODUCTION' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'ESTATE_TRADING' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'HOTEL' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'BANK' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'INSURANCE' );
INSERT INTO `Company_Type` ( `Code` ) VALUES ( 'CINEMA' );

-- --------------------------------------------------------

--
-- Structure de la table `Brand`
--

CREATE TABLE IF NOT EXISTS `Brand` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Company` int(11) NOT NULL,
  `Name` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Brand`
--

-- --------------------------------------------------------

--
-- Structure de la table `Contract`
--

CREATE TABLE IF NOT EXISTS `Contract` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Company_1` int(11) NOT NULL,
  `ID_Company_2` int(11) NOT NULL,
  `Signature_Company_1` int(2) NOT NULL,
  `Signature_Company_2` int(2) NOT NULL,
  `Terminated` int(2) NOT NULL,
  `Type` int(11) NOT NULL,
  `Periodicity` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Cancel_Notice_Months` int(11) NOT NULL,
  `Cancel_Fee` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Contract`
--

-- --------------------------------------------------------

--
-- Structure de la table `ContractType`
--

CREATE TABLE IF NOT EXISTS `ContractType` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `ContractType`
--

INSERT INTO `ContractType` ( `Code` ) VALUES ( 'RENT' );
INSERT INTO `ContractType` ( `Code` ) VALUES ( 'BRAND_USAGE' );
INSERT INTO `ContractType` ( `Code` ) VALUES ( 'BRAND_SELLING' );
INSERT INTO `ContractType` ( `Code` ) VALUES ( 'PRODUCT_SELLING' );
INSERT INTO `ContractType` ( `Code` ) VALUES ( 'ESTATE_SELLING' );
INSERT INTO `ContractType` ( `Code` ) VALUES ( 'COMPANY_PART_SELLING' );
INSERT INTO `ContractType` ( `Code` ) VALUES ( 'COMPANY_SELLING' );
INSERT INTO `ContractType` ( `Code` ) VALUES ( 'GROUP_SELLING' );

-- --------------------------------------------------------

--
-- Structure de la table `ContractBrand`
--

CREATE TABLE IF NOT EXISTS `ContractBrand` (
  `ID_Contract` int(11) NOT NULL,
  `ID_Brand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `ContractBrand`
--

-- --------------------------------------------------------

--
-- Structure de la table `ContractSurface`
--

CREATE TABLE IF NOT EXISTS `ContractSurface` (
  `ID_Contract` int(11) NOT NULL,
  `Surface_Residential_M2` int(11) NOT NULL,
  `Surface_Industrial_M2` int(11) NOT NULL,
  `Surface_Commercial` int(11) NOT NULL,
  `Surface_Storage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `ContractSurface`
--

-- --------------------------------------------------------

--
-- Structure de la table `Agency`
--

CREATE TABLE IF NOT EXISTS `Agency` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Company` int(11) NOT NULL,
  `ID_Building` int(11) NOT NULL,
  `ID_Brand` int(11) NOT NULL,
  `Market_Percent` double NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Agency`
--

-- --------------------------------------------------------

--
-- Structure de la table `BankAccount`
--

CREATE TABLE IF NOT EXISTS `BankAccount` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Company_Owner` int(11) NOT NULL,
  `ID_Client` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Number` varchar(20) NOT NULL,
  `Money_Balance` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `BankAccount`
--

-- --------------------------------------------------------

--
-- Structure de la table `BankAccountType`
--

CREATE TABLE IF NOT EXISTS `BankAccountType` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `BankAccountType`
--

INSERT INTO `BankAccountType` ( `Code` ) VALUES ( 'PERSONAL' );
INSERT INTO `BankAccountType` ( `Code` ) VALUES ( 'PROFESSIONAL' );

-- --------------------------------------------------------

--
-- Structure de la table `MoneyTransfer`
--

CREATE TABLE IF NOT EXISTS `MoneyTransfer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Bank_Account_Sender` int(11) NOT NULL,
  `ID_Bank_Account_Receiver` int(11) NOT NULL,
  `money_amount` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MoneyTransfer`
--

-- --------------------------------------------------------

--
-- Structure de la table `Loan`
--

CREATE TABLE IF NOT EXISTS `Loan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Company_Lender` int(11) NOT NULL,
  `ID_Company_Beneficiary` int(11) NOT NULL,
  `Number` varchar(20) NOT NULL,
  `Interest_Rate` double NOT NULL,
  `Money_Due` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Loan`
--

-- --------------------------------------------------------

--
-- Structure de la table `MarketValue`
--

CREATE TABLE IF NOT EXISTS `MarketValue` (
  `Time` date NOT NULL,
  `ID_Company` int(11) NOT NULL,
  `Rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `MarketValue`
--

-- --------------------------------------------------------

--
-- Structure de la table `Action`
--

CREATE TABLE IF NOT EXISTS `Action` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Company` int(11) NOT NULL,
  `ID_User_Owner` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Action`
--

-- --------------------------------------------------------

--
-- Structure de la table `CompanyPart`
--

CREATE TABLE IF NOT EXISTS `CompanyPart` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Company` int(11) NOT NULL,
  `ID_User_Owner` int(11) NOT NULL,
  `Percentage` double NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `CompanyPart`
--

-- --------------------------------------------------------

--
-- Structure de la table `Country`
--

CREATE TABLE IF NOT EXISTS `Country` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `country`
--

INSERT INTO `Country` ( `Code` ) VALUES ( 'FRANCE' );
INSERT INTO `Country` ( `Code` ) VALUES ( 'GERMANY' );
INSERT INTO `Country` ( `Code` ) VALUES ( 'ENGLAND' );
INSERT INTO `Country` ( `Code` ) VALUES ( 'SPAIN' );
INSERT INTO `Country` ( `Code` ) VALUES ( 'IRELAND' );
INSERT INTO `Country` ( `Code` ) VALUES ( 'PORTUGAL' );

-- --------------------------------------------------------

--
-- Structure de la table `City`
--

CREATE TABLE IF NOT EXISTS `City` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Country` int(11) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Population` int(11) NOT NULL,
  `Latitude_Degree` double NOT NULL,
  `Longitude_Degree` double NOT NULL,
  `Factor_Tourism` double NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `City`
--

INSERT INTO `City` ( `ID_Country`, `Name`, `Population`, `Latitude_Degree`, `Longitude_Degree`, `Factor_Tourism` ) VALUES ( 1, 'Paris', 2500000, 48.856614, 2.352222, 1.0 );
INSERT INTO `City` ( `ID_Country`, `Name`, `Population`, `Latitude_Degree`, `Longitude_Degree`, `Factor_Tourism` ) VALUES ( 1, 'Lyon', 2500000, 45.764043, 4.835659, 1.0 );
INSERT INTO `City` ( `ID_Country`, `Name`, `Population`, `Latitude_Degree`, `Longitude_Degree`, `Factor_Tourism` ) VALUES ( 1, 'Nantes', 2500000, 47.218371, -1.553621, 1.0 );
INSERT INTO `City` ( `ID_Country`, `Name`, `Population`, `Latitude_Degree`, `Longitude_Degree`, `Factor_Tourism` ) VALUES ( 2, 'Berlin', 2500000, 52.523405, 13.4114, 1.0 );
INSERT INTO `City` ( `ID_Country`, `Name`, `Population`, `Latitude_Degree`, `Longitude_Degree`, `Factor_Tourism` ) VALUES ( 3, 'London', 2500000, 52.523405, 13.4114, 1.0 );

-- --------------------------------------------------------

--
-- Structure de la table `Resource`
--

CREATE TABLE IF NOT EXISTS `Resource` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_City` int(11) NOT NULL,
  `ID_Resource` int(11) NOT NULL,
  `Production_Month_M3` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Resource`
--

-- --------------------------------------------------------

--
-- Structure de la table `ResourceStock`
--

CREATE TABLE IF NOT EXISTS `ResourceStock` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Building` int(11) NOT NULL,
  `ID_Resource` int(11) NOT NULL,
  `Quantity_M3` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `ResourceStock`
--

-- --------------------------------------------------------

--
-- Structure de la table `Dictionary_fr`
--

CREATE TABLE IF NOT EXISTS `Dictionary_fr` (
  `Code` varchar(20) NOT NULL,
  `Name` varchar(40) NOT NULL,
  PRIMARY KEY (`Code`),
  UNIQUE KEY `Code` (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Dictionary_fr`
--

INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'GOLD', 'Or' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'IRON', 'Fer' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'PLASTIC', 'Plastique' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'OIL', 'Pétrole' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'RICE', 'Riz' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'WHEAT', 'Blé' );

INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'FRANCE', 'France' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'SPAIN', 'Espagne' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'ENGLAND', 'Angleterre' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'IRELAND', 'Irlande' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'PORTUGAL', 'Portugal' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'GERMANY', 'Allemagne' );

INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'AIRPORT', 'Aéroport' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'HELIPORT', 'Héliport' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'SEAPORT', 'Port maritime' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'TRAIN_STATION', 'Station de train' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'BUS_STATION', 'Station de bus' );
INSERT INTO `Dictionary_fr` ( `Code`, `Name` ) VALUES ( 'TRUCK_STATION', 'Station routière' );
