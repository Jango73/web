<?php

require_once 'php-entities/Components/Panel.php';
require_once 'php-entities/Components/RenderContext.php';

require_once 'php-entities/Components/Label.php';
require_once 'php-entities/Components/Button.php';
require_once 'php-entities/Components/SimpleDiv.php';

require_once 'DataAccess/EContract.php';

class ManageContractHandler extends EventHandler
{
	public function HandleEvent($Context, $Control, $Event, $Param)
	{
		switch ($Event)
		{
			case "click" :
			{
				$Args = array("id" => $Param);

				return $Context->RedirectToPage("Contract", $Args);
			}
		}

		return "";
	}
}

class ContractPreview extends Panel
{
	protected $Contract;

	public function __construct ($Context, $Contract, $OwnedByUser, $NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);

		$this->Contract = $Contract;

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("TYPE"), 100, 30));
		$NewDiv->AddControl(new Label("ContractType", $this->Contract->Type->Code, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", "Amount", 100, 30));
		$NewDiv->AddControl(new Label("ContractAmount", $this->Contract->Due_1->Amount, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("PERIODICITYMONTHS"), 100, 30));
		$NewDiv->AddControl(new Label("ContractMonths", $this->Contract->Periodicity_Months, 100, 30));
		$this->AddControl($NewDiv);

		$NewDiv = new SimpleDiv("", "");
		$NewDiv->AddControl(new Label("", $Context->GetString("PERIODICITYDAYS"), 100, 30));
		$NewDiv->AddControl(new Label("ContractDays", $this->Contract->Periodicity_Days, 100, 30));
		$this->AddControl($NewDiv);

		if ($OwnedByUser)
		{
			$NewDiv = new SimpleDiv("", "");
			$NewDiv->AddControl(new Label("", "", 100, 30));
			$Btn = new Button("ManageContract" . $this->Contract->ID, $Context->GetString("MANAGE"), 140, 30);
			$Btn->SetParam($this->Contract->ID);
			$Btn->SetEventHandler(new ManageContractHandler());
			$NewDiv->AddControl($Btn);
			$this->AddControl($NewDiv);
		}
	}
}

?>
