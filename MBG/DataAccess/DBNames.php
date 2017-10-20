<?php

class DBNames
{
	const Generic_Col_ID = "ID";

	const Tbl_Companies = "Companies";
	const Tbl_Companies_Col_ID_Group = "ID_Group";
	const Tbl_Companies_Col_ID_User_Ceo = "ID_User_Ceo";
	const Tbl_Companies_Col_ID_Country = "ID_Country";
	const Tbl_Companies_Col_ID_Type = "ID_Type";
	const Tbl_Companies_Col_ID_Lifetime = "ID_Lifetime";
	const Tbl_Companies_Col_Name = "Name";
	const Tbl_Companies_Col_Number = "Number";
	const Tbl_Companies_Col_Cash = "Cash";
	const Tbl_Companies_Col_Worker_Daily_Wage = "Worker_Daily_Wage";

	const Tbl_Lifetime = "Lifetime";
	const Tbl_Lifetime_Col_Issue_Date = "Issue_Date";
	const Tbl_Lifetime_Col_Creation_Date = "Creation_Date";
	const Tbl_Lifetime_Col_Termination_Date = "Termination_Date";
	const Tbl_Lifetime_Col_Is_Active = "Is_Active";

	const Tbl_Agencies = "Agencies";
	const Tbl_Agencies_Col_ID_Company = "ID_Company";
	const Tbl_Agencies_Col_ID_Building = "ID_Building";
	const Tbl_Agencies_Col_ID_Brand = "ID_Brand";
	const Tbl_Agencies_Col_ID_Contract_Rent = "ID_Contract_Rent";
	const Tbl_Agencies_Col_Name = "Name";
	const Tbl_Agencies_Col_Headquarters = "Headquarters";
	const Tbl_Agencies_Col_Market_Percent = "Market_Percent";

	const Tbl_BankAccounts = "BankAccounts";
	const Tbl_BankAccounts_Col_ID_Company_Owner = "ID_Company_Owner";
	const Tbl_BankAccounts_Col_ID_Company_Client = "ID_Company_Client";
    const Tbl_BankAccounts_Col_ID_User_Client = "ID_User_Client";
	const Tbl_BankAccounts_Col_ID_Type = "ID_Type";
	const Tbl_BankAccounts_Col_Number = "Number";
	const Tbl_BankAccounts_Col_Money_Balance = "Money_Balance";

	const Tbl_Loans = "Loans";
	const Tbl_Loans_Col_ID_User_Lender = "ID_User_Lender";
	const Tbl_Loans_Col_ID_Company_Lender = "ID_Company_Lender";
	const Tbl_Loans_Col_ID_Bank_Account_Lender = "ID_Bank_Account_Lender";
	const Tbl_Loans_Col_ID_User_Borrower = "ID_User_Borrower";
	const Tbl_Loans_Col_ID_Company_Borrower = "ID_Company_Borrower";
	const Tbl_Loans_Col_ID_Bank_Account_Borrower = "ID_Bank_Account_Borrower";
	const Tbl_Loans_Col_Number = "Number";
	const Tbl_Loans_Col_Interest_Rate = "Interest_Rate";
	const Tbl_Loans_Col_Money_Due = "Money_Due";

	const Tbl_MoneyTransfers = "MoneyTransfers";
	const Tbl_MoneyTransfers_Col_ID_Bank_Account_Sender = "ID_Bank_Account_Sender";
	const Tbl_MoneyTransfers_Col_ID_Bank_Account_Receiver = "ID_Bank_Account_Receiver";
	const Tbl_MoneyTransfers_Col_Description_Sender = "Description_Sender";
	const Tbl_MoneyTransfers_Col_Description_Receiver = "Description_Receiver";
	const Tbl_MoneyTransfers_Col_Number = "Number";
	const Tbl_MoneyTransfers_Col_Money_Amount = "Money_Amount";
	const Tbl_MoneyTransfers_Col_Issue_Date = "Issue_Date";
	const Tbl_MoneyTransfers_Col_Execution_Date = "Execution_Date";
	const Tbl_MoneyTransfers_Col_Executed = "Executed";

	const Tbl_Transactions = "Transactions";
	const Tbl_Transactions_Col_ID_Bank_Account = "ID_Bank_Account";
	const Tbl_Transactions_Col_Execution_Date = "Execution_Date";
	const Tbl_Transactions_Col_Description = "Description";
	const Tbl_Transactions_Col_Money_Amount = "Money_Amount";

	const Tbl_Contracts = "Contracts";
	const Tbl_Contracts_Col_ID_Company_1 = "ID_Company_1";
	const Tbl_Contracts_Col_ID_Company_2 = "ID_Company_2";
	const Tbl_Contracts_Col_ID_Type = "ID_Type";
	const Tbl_Contracts_Col_ID_Lifetime = "ID_Lifetime";
	const Tbl_Contracts_Col_ID_Due_1 = "ID_Due_1";
	const Tbl_Contracts_Col_ID_Due_2 = "ID_Due_2";
	const Tbl_Contracts_Col_Number = "Number";
	const Tbl_Contracts_Col_Signature_Company_1 = "Signature_Company_1";
	const Tbl_Contracts_Col_Signature_Company_2 = "Signature_Company_2";
	const Tbl_Contracts_Col_Periodicity_Months = "Periodicity_Months";
	const Tbl_Contracts_Col_Periodicity_Days = "Periodicity_Days";
	const Tbl_Contracts_Col_Cancel_Notice_Days = "Cancel_Notice_Days";
	const Tbl_Contracts_Col_Company_1_Cancel_Fee = "Company_1_Cancel_Fee";
	const Tbl_Contracts_Col_Company_2_Cancel_Fee = "Company_2_Cancel_Fee";
	const Tbl_Contracts_Col_Last_Statisfied_Time = "Last_Statisfied_Time";

	const Tbl_ContractDue = "ContractDue";
	const Tbl_ContractDue_Col_ID_Type = "ID_Type";
	const Tbl_ContractDue_Col_ID_Brand = "ID_Brand";
	const Tbl_ContractDue_Col_ID_Resource_Type = "ID_Resource_Type";
	const Tbl_ContractDue_Col_ID_Product_Type = "ID_Product_Type";
	const Tbl_ContractDue_Col_ID_Building = "ID_Building";
	const Tbl_ContractDue_Col_ID_Surface = "ID_Surface";
	const Tbl_ContractDue_Col_ID_Company = "ID_Company";
	const Tbl_ContractDue_Col_ID_Group = "ID_Group";
	const Tbl_ContractDue_Col_Amount = "Amount";

	const Tbl_ContractDueType = "ContractDueType";

	const Tbl_Surfaces = "Surfaces";
	const Tbl_Surfaces_Col_Residential_M2 = "Residential_M2";
	const Tbl_Surfaces_Col_Industrial_M2 = "Industrial_M2";
	const Tbl_Surfaces_Col_Commercial_M2 = "Commercial_M2";
	const Tbl_Surfaces_Col_Storage_M3 = "Storage_M3";

	const Enum_ContractDueType_Money = 1;
	const Enum_ContractDueType_Surface_Rent = 2;
	const Enum_ContractDueType_Brand = 3;
	const Enum_ContractDueType_Resource = 4;
	const Enum_ContractDueType_Product = 5;
	const Enum_ContractDueType_Building = 6;
	const Enum_ContractDueType_Vehicle = 7;
	const Enum_ContractDueType_Company_Parts = 8;
	const Enum_ContractDueType_Company = 9;
	const Enum_ContractDueType_Group = 10;
}

?>
