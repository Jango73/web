<?php

require_once 'Page.php';
require_once 'RenderContext.php';

require_once 'Label.php';
require_once "TitleLabel.php";
require_once 'FormButton.php';
require_once 'TextBox.php';
require_once 'PasswordBox.php';
require_once 'SimpleDiv.php';

require_once 'DataAccess/EUser.php';

class LogInHandler extends EventHandler
{
	public function HandleEvent($Context, $Control, $Event, $Param)
	{
		switch ($Event)
		{
			case "click" :
			{
				$Name = $Context->GetVars()->GetVar("UserName");
				$Pass = $Context->GetVars()->GetVar("UserPassword");

				if ($Name == null)
				{
					return $Context->WarningOut($Context->GetString("PLEASEENTERNAME"));
				}
				else
				if ($Pass == null)
				{
					return $Context->WarningOut($Context->GetString("PLEASEENTERPASS"));
				}
				else
				{
					$User = new EUser();
					$Crit = Array("Login" => $Name);
					$User = $User->GetByCriteria($Crit, false);

					if ($User != null && count($User) == 1)
					{
						if ($Pass == $User[0]->Password)
						{
							$Context->GetVars()->LoadUser($User[0]->ID);
							return $Context->RedirectToPage("Home", null);
						}
						else
						{
							return $Context->WarningOut($Context->GetString("PASSNOMATCH"));
						}
					}
					else
					{
						return $Context->WarningOut($Context->GetString("USERNOTFOUND"));
					}
				}
			}
			break;
		}

		return "";
	}
}

class LogInPage extends Page
{
	public function __construct($Context, $Name)
	{
		parent::__construct($Context, $Name);

		$this->AddControl(new TitleLabel("LogIn", $Context->GetString("LOGIN"), 100, 30));

		if ($Context->GetVars()->User_ID == null)
		{
			$this->AddControl(new Label("", $Context->GetString("PLEASEIDENTIFY")));

			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", $Context->GetString("NAME"), 100, 30));
			$NewDiv->AddControl(new TextBox("UserName", "", 200, 30));
			$this->AddControl($NewDiv);

			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", $Context->GetString("PASSWORD"), 100, 30));
			$NewDiv->AddControl(new PasswordBox("UserPassword", "", 200, 30));
			$this->AddControl($NewDiv);

			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", "", 100, 30));
			$Btn = new FormButton("DoLogIn", $Context->GetString("LOGIN"), 100, 30);
			$Btn->SetControlNames(Array("UserName", "UserPassword"));
			$Btn->SetEventHandler(new LogInHandler());
			$NewDiv->AddControl($Btn);
			$this->AddControl($NewDiv);
		}
		else
		{
			$this->AddControl(new Label("", $Context->GetString("ALREADYLOGGEDIN")));
		}
	}
}

?>
