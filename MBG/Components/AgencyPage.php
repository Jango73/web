<?php

require_once "Page.php";
require_once "RenderContext.php";

require_once "Tabs.php";
require_once "Panel.php";
require_once "Label.php";
require_once "TitleLabel.php";
require_once "Button.php";

require_once "DataAccess/EAgency.php";

class AgencyPage extends Page
{
	protected $Agency;

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
		$this->Agency = new EAgency();
		$this->Agency = $this->Agency->GetSingle($Context->GetVars()->ID, true);

		if ($this->Agency != null)
		{
			if ($this->Agency->Company != null)
			{
				if ($this->Agency->Company->ID_User_Ceo == $Context->GetVars()->User_ID)
				{
					$this->AddControl(new TitleLabel("Agency", $this->Agency->Name, $this->Width, 30));
				}
				else
				{
					$Context->GetVars()->CheatSuspected();
				}
			}
			else
			{
				$this->AddControl(new Label("Agency", "Problem", 100, 30));
			}
		}
		else
		{
			$this->AddControl(new Label("Agency", "Oups, this agency does not exist", 100, 30));
		}
	}
}

?>
