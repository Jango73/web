<?php

require_once("Entity.php");
require_once("DBNames.php");

require_once("EContractType.php");
require_once("ECompany.php");
require_once("ELifetime.php");
require_once("EContractDue.php");

class EContract extends Entity
{
	var $ID_Company_1;
	var $ID_Company_2;
	var $ID_Type;
	var $ID_Lifetime;
	var $ID_Due_1;
	var $ID_Due_2;
	var $Number;
	var $Signature_Company_1;
	var $Signature_Company_2;
	var $Periodicity_Months;
	var $Periodicity_Days;
	var $Cancel_Notice_Days;
	var $Cancel_Fee;
	var $Last_Statisfied_Time;

	var $Company1;
	var $Company2;
	var $Type;
	var $Lifetime;
	var $Due_1;
	var $Due_2;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_Contracts;

		$this->AddColumns(Array(
			DBNames::Tbl_Contracts_Col_ID_Company_1,
			DBNames::Tbl_Contracts_Col_ID_Company_2,
			DBNames::Tbl_Contracts_Col_ID_Type,
			DBNames::Tbl_Contracts_Col_ID_Lifetime,
			DBNames::Tbl_Contracts_Col_ID_Due_1,
			DBNames::Tbl_Contracts_Col_ID_Due_2,
			DBNames::Tbl_Contracts_Col_Number,
			DBNames::Tbl_Contracts_Col_Signature_Company_1,
			DBNames::Tbl_Contracts_Col_Signature_Company_2,
			DBNames::Tbl_Contracts_Col_Periodicity_Months,
			DBNames::Tbl_Contracts_Col_Periodicity_Days,
			DBNames::Tbl_Contracts_Col_Cancel_Notice_Days,
			DBNames::Tbl_Contracts_Col_Cancel_Fee,
			DBNames::Tbl_Contracts_Col_Last_Statisfied_Time
		));
	}

	public function GetChildren()
	{
		$Search = new ECompany();
		$this->Company1 = $Search->GetSingle($this->ID_Company_1, true);
		$this->Company2 = $Search->GetSingle($this->ID_Company_2, true);

		$Search = new EContractType();
		$this->Type = $Search->GetSingle($this->ID_Type, true);

		$Search = new ELifetime();
		$this->Lifetime = $Search->GetSingle($this->ID_Lifetime, true);

		$Search = new EContractDue();
		$this->Due_1 = $Search->GetSingle($this->ID_Due_1, true);
		$this->Due_2 = $Search->GetSingle($this->ID_Due_2, true);
	}

	public function GetFormalString($Strings)
	{
		$Text = "";

		$Text .= sprintf(
			$Strings->GetString("CONTRACTLINE1"),
			$Strings->GetString($this->Type->Code),
			$this->Company1->Name,
			$this->Company2->Name
		);

		$Text .= sprintf(
			$Strings->GetString("CONTRACTLINE2"),
			$this->Company1->Name,
			$this->Due_1->GetFormalString($Strings),
			$this->Company2->Name,
			$this->Company2->Name,
			$this->Due_2->GetFormalString($Strings),
			$this->Company1->Name
		);

		if ($this->Periodicity_Months > 0 || Periodicity_Days > 0)
		{
		}

		$Text .= sprintf(
			$Strings->GetString("CONTRACTLINE4"),
			$this->Cancel_Notice_Days,
			$this->Cancel_Fee,
			$Strings->GetString("CURRENCY_PLURAL")
		);

		// $Text = sprintf("aa %d bb", $this->Cancel_Notice_Days);

		return $Text;
	}
}

?>
