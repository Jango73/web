<?php

require_once "Panel.php";
require_once "Label.php";
require_once "Button.php";

require_once "ContractPreview.php";

require_once "DataAccess/ECompany.php";
require_once "DataAccess/EContract.php";

class CompanyContracts extends Panel
{
	protected $Company;
	protected $ContractList;

	public function __construct ($Context, $Company, $NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);

		$this->Company = $Company;

		$SearchContract = new EContract();
		$Crit = Array("ID_Company_1" => $this->Company->ID);
		$this->ContractList = $SearchContract->GetByCriteria($Crit, true);

		$SearchContract = new EContract();
		$Crit = Array("ID_Company_2" => $this->Company->ID);
		$this->ContractList = array_merge($this->ContractList, $SearchContract->GetByCriteria($Crit, true));

		foreach ($this->ContractList as $Contract)
		{
			$OwnedByUser =
				($Contract->Company1->ID_User_Ceo == $Context->GetVars()->User_ID) ||
				($Contract->Company2->ID_User_Ceo == $Context->GetVars()->User_ID);

			$this->AddControl(new ContractPreview($Context, $Contract, $OwnedByUser, "Contract" . $Contract->ID, "", $this->Width, 200));
		}
	}
}

?>
