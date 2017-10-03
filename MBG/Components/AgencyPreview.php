<?php

require_once 'php-entities/Components/Panel.php';
require_once 'php-entities/Components/RenderContext.php';

require_once 'php-entities/Components/Label.php';
require_once 'php-entities/Components/Button.php';

require_once 'DataAccess/EAgency.php';

class ManageAgencyHandler extends EventHandler
{
	public function HandleEvent($Context, $Control, $Event, $Param)
	{
		switch ($Event)
		{
			case "click" :
			{
				$Args = array("id" => $Param);

				return $Context->RedirectToPage("Agency", $Args);
			}
		}

		return "";
	}
}

class AgencyPreview extends Panel
{
	protected $Agency;

	public function __construct ($Context, $Agency, $OwnedByUser, $NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);

		$this->Agency = $Agency;

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("NAME"), 100, 30));
		$NewDiv->AddControl(new Label("AgencyName", $this->Agency->Name, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("LOCATEDIN"), 100, 30));
		$NewDiv->AddControl(new Label("AgencyCity", $this->Agency->Building->City->Code, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("MARKETPERCENT"), 100, 30));
		$NewDiv->AddControl(new Label("AgencyMarketPercent", $this->Agency->Market_Percent, 100, 30));
		$this->AddControl($NewDiv);

		if ($OwnedByUser)
		{
			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", "", 100, 30));
			$Btn = new Button("ManageAgency" . $this->Agency->ID, $Context->GetString("MANAGE"), 140, 30);
			$Btn->SetParam($this->Agency->ID);
			$Btn->SetEventHandler(new ManageAgencyHandler());
			$NewDiv->AddControl($Btn);
			$this->AddControl($NewDiv);
		}
	}
}

?>
