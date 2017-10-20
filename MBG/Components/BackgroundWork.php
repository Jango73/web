<?php

require_once "DataAccess/ECompany.php";
require_once "DataAccess/EContract.php";
require_once "DataAccess/EMoneyTransfer.php";
require_once "DataAccess/ETransaction.php";
require_once "DataAccess/EBankAccount.php";
require_once("DataAccess/DBNames.php");

class BackgroundWork
{
	public function Work()
	{
		// Manage companies
		
		$this->ManageCompanies();

		// Manage contracts
		
		$this->ManageContracts();

		// Manage market

		$this->ManageMarket();

		// Execute money transfers

		$this->ExecuteMoneyTransfers();
	}

	protected function ManageCompanies()
	{
	}

	protected function ManageContracts()
	{
		$Contracts = new EContract();
		// $Crit = Array("ID_Company_1" => $this->Company->ID);
		// $this->ContractList = $this->ContractList->GetByCriteria($Crit, true);
	}

	protected function ManageMarket()
	{
	}

	protected function ExecuteMoneyTransfers()
	{
		$SearchTransfer = new EMoneyTransfer();
		$Crit = Array(DBNames::Tbl_MoneyTransfers_Col_Executed => false);
		$TransferList = $SearchTransfer->GetByCriteria($Crit, true);

		foreach ($TransferList as $Transfer)
		{
			if ($Transfer->Bank_Account_Sender != null && $Transfer->Bank_Account_Receiver != null)
			{
				$Transfer->Bank_Account_Sender->Money_Balance -= $Transfer->Money_Amount;
				$Transfer->Bank_Account_Sender->Persist();

				$Transfer->Bank_Account_Receiver->Money_Balance += $Transfer->Money_Amount;
				$Transfer->Bank_Account_Receiver->Persist();

				$Execution_Date = new DateTime();

				$Transaction_Source = ETransaction::Create(
					$Transfer->ID_Bank_Account_Sender,
					$Transfer->Description_Sender,
					$Execution_Date,
					-$Transfer->Money_Amount
				);

				$Transaction_Target = ETransaction::Create(
					$Transfer->ID_Bank_Account_Receiver,
					$Transfer->Description_Receiver,
					$Execution_Date,
					$Transfer->Money_Amount
				);

				$Transfer->Executed = true;
				$Transfer->Persist();
			}
		}
	}
}

?>
