<?php

require_once("php-entities/DataAccess/Entity.php");
require_once("ECity.php");

class EBuilding extends Entity
{
	var $ID_City;
	var $ID_Company_Owner;
	var $ID_Type;
	var $Name;
	var $Height_M;
	var $Surface_Residential_M2;
	var $Surface_Industrial_M2;
	var $Surface_Commercial_M2;
	var $Surface_Storage_M3;

	var $City;
	var $Company_Owner;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = "Buildings";

		$this->AddColumns(Array(
			"ID_City",
			"ID_Company_Owner",
			"ID_Type",
			"Name",
			"Height_M",
			"Surface_Residential_M2",
			"Surface_Industrial_M2",
			"Surface_Commercial_M2",
			"Surface_Storage_M3"
		));
	}

	public function GetChildren()
	{
		$Search = new ECompany();
		$this->Company_Owner = $Search->GetSingle($this->ID_Company_Owner, true);

		$Search = new ECity();
		$this->City = $Search->GetSingle($this->ID_City, true);
	}
}

?>
