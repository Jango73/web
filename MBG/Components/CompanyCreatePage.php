<?php

require_once "php-entities/Components/Page.php";
require_once "php-entities/Components/RenderContext.php";

require_once "php-entities/Components/Label.php";
require_once "php-entities/Components/TitleLabel.php";
require_once "php-entities/Components/FormButton.php";
require_once "php-entities/Components/TextBox.php";
require_once "php-entities/Components/SimpleDiv.php";

require_once "DataAccess/ECompany.php";

class CreateCompanyHandler extends EventHandler
{
	public function HandleEvent($Context, $Control, $Event, $Param)
	{
		switch ($Event)
		{
			case "click" :
			{
				$Name = $Context->GetVars()->GetVar("CompanyName");
				$Type = $Context->GetVars()->GetVar("CompanyType");

				if ($Context->GetVars()->User_ID != null)
				{
					if ($Name != null)
					{
						$CheckCompany = new ECompany();

						if ($CheckCompany->CheckAvailable(DBNames::Tbl_Companies_Col_Name, $Name))
						{
							$NewCompany = ECompany::Create($Context->GetVars()->User_ID, $Name);

							if ($NewCompany->ID > 0)
							{
								$Args = array("id" => $NewCompany->ID);
								return $Context->RedirectToPage("Company", $Args);
							}
							else
							{
								return $Context->ErrorOut("There was a problem while creating company : " . mysql_error());
							}
						}
						else
						{
							return $Context->WarningOut("This company name is not available. Please choose another one.");
						}
					}
					else
					{
						return $Context->WarningOut($Context->GetString("PROVIDECOMPANYNAME"));
					}
				}
			}
			break;
		}

		return "";
	}
}

class CompanyCreatePage extends Page
{
	public function __construct ($Context, $Name)
	{
		parent::__construct($Context, $Name);

		if ($this->checkAccess($Context))
		{
			// Create controls
			$this->AddControl(new TitleLabel("Companies", $Context->GetString("CREATECOMPANY"), 100, 30));

			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", $Context->GetString("NAME"), 100, 30));
			$NewDiv->AddControl(new TextBox("CompanyName", "", 100, 30));
			$this->AddControl($NewDiv);

			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", $Context->GetString("TYPE"), 100, 30));
			$NewDiv->AddControl(new TextBox("CompanyType", "", 100, 30));
			$this->AddControl($NewDiv);

			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", "", 100, 30));
			$Btn = new FormButton("CreateCompany", $Context->GetString("SUBMITCREATION"), 140, 30);
			$Btn->SetControlNames(Array("CompanyName", "CompanyType"));
			$Btn->SetEventHandler(new CreateCompanyHandler());
			$NewDiv->AddControl($Btn);
			$this->AddControl($NewDiv);
		}
	}
}

?>
