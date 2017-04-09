<?php

require_once "Panel.php";
require_once "RenderContext.php";

require_once "Label.php";
require_once "Button.php";
require_once "SimpleDiv.php";

require_once "DataAccess/EBankAccount.php";

class ManageAccountHandler extends EventHandler
{
	public function HandleEvent($Context, $Control, $Event, $Param)
	{
		switch ($Event)
		{
			case "click" :
			{
				$Args = array("id" => $Param);
				return $Context->RedirectToPage("BankAccount", $Args);
			}
		}

		return "";
	}
}

class BankAccountPreview extends Panel
{
	protected $Account;

	public function __construct ($Context, $Account, $OwnedByUser, $NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);

		$this->Account = $Account;

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("BANK"), 100, 30));
		$NewDiv->AddControl(new Label("BankOwner", $this->Account->Company_Owner->Name, 100, 30));
		$this->AddControl($NewDiv);

		if ($this->Account->User_Client != null)
		{
			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", $Context->GetString("OWNER"), 100, 30));
			$NewDiv->AddControl(new Label("UserClient", $this->Account->User_Client->Name, 100, 30));
			$this->AddControl($NewDiv);
		}

		if ($this->Account->Company_Client != null)
		{
			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", $Context->GetString("OWNER"), 100, 30));
			$NewDiv->AddControl(new Label("CompanyClient", $this->Account->Company_Client->Name, 100, 30));
			$this->AddControl($NewDiv);
		}

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("TYPE"), 100, 30));
		$NewDiv->AddControl(new Label("BankAccountType", $Context->GetString($this->Account->Type->Code), 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("NUMBER"), 100, 30));
		$NewDiv->AddControl(new Label("BankAccountNumber", $this->Account->Number, 100, 30));
		$this->AddControl($NewDiv);

		if ($OwnedByUser)
		{
			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", $Context->GetString("BALANCE"), 100, 30));
			$NewDiv->AddControl(new Label("BankAccountBalance", $this->Account->Money_Balance, 100, 30));
			$this->AddControl($NewDiv);

			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new SimpleDiv("", ""));
			$Btn = new Button("ManageBankAccount" . $this->Account->ID, $Context->GetString("MANAGE"), 140, 30);
			$Btn->SetParam($this->Account->ID);
			$Btn->SetEventHandler(new ManageAccountHandler());
			$NewDiv->AddControl($Btn);
			$this->AddControl($NewDiv);
		}
	}
}

?>
