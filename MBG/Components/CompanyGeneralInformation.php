<?php

require_once 'php-entities/Components/Panel.php';
require_once 'php-entities/Components/RenderContext.php';

require_once 'php-entities/Components/Label.php';
require_once 'php-entities/Components/Button.php';
require_once 'php-entities/Components/SimpleDiv.php';

require_once 'DataAccess/ECompany.php';

class CompanyGeneralInformationHandler extends EventHandler
{
	public function HandleEvent($Context, $Control, $Event, $Param)
	{
		switch ($Event)
		{
			case "click" :
			{
				return "";
			}
		}

		return "";
	}
}

class CompanyGeneralInformation extends Panel
{
	protected $Company;

	public function __construct ($Context, $Company, $NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);

		$this->Company = $Company;

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("NAME"), 100, 30));
		$NewDiv->AddControl(new Label("CompanyName", $this->Company->Name, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("TYPE"), 100, 30));
		$NewDiv->AddControl(new Label("CompanyType", $Context->GetString($this->Company->Type->Code), 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("COMMERCIALID"), 100, 30));
		$NewDiv->AddControl(new Label("CompanyNumber", $this->Company->Number, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("CEO"), 100, 30));
		$NewDiv->AddControl(new Label("CompanyCEO", $this->Company->User_Ceo->Name, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("COMPANYCASH"), 100, 30));
		$NewDiv->AddControl(new Label("CompanyCash", $this->Company->Cash, 100, 30));
		$this->AddControl($NewDiv);
	}
}

?>
