<?php

require_once "Page.php";
require_once "RenderContext.php";

require_once "Label.php";
require_once "TitleLabel.php";
require_once "CompanyPreview.php";

require_once "DataAccess/ECompany.php";

class CompaniesPage extends Page
{
	protected $CompanyList;

	public function __construct ($Context, $Name)
	{
		parent::__construct($Context, $Name);

		// Check base features
		if ($Context->GetVars()->User_ID == null)
		{
			$this->AddControl(new Label("", $Context->GetString("NOACCESSIFNOLOGGED"), 100, 30));
			return;
		}

		// Create controls
        $this->AddControl(new TitleLabel("Companies", $Context->GetString("MYCOMPANIES"), 100, 30));

		$this->CompanyList = new ECompany();
		$Crit = Array("ID_User_Ceo" => $Context->GetVars()->User_ID);
		$this->CompanyList = $this->CompanyList->GetByCriteria($Crit, true);

		$NewDiv = new SimpleDiv("", "");

		foreach ($this->CompanyList as $Company)
		{
			$OwnedByUser = ($Company->ID_User_Ceo == $Context->GetVars()->User_ID);

			$NewDiv->AddControl(new CompanyPreview($Context, $Company, $OwnedByUser, "Company" . $Company->ID, "", $this->Width, 200));
		}

		$this->AddControl($NewDiv);
	}
}

?>
