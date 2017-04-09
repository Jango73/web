<?php

require_once "Page.php";
require_once "RenderContext.php";

require_once "Label.php";
require_once "TitleLabel.php";
require_once "BankAccountPreview.php";

require_once "DataAccess/EBankAccount.php";

class BankAccountsPage extends Page
{
	protected $AccountList;

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
		$this->AddControl(new TitleLabel("", $Context->GetString("MYBANKACCOUNTS"), $this->Width, 30));

		$SearchAccount = new EBankAccount();
		$Crit = Array(
			Entity::GetQualifiedString("CompClient", DBNames::Tbl_Companies_Col_ID_User_Ceo) =>
			$Context->GetVars()->User_ID
		);
		$this->AccountList = $SearchAccount->GetByCriteria($Crit, true);

		$SearchAccount = new EBankAccount();
		$Crit = Array(DBNames::Tbl_BankAccounts_Col_ID_User_Client => $Context->GetVars()->User_ID);
		$this->AccountList = array_merge($this->AccountList, $SearchAccount->GetByCriteria($Crit, true));

		$NewDiv = new SimpleDiv("", "");

		foreach ($this->AccountList as $Account)
		{
			// $OwnedByUser = ($Company->ID_User_Ceo == $Context->GetVars()->User_ID);

			$OwnedByUser = 1;

			$NewDiv->AddControl(new BankAccountPreview($Context, $Account, $OwnedByUser, "Account" . $Account->ID, "", $this->Width, 200));
		}

		$this->AddControl($NewDiv);
	}

	public function Render($Context)
	{
		parent::Render($Context);
	}
}

?>
