<?php

require_once("php-entities/DataAccess/Entity.php");
require_once("DBNames.php");
require_once("EUser.php");
require_once("ECompany.php");
require_once("EBankAccount.php");

class ELoan extends Entity
{
	var $ID_User_Lender;
	var $ID_Company_Lender;
	var $ID_Bank_Account_Lender;
	var $ID_User_Borrower;
	var $ID_Company_Borrower;
	var $ID_Bank_Account_Borrower;
	var $Number;
	var $Interest_Rate;
	var $Money_Due;

	var $User_Lender;
	var $Company_Lender;
	var $Bank_Account_Lender;
	var $User_Borrower;
	var $Company_Borrower;
	var $Bank_Account_Borrower;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = Tbl_Loans;

		$this->AddColumns(Array(
			DBNames::Tbl_Loans_Col_ID_User_Lender,
			DBNames::Tbl_Loans_Col_ID_Company_Lender,
			DBNames::Tbl_Loans_Col_ID_Bank_Account_Lender,
			DBNames::Tbl_Loans_Col_ID_User_Borrower,
			DBNames::Tbl_Loans_Col_ID_Company_Borrower,
			DBNames::Tbl_Loans_Col_ID_Bank_Account_Borrower,
			DBNames::Tbl_Loans_Col_Number,
			DBNames::Tbl_Loans_Col_Interest_Rate,
			DBNames::Tbl_Loans_Col_Money_Due
		));
	}

	public function GetChildren()
	{
		$SearchCompany = new ECompany();
		$SearchUser = new EUser();

		if ($ID_Company_Lender != 0)
			$this->Company_Lender = $SearchCompany->GetSingle($ID_Company_Lender, true);

		if ($ID_Company_Borrower != 0)
			$this->Company_Borrower = $SearchCompany->GetSingle($ID_Company_Borrower, true);

		if ($ID_User_Lender != 0)
			$this->User_Lender = $SearchUser->GetSingle($ID_User_Lender, true);

		if ($ID_User_Borrower != 0)
			$this->User_Borrower = $SearchUser->GetSingle($ID_User_Borrower, true);

		$SearchBankAccount = new EBankAccount();
		$this->Bank_Account_Lender = $SearchBankAccount->GetSingle($ID_Bank_Account_Lender, true);
		$this->Bank_Account_Borrower = $SearchBankAccount->GetSingle($ID_Bank_Account_Borrower, true);
	}
}

?>
