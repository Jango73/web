<?php

require_once("Entity.php");

class EPort extends Entity
{
	var $ID_City;
	var $Type;
	var $Name;
	var $Port_Code;
	var $Capacity_Storage_M3;
	var $Capacity_Vehicle;
	var $Capacity_Passenger;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = "Ports";

		$this->AddColumns(Array(
			"ID_City",
			"Type",
			"Name",
			"Port_Code",
			"Capacity_Storage_M3",
			"Capacity_Vehicle",
			"Capacity_Passenger"
		));
	}

	public function GetChildren()
	{
	}
}

?>
