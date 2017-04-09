<?php

require_once("Entity.php");
require_once("DBNames.php");

class EMoneyTransfer extends Entity
{
	var $ID_Bank_Account_Sender;
	var $ID_Bank_Account_Receiver;
	var $Number;
	var $Money_Amount;
	var $Issue_Date;
	var $Execution_Date;

	var $Bank_Account_Sender;
	var $Bank_Account_Receiver;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_MoneyTransfers;

		$this->AddColumns(Array(
			DBNames::Tbl_MoneyTransfers_Col_ID_Bank_Account_Sender,
			DBNames::Tbl_MoneyTransfers_Col_ID_Bank_Account_Receiver,
			DBNames::Tbl_MoneyTransfers_Col_Number,
			DBNames::Tbl_MoneyTransfers_Col_Money_Amount,
			DBNames::Tbl_MoneyTransfers_Col_Issue_Date,
			DBNames::Tbl_MoneyTransfers_Col_Execution_Date
		));

		$this->AddJoins(Array(
			new EntityJoin(DBNames::Tbl_MoneyTransfers_Col_ID_Bank_Account_Sender, DBNames::Tbl_BankAccounts, DBNames::Generic_Col_ID, "AccountSender"),
			new EntityJoin(DBNames::Tbl_MoneyTransfers_Col_ID_Bank_Account_Receiver, DBNames::Tbl_BankAccounts, DBNames::Generic_Col_ID, "AccountReceiver")
		));
	}

	public function GetChildren()
	{
	}
}

?>
