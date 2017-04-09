<?php

require_once "Page.php";
require_once "RenderContext.php";

require_once "Tabs.php";
require_once "Panel.php";
require_once "Label.php";
require_once "TitleLabel.php";
require_once "Button.php";

require_once "DataAccess/EContract.php";

class ContractPage extends Page
{
	protected $Contract;

	public function __construct ($Context, $Name)
	{
		parent::__construct($Context, $Name);

		// Check base features
		if ($Context->GetVars()->User_ID == null)
		{
			$this->AddControl(new Label("", "No access to this page if not logged in.", 100, 30));
			return;
		}

		// Create controls
		$this->Contract = new EContract();
		$this->Contract = $this->Contract->GetSingle($Context->GetVars()->ID, true);

		if ($this->Contract != null)
		{
			if (
				$this->Contract->Company1->ID_User_Ceo == $Context->GetVars()->User_ID ||
				$this->Contract->Company2->ID_User_Ceo == $Context->GetVars()->User_ID
			)
			{
				$this->AddControl(new TitleLabel("", $Context->GetString("CONTRACTNUMBER") . " " . $this->Contract->Number, $this->Width, 30));
				$this->AddControl(new TitleLabel("", $Context->GetString($this->Contract->Type->Code), $this->Width, 30));

				$Text = "";
				$Text .= "Contract party 1 : " . $this->Contract->Company1->Name . "<br>";
				$Text .= "Contract party 2 : " . $this->Contract->Company2->Name . "<br>";
				$this->AddControl(new Label("", $Text, 100, 30));

				$this->AddControl(new Label("", $this->Contract->GetFormalString($Context->GetStrings()), 100, 30));
			}
			else
			{
				$Context->GetVars()->CheatSuspected();
			}
		}
		else
		{
			$this->AddControl(new Label("", "Oups, this contract does not exist", 100, 30));
		}
	}
}

?>
