<?php

require_once("php-entities/DataAccess/Entity.php");

class ETransaction extends Entity
{
	var $ID_Bank_Account;
	var $Execution_Date;
	var $Description;
	var $Money_Amount;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_Transactions;

		$this->AddColumns(Array(
			DBNames::Tbl_Transactions_Col_ID_Bank_Account,
			DBNames::Tbl_Transactions_Col_Execution_Date,
			DBNames::Tbl_Transactions_Col_Description,
			DBNames::Tbl_Transactions_Col_Money_Amount
		));
	}

	public function GetChildren()
	{
	}

	public static function Create($ID_Bank_Account, $Description, $Execution_Date, $Money_Amount)
	{
		$Transaction = new ETransaction();
		$Transaction->ID_Bank_Account = $ID_Bank_Account;
		$Transaction->Execution_Date = $Execution_Date;
		$Transaction->Description = $Description;
		$Transaction->Money_Amount = $Money_Amount;

		$Transaction->Persist();
		return $Transaction;
	}
}

?>
