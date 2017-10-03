<?php

require_once 'php-entities/Components/Panel.php';
require_once 'php-entities/Components/RenderContext.php';

require_once 'php-entities/Components/Label.php';
require_once 'php-entities/Components/Button.php';

require_once 'AgencyPreview.php';

require_once 'DataAccess/ECompany.php';
require_once 'DataAccess/EAgency.php';

class CompanyAgencies extends Panel
{
	protected $Company;
	protected $AgencyList;

	public function __construct ($Context, $Company, $NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);

		$this->Company = $Company;

		$this->AgencyList = new EAgency();
		$Crit = Array("ID_Company" => $this->Company->ID);
		$this->AgencyList = $this->AgencyList->GetByCriteria($Crit, true);

		$NewDiv = new SimpleDiv("", "");

		foreach ($this->AgencyList as $Agency)
		{
			$OwnedByUser = ($Agency->Company->ID_User_Ceo == $Context->GetVars()->User_ID);
			// $OwnedByUser = 1;

			$NewDiv->AddControl(new AgencyPreview($Context, $Agency, $OwnedByUser, 'Agency' . $Agency->ID, '', $this->Width, 200));
		}

		$this->AddControl($NewDiv);
	}
}

?>
