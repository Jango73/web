<?php

require_once 'php-entities/Components/Panel.php';
require_once 'php-entities/Components/RenderContext.php';

require_once 'php-entities/Components/Label.php';
require_once 'php-entities/Components/Button.php';
require_once 'php-entities/Components/SimpleDiv.php';

require_once 'DataAccess/EGroup.php';

class ManageGroupHandler extends EventHandler
{
	public function HandleEvent($Context, $Control, $Event, $Param)
	{
		switch ($Event)
		{
			case "click" :
			{
				$Args = array("id" => $Param);
				return $Context->RedirectToPage("Group", $Args);
			}
		}

		return '';
	}
}

class GroupPreview extends Panel
{
	protected $Group;

	public function __construct ($Context, $Group, $OwnedByUser, $NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);

		$this->Group = $Group;

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("NAME"), 100, 30));
		$NewDiv->AddControl(new Label("GroupName", $this->Group->Name, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("COMMERCIALID"), 100, 30));
		$NewDiv->AddControl(new Label("GroupNumber", $this->Group->Number, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("CEO"), 100, 30));
		$NewDiv->AddControl(new Label("GroupCEO", $this->Group->User_Ceo->Name, 100, 30));
		$this->AddControl($NewDiv);

		/*
		if ($OwnedByUser)
		{
			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new SimpleDiv("", ""));
			$Btn = new Button("ManageCompany" . $this->Company->ID, "Manage", 80, 30);
			$Btn->SetParam($this->Company->ID);
			$Btn->SetEventHandler(new ManageCompanyHandler());
			$NewDiv->AddControl($Btn);
			$this->AddControl($NewDiv);
		}
		*/
	}
}

?>
