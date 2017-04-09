<?php

require_once("Entity.php");
require_once("DBNames.php");
require_once("EBankAccountType.php");
require_once("ECompany.php");
require_once("EUser.php");
require_once("ETransaction.php");

class EBankAccount extends Entity
{
	var $ID_Company_Owner;
	var $ID_Company_Client;
	var $ID_User_Client;
	var $ID_Type;
	var $Number;
	var $Money_Balance;

	var $Company_Owner;
	var $Company_Client;
	var $User_Client;
	var $Type;
	var $Transactions;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_BankAccounts;

		$this->AddColumns(Array(
			DBNames::Tbl_BankAccounts_Col_ID_Company_Owner,
			DBNames::Tbl_BankAccounts_Col_ID_Company_Client,
			DBNames::Tbl_BankAccounts_Col_ID_User_Client,
			DBNames::Tbl_BankAccounts_Col_ID_Type,
			DBNames::Tbl_BankAccounts_Col_Number,
			DBNames::Tbl_BankAccounts_Col_Money_Balance
		));

		$this->AddJoins(Array(
			new EntityJoin(DBNames::Tbl_BankAccounts_Col_ID_Company_Owner, DBNames::Tbl_Companies, DBNames::Generic_Col_ID, "CompOwner"),
			new EntityJoin(DBNames::Tbl_BankAccounts_Col_ID_Company_Client, DBNames::Tbl_Companies, DBNames::Generic_Col_ID, "CompClient")
		));
	}

	public function GetChildren()
	{
		$SearchCompany = new ECompany();
		$this->Company_Owner = $SearchCompany->GetSingle($this->ID_Company_Owner, true);
		$this->Company_Client = $SearchCompany->GetSingle($this->ID_Company_Client, true);

		$SearchUser = new EUser();
		$this->User_Client = $SearchUser->GetSingle($this->ID_User_Client, true);

		$SearchType = new EBankAccountType();
		$this->Type = $SearchType->GetSingle($this->ID_Type, true);
	}

	public function GetTransactions($StartDate, $EndDate)
	{
        $SearchTransactions = new ETransaction();
        $Crit = array("Date" => $StartDate);
        $this->Transactions = $SearchTransactions->GetByCriteria();
	}
}

?>
