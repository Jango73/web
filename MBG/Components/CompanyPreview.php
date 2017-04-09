<?php

require_once 'Panel.php';
require_once 'RenderContext.php';

require_once 'Label.php';
require_once 'Button.php';
require_once 'SimpleDiv.php';

require_once 'DataAccess/ECompany.php';

class ManageCompanyHandler extends EventHandler
{
	public function HandleEvent($Context, $Control, $Event, $Param)
	{
		switch ($Event)
		{
			case 'click' :
			{
				$Args = array("id" => $Param);
				return $Context->RedirectToPage('Company', $Args);
			}
		}

		return '';
	}
}

class CompanyPreview extends Panel
{
	protected $Company;

	public function __construct ($Context, $Company, $OwnedByUser, $NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);

		$this->Company = $Company;

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("NAME"), 100, 30));
		$NewDiv->AddControl(new Label("CompanyName", $this->Company->Name, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("TYPE"), 100, 30));
		$NewDiv->AddControl(new Label("CompanyType", $this->Company->Type->Code, 100, 30));
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

		if ($OwnedByUser)
		{
			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new SimpleDiv("", ""));
			$Btn = new Button("ManageCompany" . $this->Company->ID, $Context->GetString("MANAGE"), 140, 30);
			$Btn->SetParam($this->Company->ID);
			$Btn->SetEventHandler(new ManageCompanyHandler());
			$NewDiv->AddControl($Btn);
			$this->AddControl($NewDiv);
		}
	}
}

?>
