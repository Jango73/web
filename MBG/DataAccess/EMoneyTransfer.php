<?php

require_once("php-entities/DataAccess/Entity.php");
require_once("DBNames.php");
require_once("EBankAccount.php");

class EMoneyTransfer extends Entity
{
	var $ID_Bank_Account_Sender;
	var $ID_Bank_Account_Receiver;
	var $Description_Sender;
	var $Description_Receiver;
	var $Number;
	var $Money_Amount;
	var $Issue_Date;
	var $Execution_Date;
	var $Executed;

	var $Bank_Account_Sender;
	var $Bank_Account_Receiver;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_MoneyTransfers;

		$this->AddColumns(Array(
			DBNames::Tbl_MoneyTransfers_Col_ID_Bank_Account_Sender,
			DBNames::Tbl_MoneyTransfers_Col_ID_Bank_Account_Receiver,
			DBNames::Tbl_MoneyTransfers_Col_Description_Sender,
			DBNames::Tbl_MoneyTransfers_Col_Description_Receiver,
			DBNames::Tbl_MoneyTransfers_Col_Number,
			DBNames::Tbl_MoneyTransfers_Col_Money_Amount,
			DBNames::Tbl_MoneyTransfers_Col_Issue_Date,
			DBNames::Tbl_MoneyTransfers_Col_Execution_Date,
			DBNames::Tbl_MoneyTransfers_Col_Executed
		));

		/*
		$this->AddJoins(Array(
			new EntityJoin(DBNames::Tbl_MoneyTransfers_Col_ID_Bank_Account_Sender, DBNames::Tbl_BankAccounts, DBNames::Generic_Col_ID, "AccountSender"),
			new EntityJoin(DBNames::Tbl_MoneyTransfers_Col_ID_Bank_Account_Receiver, DBNames::Tbl_BankAccounts, DBNames::Generic_Col_ID, "AccountReceiver")
		));
		*/
	}

	public function GetChildren()
	{
		$SearchBankAccount = new EBankAccount();
		$this->Bank_Account_Sender = $SearchBankAccount->GetSingle($this->ID_Bank_Account_Sender, true);
		$this->Bank_Account_Receiver = $SearchBankAccount->GetSingle($this->ID_Bank_Account_Receiver, true);
	}

	public static function Create($ID_Bank_Account_Sender, $ID_Bank_Account_Receiver, $Description_Sender, $Description_Receiver, $Execution_Date, $Money_Amount)
	{
		$Transfer = new EMoneyTransfer();
		$Transfer->ID_Bank_Account_Sender = $ID_Bank_Account_Sender;
		$Transfer->ID_Bank_Account_Receiver = $ID_Bank_Account_Receiver;
		$Transfer->Description_Sender = $Description_Sender;
		$Transfer->Description_Receiver = $Description_Receiver;
		$Transfer->Number = 11001100;
		$Transfer->Money_Amount = $Money_Amount;
		$Transfer->Issue_Date = new DateTime();
		$Transfer->Execution_Date = $Execution_Date;
		$Transfer->Executed = false;

		$Transfer->Persist();
		return $Transfer;
	}
}

?>
