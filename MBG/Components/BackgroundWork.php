<?php

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
}

?>
