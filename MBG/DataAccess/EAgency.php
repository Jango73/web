<?php

require_once("Entity.php");
require_once("DBNames.php");
require_once("ECompany.php");
require_once("EBuilding.php");
require_once("EBrand.php");

class EAgency extends Entity
{
	var $ID_Company;
	var $ID_Building;
	var $ID_Brand;
	var $ID_Contract_Rent;
	var $Name;
	var $Headquarters;
	var $Market_Percent;

	var $Company;
	var $Building;
	var $Brand;
	var $Contract_Rent;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_Agencies;

		$this->AddColumns(Array(
			DBNames::Tbl_Agencies_Col_ID_Company,
			DBNames::Tbl_Agencies_Col_ID_Building,
			DBNames::Tbl_Agencies_Col_ID_Brand,
			DBNames::Tbl_Agencies_Col_ID_Contract_Rent,
			DBNames::Tbl_Agencies_Col_Name,
			DBNames::Tbl_Agencies_Col_Headquarters,
			DBNames::Tbl_Agencies_Col_Market_Percent
		));
	}

	public function GetChildren()
	{
		$SearchCompany = new ECompany();
		$this->Company = $SearchCompany->GetSingle($this->ID_Company, true);

		$SearchBuilding = new EBuilding();
		$this->Building = $SearchBuilding->GetSingle($this->ID_Building, true);

		$SearchBrand = new EBrand();
		$this->Brand = $SearchBrand->GetSingle($this->ID_Brand, true);

		// $SearchContract = new EContract();
		// $this->Contract = $SearchContract->GetSingle($this->ID_Contract_Rent, true);
    }
}

?>
