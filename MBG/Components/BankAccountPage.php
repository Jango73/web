<?php

require_once "php-entities/Components/Page.php";
require_once "php-entities/Components/RenderContext.php";

require_once "php-entities/Components/Label.php";
require_once "php-entities/Components/TitleLabel.php";

require_once "BankAccountGeneralInformation.php";

require_once "DataAccess/EBankAccount.php";

class BankAccountPage extends Page
{
	protected $Account;

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
		$this->Account = new EBankAccount();
		$this->Account = $this->Account->GetSingle($Context->GetVars()->ID, true);

		if ($this->Account != null)
		{
			$RightToManage = true;

			if ($this->Account->Company_Client != null)
			{
				if ($this->Account->Company_Client->ID_User_Ceo != $Context->GetVars()->User_ID)
				{
					$RightToManage = false;
				}
			}

			if ($this->Account->User_Client != null)
			{
				if ($this->Account->User_Client->ID != $Context->GetVars()->User_ID)
				{
					$RightToManage = false;
				}
			}

			if ($RightToManage)
			{
				$TabsHeight = 500;

				$this->AddControl(new TitleLabel("BankName", $this->Account->Company_Owner->Name, $this->Width, 30));
				$this->AddControl(new TitleLabel("Account", $Context->GetString("ACCOUNTNUMBER") . " " . $this->Account->Number, $this->Width, 30));

				$Tabs = new Tabs("AccountTabs", $this->Account->Number, $this->Width, $TabsHeight);

				$Tabs->AddControl(new BankAccountGeneralInformation($Context, $this->Account, "GeneralPanel", "General information", $this->Width - 20, $TabsHeight - 20));
				$Tabs->AddControl(new Panel("BrandsPanel", "Deposit/Withdraw", $this->Width - 20, $TabsHeight - 20));
				$Tabs->AddControl(new Panel("AssetsPanel", "Transactions", $this->Width - 20, $TabsHeight - 20));
				$Tabs->AddControl(new Panel("IncomePanel", "Income", $this->Width - 20, $TabsHeight - 20));

				$this->AddControl($Tabs);
			}
			else
			{
				$Context->GetVars()->CheatSuspected();
			}
		}
		else
		{
			$this->AddControl(new Label("Account", "Oups, this account does not exist", 100, 30));
		}
	}
}

?>
