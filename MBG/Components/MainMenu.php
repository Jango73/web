<?php

require_once "php-entities/Components/Menu.php";
require_once "php-entities/Components/RenderContext.php";

class MainMenuHandler extends EventHandler
{
	public function HandleEvent($Context, $Control, $Event, $Param)
	{
		switch ($Event)
		{
			case "itemclick" :
			{
				switch ($Param)
				{
					case "Home" : return $Context->RedirectToPage("Home", null);
					case "LogIn" : return $Context->RedirectToPage("LogIn", null);
					case "MyGroups" : return $Context->RedirectToPage("Groups", null);
					case "MyCompanies" : return $Context->RedirectToPage("Companies", null);
					case "CreateCompany" : return $Context->RedirectToPage("CompanyCreate", null);
					case "MyAccounts" : return $Context->RedirectToPage("BankAccounts", null);
					case "LogOut" :
					{
						$Context->GetVars()->UnloadUser();
						return $Context->RedirectToPage("Home", null);
					}
					break;
					default :
					{
						return $Context->MessageOut($Param . " : not implemented");
					}
					break;
				}
			}
			break;
		}

		return "";
	}
}

class MainMenu extends Menu
{
	public function __construct($Context)
	{
		parent::__construct("MainMenu", "", $Context->GetVars()->PageWidth, 30);

		$LoggedIn = $Context->GetVars()->User_ID != null;

		$GroupsMenu = array();
		$GroupsMenu [] = new MenuEntry("MyGroups", $Context->GetString("MYGROUPS"), null);
		$GroupsMenu [] = new MenuEntry("SearchGroups", $Context->GetString("SEARCHGROUPS"), null);
		$GroupsMenu [] = new MenuEntry("CreateGroup", $Context->GetString("CREATEGROUP"), null);

		$CompaniesMenu = array();
		$CompaniesMenu [] = new MenuEntry("MyCompanies", $Context->GetString("MYCOMPANIES"), null);
		$CompaniesMenu [] = new MenuEntry("SearchCompanies", $Context->GetString("SEARCHCOMPANIES"), null);
		$CompaniesMenu [] = new MenuEntry("CreateCompany", $Context->GetString("CREATECOMPANY"), null);

		$BankMenu = array();
		$BankMenu [] = new MenuEntry("MyAccounts", $Context->GetString("MYBANKACCOUNTS"), null);
		$BankMenu [] = new MenuEntry("SignUpAccount", $Context->GetString("CREATEBANKACCOUNT"), null);

		$MarketMenu = array();
		$MarketMenu [] = new MenuEntry("ViewMarket", $Context->GetString("VIEWMARKET"), null);

		$LawMenu = array();
		$LawMenu [] = new MenuEntry("Affairs", $Context->GetString("VIEWAFFAIRS"), null);
		$LawMenu [] = new MenuEntry("Lawyers", $Context->GetString("LAWYERS"), null);

		$PersonalMenu = array();
		$PersonalMenu [] = new MenuEntry("Contacts", $Context->GetString("CONTACTS"), null);
		$PersonalMenu [] = new MenuEntry("Mail", $Context->GetString("MAIL"), null);

		$this->AddEntry(new MenuEntry("Home", $Context->GetString("HOME"), null));

		if ($LoggedIn)
		{
			$this->AddEntry(new MenuEntry("Groups", $Context->GetString("GROUPS"), $GroupsMenu));
			$this->AddEntry(new MenuEntry("Companies", $Context->GetString("COMPANIES"), $CompaniesMenu));
			$this->AddEntry(new MenuEntry("Bank", $Context->GetString("BANK"), $BankMenu));
			$this->AddEntry(new MenuEntry("Market", $Context->GetString("MARKET"), $MarketMenu));
			$this->AddEntry(new MenuEntry("Law", $Context->GetString("LAW"), $LawMenu));
			$this->AddEntry(new MenuEntry("Personal", $Context->GetString("PERSONAL"), $PersonalMenu));
			$this->AddEntry(new MenuEntry("Underground", $Context->GetString("UNDERGROUND"), null));
			$this->AddEntry(new MenuEntry("LogOut", $Context->GetString("LOGOUT"), null));
		}
		else
		{
			$this->AddEntry(new MenuEntry("LogIn", $Context->GetString("LOGIN"), null));
			$this->AddEntry(new MenuEntry("CreateAccount", $Context->GetString("CREATEACCOUNT"), null));
		}

		$this->SetEventHandler(new MainMenuHandler());
	}
}

?>
