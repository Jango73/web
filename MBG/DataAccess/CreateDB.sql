SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';





-- -----------------------------------------------------

-- Table `Users`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Users` ;



CREATE  TABLE IF NOT EXISTS `Users` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Login` VARCHAR(45) NOT NULL ,

  `Password` VARCHAR(45) NOT NULL ,

  `Name` VARCHAR(60) NOT NULL ,

  `Robot` TINYINT NOT NULL ,

  `Cash` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  UNIQUE INDEX `Login_UNIQUE` (`Login` ASC) ,

  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Contacts`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Contacts` ;



CREATE  TABLE IF NOT EXISTS `Contacts` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_User_Owner` INT NOT NULL ,

  `ID_User_Contact` INT NOT NULL ,

  `Note` VARCHAR(100) NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_ContactsUsers1` (`ID_User_Owner` ASC) ,

  INDEX `FK_ContactsUsers2` (`ID_User_Contact` ASC) ,

  CONSTRAINT `FK_ContactsUsers1`

    FOREIGN KEY (`ID_User_Owner` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_ContactsUsers2`

    FOREIGN KEY (`ID_User_Contact` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `GovernmentType`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `GovernmentType` ;



CREATE  TABLE IF NOT EXISTS `GovernmentType` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Code` VARCHAR(20) NOT NULL ,

  `Police_Power` DOUBLE NOT NULL ,

  `Military_Power` DOUBLE NOT NULL ,

  `Court_Power` DOUBLE NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Countries`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Countries` ;



CREATE  TABLE IF NOT EXISTS `Countries` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Code` VARCHAR(20) NOT NULL ,

  `ID_GovernmentType` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_CountriesGovernment_Types` (`ID_GovernmentType` ASC) ,

  CONSTRAINT `FK_CountriesGovernment_Types`

    FOREIGN KEY (`ID_GovernmentType` )

    REFERENCES `GovernmentType` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Lifetime`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Lifetime` ;



CREATE  TABLE IF NOT EXISTS `Lifetime` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `IssueDate` DATETIME NOT NULL ,

  `CreationDate` DATETIME NULL ,

  `TerminationDate` DATETIME NULL ,

  `IsActive` TINYINT NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Groups`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Groups` ;



CREATE  TABLE IF NOT EXISTS `Groups` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_User_Ceo` INT NOT NULL ,

  `ID_Country` INT NOT NULL ,

  `ID_Lifetime` INT NOT NULL ,

  `Name` VARCHAR(60) NOT NULL ,

  `Number` VARCHAR(20) NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_GroupsUsers` (`ID_User_Ceo` ASC) ,

  INDEX `FK_GroupsCountries` (`ID_Country` ASC) ,

  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) ,

  INDEX `FK_GroupsLifetime` (`ID_Lifetime` ASC) ,

  CONSTRAINT `FK_GroupsUsers`

    FOREIGN KEY (`ID_User_Ceo` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_GroupsCountries`

    FOREIGN KEY (`ID_Country` )

    REFERENCES `Countries` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_GroupsLifetime`

    FOREIGN KEY (`ID_Lifetime` )

    REFERENCES `Lifetime` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `CompanyType`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `CompanyType` ;



CREATE  TABLE IF NOT EXISTS `CompanyType` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Code` VARCHAR(20) NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Companies`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Companies` ;



CREATE  TABLE IF NOT EXISTS `Companies` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Group` INT NULL ,

  `ID_User_Ceo` INT NOT NULL ,

  `ID_Country` INT NOT NULL ,

  `ID_Type` INT NOT NULL ,

  `ID_Lifetime` INT NOT NULL ,

  `Name` VARCHAR(60) NOT NULL ,

  `Number` VARCHAR(20) NOT NULL ,

  `Cash` INT NOT NULL ,

  `Worker_Daily_Wage` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_CompaniesGroups` (`ID_Group` ASC) ,

  INDEX `FK_CompaniesUsers` (`ID_User_Ceo` ASC) ,

  INDEX `FK_CompaniesCompanyType` (`ID_Type` ASC) ,

  INDEX `FK_CompaniesCountries` (`ID_Country` ASC) ,

  INDEX `FK_CompaniesLifetime` (`ID_Lifetime` ASC) ,

  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) ,

  CONSTRAINT `FK_CompaniesGroups`

    FOREIGN KEY (`ID_Group` )

    REFERENCES `Groups` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_CompaniesUsers`

    FOREIGN KEY (`ID_User_Ceo` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_CompaniesCompanyType`

    FOREIGN KEY (`ID_Type` )

    REFERENCES `CompanyType` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_CompaniesCountries`

    FOREIGN KEY (`ID_Country` )

    REFERENCES `Countries` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_CompaniesLifetime`

    FOREIGN KEY (`ID_Lifetime` )

    REFERENCES `Lifetime` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `CompanyParts`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `CompanyParts` ;



CREATE  TABLE IF NOT EXISTS `CompanyParts` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Company` INT NOT NULL ,

  `ID_User_Owner` INT NOT NULL ,

  `Amount` INT NOT NULL ,

  `Value_Single_Part` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_Company_PartsCompanies` (`ID_Company` ASC) ,

  INDEX `FK_Company_PartsUsers` (`ID_User_Owner` ASC) ,

  CONSTRAINT `FK_Company_PartsCompanies`

    FOREIGN KEY (`ID_Company` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_Company_PartsUsers`

    FOREIGN KEY (`ID_User_Owner` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Mail`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Mail` ;



CREATE  TABLE IF NOT EXISTS `Mail` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_User_Owner` INT NOT NULL ,

  `ID_User_Sender` INT NOT NULL ,

  `Text` VARCHAR(500) NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_MailUsers1` (`ID_User_Owner` ASC) ,

  INDEX `FK_MailUsers2` (`ID_User_Sender` ASC) ,

  CONSTRAINT `FK_MailUsers1`

    FOREIGN KEY (`ID_User_Owner` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_MailUsers2`

    FOREIGN KEY (`ID_User_Sender` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Brands`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Brands` ;



CREATE  TABLE IF NOT EXISTS `Brands` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Company` INT NOT NULL ,

  `ID_Lifetime` INT NOT NULL ,

  `Name` VARCHAR(60) NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_BrandsCompanies` (`ID_Company` ASC) ,

  INDEX `FK_BrandsLifetime` (`ID_Lifetime` ASC) ,

  CONSTRAINT `FK_BrandsCompanies`

    FOREIGN KEY (`ID_Company` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_BrandsLifetime`

    FOREIGN KEY (`ID_Lifetime` )

    REFERENCES `Lifetime` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Cities`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Cities` ;



CREATE  TABLE IF NOT EXISTS `Cities` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Country` INT NOT NULL ,

  `Code` VARCHAR(20) NOT NULL ,

  `Population` INT NOT NULL ,

  `Latitude_Degree` DOUBLE NOT NULL ,

  `Longitude_Degree` DOUBLE NOT NULL ,

  `Factor_Tourism` DOUBLE NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_CitiesCountries` (`ID_Country` ASC) ,

  CONSTRAINT `FK_CitiesCountries`

    FOREIGN KEY (`ID_Country` )

    REFERENCES `Countries` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Buildings`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Buildings` ;



CREATE  TABLE IF NOT EXISTS `Buildings` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_City` INT NOT NULL ,

  `ID_Company_Owner` INT NULL ,

  `ID_User_Owner` INT NULL ,

  `ID_Type` INT NOT NULL ,

  `Name` VARCHAR(60) NOT NULL ,

  `Latitude_Degree` DOUBLE NOT NULL ,

  `Longitude_Degree` DOUBLE NOT NULL ,

  `Height_M` INT NOT NULL ,

  `Surface_Residential_M2` INT NOT NULL ,

  `Surface_Industrial_M2` INT NOT NULL ,

  `Surface_Commercial_M2` INT NOT NULL ,

  `Surface_Storage_M3` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_BuildingsCities` (`ID_City` ASC) ,

  INDEX `FK_BuildingsCompanies` (`ID_Company_Owner` ASC) ,

  INDEX `FK_BuildingsUsers` (`ID_User_Owner` ASC) ,

  CONSTRAINT `FK_BuildingsCities`

    FOREIGN KEY (`ID_City` )

    REFERENCES `Cities` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_BuildingsCompanies`

    FOREIGN KEY (`ID_Company_Owner` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_BuildingsUsers`

    FOREIGN KEY (`ID_User_Owner` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Agencies`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Agencies` ;



CREATE  TABLE IF NOT EXISTS `Agencies` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Company` INT NOT NULL ,

  `ID_Building` INT NOT NULL ,

  `ID_Brand` INT NULL ,

  `ID_Contract_Rent` INT NULL ,

  `Headquarters` TINYINT NOT NULL ,

  `Market_Percent` DOUBLE NOT NULL ,

  `Name` VARCHAR(60) NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_AgenciesCompanies` (`ID_Company` ASC) ,

  INDEX `FK_AgenciesBrands` (`ID_Brand` ASC) ,

  INDEX `FK_AgenciesContracts` (`ID_Contract_Rent` ASC) ,

  INDEX `FK_AgenciesBuildings` (`ID_Building` ASC) ,

  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) ,

  CONSTRAINT `FK_AgenciesCompanies`

    FOREIGN KEY (`ID_Company` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_AgenciesBrands`

    FOREIGN KEY (`ID_Brand` )

    REFERENCES `Brands` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_AgenciesContracts`

    FOREIGN KEY (`ID_Contract_Rent` )

    REFERENCES `Contacts` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_AgenciesBuildings`

    FOREIGN KEY (`ID_Building` )

    REFERENCES `Buildings` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `MarketType`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `MarketType` ;



CREATE  TABLE IF NOT EXISTS `MarketType` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Code` VARCHAR(20) NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Market`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Market` ;



CREATE  TABLE IF NOT EXISTS `Market` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_User_Owner` INT NOT NULL ,

  `ID_Company_Owner` INT NOT NULL ,

  `ID_Type` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_MarketUsers` (`ID_User_Owner` ASC) ,

  INDEX `FK_MarketCompanies` (`ID_Company_Owner` ASC) ,

  INDEX `FK_MarketMarketType` (`ID_Type` ASC) ,

  CONSTRAINT `FK_MarketUsers`

    FOREIGN KEY (`ID_User_Owner` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_MarketCompanies`

    FOREIGN KEY (`ID_Company_Owner` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_MarketMarketType`

    FOREIGN KEY (`ID_Type` )

    REFERENCES `MarketType` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `ContractType`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `ContractType` ;



CREATE  TABLE IF NOT EXISTS `ContractType` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Code` VARCHAR(20) NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `ContractDue`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `ContractDue` ;



CREATE  TABLE IF NOT EXISTS `ContractDue` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Type` INT NOT NULL ,

  `ID_Brand` INT NULL ,

  `ID_Resource_Type` INT NULL ,

  `ID_Product_Type` INT NULL ,

  `ID_Building` INT NULL ,

  `ID_Surface` INT NULL ,

  `ID_Company` INT NULL ,

  `ID_Group` INT NULL ,

  `Amount` INT NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Contracts`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Contracts` ;



CREATE  TABLE IF NOT EXISTS `Contracts` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Company_1` INT NOT NULL ,

  `ID_Company_2` INT NOT NULL ,

  `ID_Type` INT NOT NULL ,

  `ID_Lifetime` INT NOT NULL ,

  `ID_Due_1` INT NOT NULL ,

  `ID_Due_2` INT NOT NULL ,

  `Number` VARCHAR(20) NOT NULL ,

  `Signature_Company_1` TINYINT NOT NULL ,

  `Signature_Company_2` TINYINT NOT NULL ,

  `Periodicity_Months` INT NOT NULL ,

  `Periodicity_Days` INT NOT NULL ,

  `Cancel_Notice_Days` INT NOT NULL ,

  `Cancel_Fee` INT NOT NULL ,

  `Last_Statisfied_Time` DATETIME NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_ContractsCompanies1` (`ID_Company_1` ASC) ,

  INDEX `FK_ContractsCompanies2` (`ID_Company_2` ASC) ,

  INDEX `FK_ContractsContractType` (`ID_Type` ASC) ,

  INDEX `FK_ContractsLifetime` (`ID_Lifetime` ASC) ,

  INDEX `FK_ContractsContractDue1` (`ID_Due_1` ASC) ,

  INDEX `FK_ContractsContractDue2` (`ID_Due_2` ASC) ,

  CONSTRAINT `FK_ContractsCompanies1`

    FOREIGN KEY (`ID_Company_1` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_ContractsCompanies2`

    FOREIGN KEY (`ID_Company_2` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_ContractsContractType`

    FOREIGN KEY (`ID_Type` )

    REFERENCES `ContractType` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_ContractsLifetime`

    FOREIGN KEY (`ID_Lifetime` )

    REFERENCES `Lifetime` (`ID` )

    ON DELETE RESTRICT

    ON UPDATE RESTRICT,

  CONSTRAINT `FK_ContractsContractDue1`

    FOREIGN KEY (`ID_Due_1` )

    REFERENCES `ContractDue` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_ContractsContractDue2`

    FOREIGN KEY (`ID_Due_2` )

    REFERENCES `ContractDue` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `BankAccountType`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `BankAccountType` ;



CREATE  TABLE IF NOT EXISTS `BankAccountType` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Code` VARCHAR(20) NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `BankAccounts`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `BankAccounts` ;



CREATE  TABLE IF NOT EXISTS `BankAccounts` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Company_Owner` INT NOT NULL ,

  `ID_Company_Client` INT NULL ,

  `ID_User_Client` INT NULL ,

  `ID_Type` INT NOT NULL ,

  `Number` VARCHAR(20) NOT NULL ,

  `Money_Balance` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_BankAccountsCompanies1` (`ID_Company_Owner` ASC) ,

  INDEX `FK_BankAccountsCompanies2` (`ID_Company_Client` ASC) ,

  INDEX `FK_BankAccountsUsers` (`ID_User_Client` ASC) ,

  INDEX `FK_BankAccountsBankAccountType` (`ID_Type` ASC) ,

  CONSTRAINT `FK_BankAccountsCompanies1`

    FOREIGN KEY (`ID_Company_Owner` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_BankAccountsCompanies2`

    FOREIGN KEY (`ID_Company_Client` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_BankAccountsUsers`

    FOREIGN KEY (`ID_User_Client` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_BankAccountsBankAccountType`

    FOREIGN KEY (`ID_Type` )

    REFERENCES `BankAccountType` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Loans`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Loans` ;



CREATE  TABLE IF NOT EXISTS `Loans` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Company_Lender` INT NULL ,

  `ID_User_Lender` INT NULL ,

  `ID_Company_Borrower` INT NOT NULL ,

  `ID_Bank_Account_Lender` INT NOT NULL ,

  `ID_Bank_Account_Borrower` INT NOT NULL ,

  `Number` VARCHAR(20) NOT NULL ,

  `Interest_Rate` DOUBLE NOT NULL ,

  `Money_Due` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_LoansCompanies1` (`ID_Company_Lender` ASC) ,

  INDEX `FK_LoansBankAccounts1` (`ID_Bank_Account_Lender` ASC) ,

  INDEX `FK_LoansUsers` (`ID_User_Lender` ASC) ,

  INDEX `FK_LoansBankAccounts2` (`ID_Bank_Account_Borrower` ASC) ,

  INDEX `FK_LoansCompanies2` (`ID_Company_Borrower` ASC) ,

  CONSTRAINT `FK_LoansCompanies1`

    FOREIGN KEY (`ID_Company_Lender` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_LoansBankAccounts1`

    FOREIGN KEY (`ID_Bank_Account_Lender` )

    REFERENCES `BankAccounts` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_LoansUsers`

    FOREIGN KEY (`ID_User_Lender` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_LoansBankAccounts2`

    FOREIGN KEY (`ID_Bank_Account_Borrower` )

    REFERENCES `BankAccounts` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_LoansCompanies2`

    FOREIGN KEY (`ID_Company_Borrower` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `MoneyTransfers`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `MoneyTransfers` ;



CREATE  TABLE IF NOT EXISTS `MoneyTransfers` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Bank_Account_Sender` INT NOT NULL ,

  `ID_Bank_Account_Receiver` INT NOT NULL ,

  `Number` VARCHAR(20) NOT NULL ,

  `Money_Amount` INT NOT NULL ,

  `Issue_Date` DATETIME NOT NULL ,

  `Execution_Date` DATETIME NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_MoneyTransfersBankAccounts1` (`ID_Bank_Account_Sender` ASC) ,

  INDEX `FK_MoneyTransfersBankAccounts2` (`ID_Bank_Account_Receiver` ASC) ,

  CONSTRAINT `FK_MoneyTransfersBankAccounts1`

    FOREIGN KEY (`ID_Bank_Account_Sender` )

    REFERENCES `BankAccounts` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_MoneyTransfersBankAccounts2`

    FOREIGN KEY (`ID_Bank_Account_Receiver` )

    REFERENCES `BankAccounts` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Ports`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Ports` ;



CREATE  TABLE IF NOT EXISTS `Ports` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_City` INT NOT NULL ,

  `ID_Company_Owner` INT NOT NULL ,

  `Type` INT NOT NULL ,

  `Name` VARCHAR(60) NOT NULL ,

  `Port_Code` VARCHAR(10) NOT NULL ,

  `Capacity_Storage_M3` INT NOT NULL ,

  `Capacity_Vehicle` INT NOT NULL ,

  `Capacity_Passenger` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_PortsCities` (`ID_City` ASC) ,

  CONSTRAINT `FK_PortsCities`

    FOREIGN KEY (`ID_City` )

    REFERENCES `Cities` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `VehicleType`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `VehicleType` ;



CREATE  TABLE IF NOT EXISTS `VehicleType` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Code` VARCHAR(20) NOT NULL ,

  `Land` TINYINT NOT NULL ,

  `Air` TINYINT NOT NULL ,

  `Sea` TINYINT NOT NULL ,

  `Radius_KM` INT NOT NULL ,

  `Capacity_Storage_M3` INT NOT NULL ,

  `Capacity_Vehicle` INT NOT NULL ,

  `Capacity_Passenger` INT NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Vehicles`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Vehicles` ;



CREATE  TABLE IF NOT EXISTS `Vehicles` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Company_Owner` INT NOT NULL ,

  `ID_Type` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_VehiclesCompany` (`ID_Company_Owner` ASC) ,

  INDEX `FK_VehiclesVehicleType` (`ID_Type` ASC) ,

  CONSTRAINT `FK_VehiclesCompany`

    FOREIGN KEY (`ID_Company_Owner` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_VehiclesVehicleType`

    FOREIGN KEY (`ID_Type` )

    REFERENCES `VehicleType` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `TransportLines`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `TransportLines` ;



CREATE  TABLE IF NOT EXISTS `TransportLines` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Company` INT NOT NULL ,

  `ID_Vehicle` INT NOT NULL ,

  `ID_Port_1` INT NOT NULL ,

  `ID_Port_2` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_TransportLinesPorts1` (`ID_Port_1` ASC) ,

  INDEX `FK_TransportLinesPorts2` (`ID_Port_2` ASC) ,

  INDEX `FK_TransportLinesVehicles` (`ID_Vehicle` ASC) ,

  INDEX `FK_TransportLinesCompanies` (`ID_Company` ASC) ,

  CONSTRAINT `FK_TransportLinesPorts1`

    FOREIGN KEY (`ID_Port_1` )

    REFERENCES `Ports` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_TransportLinesPorts2`

    FOREIGN KEY (`ID_Port_2` )

    REFERENCES `Ports` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_TransportLinesVehicles`

    FOREIGN KEY (`ID_Vehicle` )

    REFERENCES `Vehicles` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_TransportLinesCompanies`

    FOREIGN KEY (`ID_Company` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `MarketResource`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `MarketResource` ;



CREATE  TABLE IF NOT EXISTS `MarketResource` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Market` INT NOT NULL ,

  `ID_Type` INT NOT NULL ,

  `Amount` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_MarketResourceMarket` (`ID_Market` ASC) ,

  CONSTRAINT `FK_MarketResourceMarket`

    FOREIGN KEY (`ID_Market` )

    REFERENCES `Market` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Transactions`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Transactions` ;



CREATE  TABLE IF NOT EXISTS `Transactions` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_BankAccount` INT NOT NULL ,

  `Date` DATETIME NOT NULL ,

  `Amount` INT NOT NULL ,

  `Label` VARCHAR(100) NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_TransactionsBankAccounts` (`ID_BankAccount` ASC) ,

  CONSTRAINT `FK_TransactionsBankAccounts`

    FOREIGN KEY (`ID_BankAccount` )

    REFERENCES `BankAccounts` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Gangs`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Gangs` ;



CREATE  TABLE IF NOT EXISTS `Gangs` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_User_Owner` INT NOT NULL ,

  `Name` VARCHAR(60) NOT NULL ,

  `Cash` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Gangsters`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Gangsters` ;



CREATE  TABLE IF NOT EXISTS `Gangsters` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Gang` INT NOT NULL ,

  `Name` VARCHAR(60) NOT NULL ,

  `Gender` TINYINT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_GangstersGangs` (`ID_Gang` ASC) ,

  CONSTRAINT `FK_GangstersGangs`

    FOREIGN KEY (`ID_Gang` )

    REFERENCES `Gangs` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Resources`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Resources` ;



CREATE  TABLE IF NOT EXISTS `Resources` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_City` INT NOT NULL ,

  `ID_Type` INT NOT NULL ,

  `Production_Day_M3` INT NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `MarketValues`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `MarketValues` ;



CREATE  TABLE IF NOT EXISTS `MarketValues` (

  `ID_Company` INT NOT NULL ,

  `Time` DATETIME NOT NULL ,

  `Rate` FLOAT NOT NULL )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `ResourceStocks`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `ResourceStocks` ;



CREATE  TABLE IF NOT EXISTS `ResourceStocks` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `ID_Building` INT NULL ,

  `ID_Vehicle` INT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_ResourceStocksBuildings` (`ID_Building` ASC) ,

  INDEX `FK_ResourceStocksVehicles` (`ID_Vehicle` ASC) ,

  CONSTRAINT `FK_ResourceStocksBuildings`

    FOREIGN KEY (`ID_Building` )

    REFERENCES `Buildings` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_ResourceStocksVehicles`

    FOREIGN KEY (`ID_Vehicle` )

    REFERENCES `Vehicles` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `ResourceType`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `ResourceType` ;



CREATE  TABLE IF NOT EXISTS `ResourceType` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Code` VARCHAR(20) NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `PoliceInvestigations`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `PoliceInvestigations` ;



CREATE  TABLE IF NOT EXISTS `PoliceInvestigations` (

  `ID` INT NOT NULL ,

  `ID_User` INT NULL ,

  `ID_Company` INT NULL ,

  `Duration_Days` INT NOT NULL ,

  PRIMARY KEY (`ID`) ,

  INDEX `FK_PoliceInvestigationsUsers` (`ID_User` ASC) ,

  INDEX `FK_PoliceInvestigationsCompanies` (`ID_Company` ASC) ,

  CONSTRAINT `FK_PoliceInvestigationsUsers`

    FOREIGN KEY (`ID_User` )

    REFERENCES `Users` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION,

  CONSTRAINT `FK_PoliceInvestigationsCompanies`

    FOREIGN KEY (`ID_Company` )

    REFERENCES `Companies` (`ID` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `ContractSurface`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `ContractSurface` ;



CREATE  TABLE IF NOT EXISTS `ContractSurface` (

  `ID` INT NOT NULL ,

  `ID_Contract` INT NOT NULL ,

  `Surface_Residential_M2` INT NOT NULL ,

  `Surface_Industrial_M2` INT NOT NULL ,

  `Surface_Commercial_M2` INT NOT NULL ,

  `Surface_Storage_M3` INT NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `ContractDueType`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `ContractDueType` ;



CREATE  TABLE IF NOT EXISTS `ContractDueType` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Code` VARCHAR(20) NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `Surfaces`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `Surfaces` ;



CREATE  TABLE IF NOT EXISTS `Surfaces` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Residential_M2` INT NOT NULL ,

  `Industrial_M2` INT NOT NULL ,

  `Commercial_M2` INT NOT NULL ,

  `Storage_M3` INT NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;







SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



-- -----------------------------------------------------

-- Data for table `Users`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Users` (`ID`, `Login`, `Password`, `Name`, `Robot`, `Cash`) VALUES (1, 'admin', 'admin', 'admin', 0, 1000000);

INSERT INTO `Users` (`ID`, `Login`, `Password`, `Name`, `Robot`, `Cash`) VALUES (2, 'God', 'God', 'God', 0, 1000000);

INSERT INTO `Users` (`ID`, `Login`, `Password`, `Name`, `Robot`, `Cash`) VALUES (3, 'WorldBankCEO', 'WorldBankCEO', 'Robert Goldman', 1, 1000000);

INSERT INTO `Users` (`ID`, `Login`, `Password`, `Name`, `Robot`, `Cash`) VALUES (4, 'BillGates', 'BillGates', 'Bill Gates', 1, 1000000);



COMMIT;



-- -----------------------------------------------------

-- Data for table `GovernmentType`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `GovernmentType` (`ID`, `Code`, `Police_Power`, `Military_Power`, `Court_Power`) VALUES (1, 'DEMOCRACY', 50, 50, 50);



COMMIT;



-- -----------------------------------------------------

-- Data for table `Countries`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Countries` (`ID`, `Code`, `ID_GovernmentType`) VALUES (1, 'FRANCE', 1);

INSERT INTO `Countries` (`ID`, `Code`, `ID_GovernmentType`) VALUES (2, 'GERMANY', 1);

INSERT INTO `Countries` (`ID`, `Code`, `ID_GovernmentType`) VALUES (3, 'ENGLAND', 1);

INSERT INTO `Countries` (`ID`, `Code`, `ID_GovernmentType`) VALUES (4, 'SPAIN', 1);

INSERT INTO `Countries` (`ID`, `Code`, `ID_GovernmentType`) VALUES (5, 'IRELAND', 1);

INSERT INTO `Countries` (`ID`, `Code`, `ID_GovernmentType`) VALUES (6, 'PORTUGAL', 1);



COMMIT;



-- -----------------------------------------------------

-- Data for table `Lifetime`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Lifetime` (`ID`, `IssueDate`, `CreationDate`, `TerminationDate`, `IsActive`) VALUES (1, '2012-01-01', '2012-01-01', NULL, 1);

INSERT INTO `Lifetime` (`ID`, `IssueDate`, `CreationDate`, `TerminationDate`, `IsActive`) VALUES (2, '2012-01-01', '2012-01-01', NULL, 1);

INSERT INTO `Lifetime` (`ID`, `IssueDate`, `CreationDate`, `TerminationDate`, `IsActive`) VALUES (3, '2012-01-01', '2012-01-01', NULL, 1);

INSERT INTO `Lifetime` (`ID`, `IssueDate`, `CreationDate`, `TerminationDate`, `IsActive`) VALUES (4, '2012-01-01', '2012-01-01', NULL, 1);

INSERT INTO `Lifetime` (`ID`, `IssueDate`, `CreationDate`, `TerminationDate`, `IsActive`) VALUES (5, '2012-01-01', '2012-01-01', NULL, 1);

INSERT INTO `Lifetime` (`ID`, `IssueDate`, `CreationDate`, `TerminationDate`, `IsActive`) VALUES (6, '2012-01-01', '2012-01-01', NULL, 1);

INSERT INTO `Lifetime` (`ID`, `IssueDate`, `CreationDate`, `TerminationDate`, `IsActive`) VALUES (7, '2012-01-01', '2012-01-01', NULL, 1);

INSERT INTO `Lifetime` (`ID`, `IssueDate`, `CreationDate`, `TerminationDate`, `IsActive`) VALUES (8, '2012-01-01', '2012-01-01', NULL, 1);

INSERT INTO `Lifetime` (`ID`, `IssueDate`, `CreationDate`, `TerminationDate`, `IsActive`) VALUES (9, '2012-01-01', '2012-01-01', NULL, 1);

INSERT INTO `Lifetime` (`ID`, `IssueDate`, `CreationDate`, `TerminationDate`, `IsActive`) VALUES (10, '2012-01-01', '2012-01-01', NULL, 1);



COMMIT;



-- -----------------------------------------------------

-- Data for table `Groups`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Groups` (`ID`, `ID_User_Ceo`, `ID_Country`, `ID_Lifetime`, `Name`, `Number`) VALUES (1, 1, 1, 1, 'World group', '00000000');



COMMIT;



-- -----------------------------------------------------

-- Data for table `CompanyType`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (1, 'PASSENGER_TRANSPORT');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (2, 'MERCHANDISE_TRANSPORT');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (3, 'RESOURCE_PRODUCTION');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (4, 'RESOURCE_VENDOR');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (5, 'PRODUCT_PRODUCTION');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (6, 'PRODUCT_DISTRIBUTION');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (7, 'PRODUCT_VENDOR');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (8, 'PERSON_SERVICE');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (9, 'COMPUTER_SERVICE');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (10, 'ESTATE_PRODUCTION');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (11, 'ESTATE_TRADING');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (12, 'HOTEL');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (13, 'BANK');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (14, 'INSURANCE');

INSERT INTO `CompanyType` (`ID`, `Code`) VALUES (15, 'CINEMA');



COMMIT;



-- -----------------------------------------------------

-- Data for table `Companies`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Companies` (`ID`, `ID_Group`, `ID_User_Ceo`, `ID_Country`, `ID_Type`, `ID_Lifetime`, `Name`, `Number`, `Cash`, `Worker_Daily_Wage`) VALUES (1, NULL, 1, 1, 5, 2, 'World Company', '00000000', 10000, 10);

INSERT INTO `Companies` (`ID`, `ID_Group`, `ID_User_Ceo`, `ID_Country`, `ID_Type`, `ID_Lifetime`, `Name`, `Number`, `Cash`, `Worker_Daily_Wage`) VALUES (2, 1, 3, 1, 13, 2, 'World Bank', '00000001', 10000, 10);

INSERT INTO `Companies` (`ID`, `ID_Group`, `ID_User_Ceo`, `ID_Country`, `ID_Type`, `ID_Lifetime`, `Name`, `Number`, `Cash`, `Worker_Daily_Wage`) VALUES (3, 1, 3, 1, 13, 3, 'World Finance Survey', '00000002', 10000, 10);

INSERT INTO `Companies` (`ID`, `ID_Group`, `ID_User_Ceo`, `ID_Country`, `ID_Type`, `ID_Lifetime`, `Name`, `Number`, `Cash`, `Worker_Daily_Wage`) VALUES (4, NULL, 4, 1, 5, 4, 'Microsoft', '00000003', 10000, 10);

INSERT INTO `Companies` (`ID`, `ID_Group`, `ID_User_Ceo`, `ID_Country`, `ID_Type`, `ID_Lifetime`, `Name`, `Number`, `Cash`, `Worker_Daily_Wage`) VALUES (5, NULL, 1, 1, 5, 8, 'Coca Cola', '00000004', 10000, 10);



COMMIT;



-- -----------------------------------------------------

-- Data for table `Brands`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Brands` (`ID`, `ID_Company`, `ID_Lifetime`, `Name`) VALUES (1, 1, 6, 'World Bank Brand');

INSERT INTO `Brands` (`ID`, `ID_Company`, `ID_Lifetime`, `Name`) VALUES (2, 2, 7, 'World Finance Survey Brand');

INSERT INTO `Brands` (`ID`, `ID_Company`, `ID_Lifetime`, `Name`) VALUES (3, 5, 9, 'Coca Cola');



COMMIT;



-- -----------------------------------------------------

-- Data for table `Cities`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Cities` (`ID`, `ID_Country`, `Code`, `Population`, `Latitude_Degree`, `Longitude_Degree`, `Factor_Tourism`) VALUES (1, 1, 'PARIS', 3000000, 48.856614, 2.352222, 0.8);

INSERT INTO `Cities` (`ID`, `ID_Country`, `Code`, `Population`, `Latitude_Degree`, `Longitude_Degree`, `Factor_Tourism`) VALUES (2, 1, 'LYON', 2500000, 45.764043, 4.835659, 0.5);

INSERT INTO `Cities` (`ID`, `ID_Country`, `Code`, `Population`, `Latitude_Degree`, `Longitude_Degree`, `Factor_Tourism`) VALUES (3, 1, 'NANTES', 2500000, 47.218371, -1.553621, 0.4);



COMMIT;



-- -----------------------------------------------------

-- Data for table `Buildings`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Buildings` (`ID`, `ID_City`, `ID_Company_Owner`, `ID_User_Owner`, `ID_Type`, `Name`, `Latitude_Degree`, `Longitude_Degree`, `Height_M`, `Surface_Residential_M2`, `Surface_Industrial_M2`, `Surface_Commercial_M2`, `Surface_Storage_M3`) VALUES (1, 1, 1, NULL, 1, 'World Bank HQ', 40, 5, 80, 0, 0, 5000, 0);



COMMIT;



-- -----------------------------------------------------

-- Data for table `Agencies`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Agencies` (`ID`, `ID_Company`, `ID_Building`, `ID_Brand`, `ID_Contract_Rent`, `Headquarters`, `Market_Percent`, `Name`) VALUES (1, 1, 1, 1, NULL, 1, 0, 'Agency 1');



COMMIT;



-- -----------------------------------------------------

-- Data for table `ContractType`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (1, 'RENT');

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (2, 'BRAND_USAGE');

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (3, 'RESOURCE_SALE');

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (4, 'PRODUCT_SALE');

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (5, 'BRAND_SALE');

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (6, 'ESTATE_SALE');

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (7, 'COMPANY_PART_SALE');

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (8, 'COMPANY_SALE');

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (9, 'GROUP_SALE');

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (10, 'RESOURCE_TRANSPORT');

INSERT INTO `ContractType` (`ID`, `Code`) VALUES (11, 'PRODUCT_TRANSPORT');



COMMIT;



-- -----------------------------------------------------

-- Data for table `ContractDue`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `ContractDue` (`ID`, `ID_Type`, `ID_Brand`, `ID_Resource_Type`, `ID_Product_Type`, `ID_Building`, `ID_Surface`, `ID_Company`, `ID_Group`, `Amount`) VALUES (1, 2, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0);

INSERT INTO `ContractDue` (`ID`, `ID_Type`, `ID_Brand`, `ID_Resource_Type`, `ID_Product_Type`, `ID_Building`, `ID_Surface`, `ID_Company`, `ID_Group`, `Amount`) VALUES (2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 500);

INSERT INTO `ContractDue` (`ID`, `ID_Type`, `ID_Brand`, `ID_Resource_Type`, `ID_Product_Type`, `ID_Building`, `ID_Surface`, `ID_Company`, `ID_Group`, `Amount`) VALUES (3, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, 0);

INSERT INTO `ContractDue` (`ID`, `ID_Type`, `ID_Brand`, `ID_Resource_Type`, `ID_Product_Type`, `ID_Building`, `ID_Surface`, `ID_Company`, `ID_Group`, `Amount`) VALUES (4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2500);



COMMIT;



-- -----------------------------------------------------

-- Data for table `Contracts`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Contracts` (`ID`, `ID_Company_1`, `ID_Company_2`, `ID_Type`, `ID_Lifetime`, `ID_Due_1`, `ID_Due_2`, `Number`, `Signature_Company_1`, `Signature_Company_2`, `Periodicity_Months`, `Periodicity_Days`, `Cancel_Notice_Days`, `Cancel_Fee`, `Last_Statisfied_Time`) VALUES (1, 1, 3, 1, 5, 1, 2, '12563874', 1, 1, 1, 0, 90, 1000, NULL);

INSERT INTO `Contracts` (`ID`, `ID_Company_1`, `ID_Company_2`, `ID_Type`, `ID_Lifetime`, `ID_Due_1`, `ID_Due_2`, `Number`, `Signature_Company_1`, `Signature_Company_2`, `Periodicity_Months`, `Periodicity_Days`, `Cancel_Notice_Days`, `Cancel_Fee`, `Last_Statisfied_Time`) VALUES (2, 5, 1, 2, 10, 3, 4, '65657981', 1, 1, 1, 0, 120, 150000, NULL);



COMMIT;



-- -----------------------------------------------------

-- Data for table `BankAccountType`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `BankAccountType` (`ID`, `Code`) VALUES (1, 'PROFESSIONAL');

INSERT INTO `BankAccountType` (`ID`, `Code`) VALUES (2, 'PERSONAL');



COMMIT;



-- -----------------------------------------------------

-- Data for table `BankAccounts`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `BankAccounts` (`ID`, `ID_Company_Owner`, `ID_Company_Client`, `ID_User_Client`, `ID_Type`, `Number`, `Money_Balance`) VALUES (1, 2, 1, NULL, 1, '12345678', 100000000);

INSERT INTO `BankAccounts` (`ID`, `ID_Company_Owner`, `ID_Company_Client`, `ID_User_Client`, `ID_Type`, `Number`, `Money_Balance`) VALUES (2, 2, 2, NULL, 1, '87654321', 10000000);

INSERT INTO `BankAccounts` (`ID`, `ID_Company_Owner`, `ID_Company_Client`, `ID_User_Client`, `ID_Type`, `Number`, `Money_Balance`) VALUES (3, 2, 3, NULL, 1, '21458963', 1000000);

INSERT INTO `BankAccounts` (`ID`, `ID_Company_Owner`, `ID_Company_Client`, `ID_User_Client`, `ID_Type`, `Number`, `Money_Balance`) VALUES (4, 2, 4, NULL, 1, '63298741', 3000000);

INSERT INTO `BankAccounts` (`ID`, `ID_Company_Owner`, `ID_Company_Client`, `ID_User_Client`, `ID_Type`, `Number`, `Money_Balance`) VALUES (5, 2, NULL, 3, 2, '88994477', 80000);



COMMIT;



-- -----------------------------------------------------

-- Data for table `ResourceType`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `ResourceType` (`ID`, `Code`) VALUES (1, 'GOLD');

INSERT INTO `ResourceType` (`ID`, `Code`) VALUES (2, 'OIL');

INSERT INTO `ResourceType` (`ID`, `Code`) VALUES (3, 'IRON');

INSERT INTO `ResourceType` (`ID`, `Code`) VALUES (4, 'PLASTIC');

INSERT INTO `ResourceType` (`ID`, `Code`) VALUES (5, 'RUBBER');

INSERT INTO `ResourceType` (`ID`, `Code`) VALUES (6, 'RICE');

INSERT INTO `ResourceType` (`ID`, `Code`) VALUES (7, 'WHEAT');



COMMIT;



-- -----------------------------------------------------

-- Data for table `ContractSurface`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `ContractSurface` (`ID`, `ID_Contract`, `Surface_Residential_M2`, `Surface_Industrial_M2`, `Surface_Commercial_M2`, `Surface_Storage_M3`) VALUES (1, 1, 0, 0, 250, 0);



COMMIT;



-- -----------------------------------------------------

-- Data for table `ContractDueType`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `ContractDueType` (`ID`, `Code`) VALUES (1, 'MONEY');

INSERT INTO `ContractDueType` (`ID`, `Code`) VALUES (2, 'SURFACE_RENT');

INSERT INTO `ContractDueType` (`ID`, `Code`) VALUES (3, 'BRAND');

INSERT INTO `ContractDueType` (`ID`, `Code`) VALUES (4, 'RESOURCE');

INSERT INTO `ContractDueType` (`ID`, `Code`) VALUES (5, 'PRODUCT');

INSERT INTO `ContractDueType` (`ID`, `Code`) VALUES (6, 'BUILDING');

INSERT INTO `ContractDueType` (`ID`, `Code`) VALUES (7, 'VEHICLE');

INSERT INTO `ContractDueType` (`ID`, `Code`) VALUES (8, 'COMPANY_PARTS');

INSERT INTO `ContractDueType` (`ID`, `Code`) VALUES (9, 'COMPANY');

INSERT INTO `ContractDueType` (`ID`, `Code`) VALUES (10, 'GROUP');



COMMIT;



-- -----------------------------------------------------

-- Data for table `Surfaces`

-- -----------------------------------------------------

START TRANSACTION;

INSERT INTO `Surfaces` (`ID`, `Residential_M2`, `Industrial_M2`, `Commercial_M2`, `Storage_M3`) VALUES (1, 0, 200, 150, 0);



COMMIT;

