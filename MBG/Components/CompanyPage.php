<?php

require_once "ProtectedPage.php";

require_once "php-entities/Components/Tabs.php";
require_once "php-entities/Components/Panel.php";
require_once "php-entities/Components/Label.php";
require_once "php-entities/Components/TitleLabel.php";
require_once "php-entities/Components/Button.php";

require_once "CompanyGeneralInformation.php";
require_once "CompanyAgencies.php";
require_once "CompanyContracts.php";

require_once "DataAccess/ECompany.php";

class CompanyPage extends ProtectedPage
{
	protected $Company;

	public function __construct ($Context, $Name)
	{
		parent::__construct($Context, $Name);

		if ($this->checkAccess($Context))
		{
			// Create controls
			$this->Company = new ECompany();
			$this->Company = $this->Company->GetSingle($Context->GetVars()->ID, true);

			if ($this->Company != null)
			{
				if ($this->Company->ID_User_Ceo == $Context->GetVars()->User_ID)
				{
					$TabsHeight = 500;

					$this->AddControl(new TitleLabel("Company", $this->Company->Name, $this->Width, 30));

					$Tabs = new Tabs("CompanyTabs", $this->Company->Name, $this->Width, $TabsHeight);

					$Tabs->AddControl(new CompanyGeneralInformation($Context, $this->Company, "GeneralPanel", "General information", $this->Width - 20, $TabsHeight - 20));
					$Tabs->AddControl(new CompanyAgencies($Context, $this->Company, "AgenciesPanel", "Agencies", $this->Width - 20, $TabsHeight - 20));
					$Tabs->AddControl(new Panel("BrandsPanel", "Brands", $this->Width - 20, $TabsHeight - 20));
					$Tabs->AddControl(new Panel("AssetsPanel", "Assets", $this->Width - 20, $TabsHeight - 20));
					$Tabs->AddControl(new CompanyContracts($Context, $this->Company, "ContractsPanel", "Contracts", $this->Width - 20, $TabsHeight - 20));
					$Tabs->AddControl(new Panel("IncomePanel", "Income", $this->Width - 20, $TabsHeight - 20));

					$this->AddControl($Tabs);
				}
				else
				{
					$Context->GetVars()->CheatSuspected();
				}
			}
			else
			{
				$this->AddControl(new Label("Company", "Oups, this company does not exist", 100, 30));
			}
		}
	}
}

?>
