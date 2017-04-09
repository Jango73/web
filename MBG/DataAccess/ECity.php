<?php

require_once("Entity.php");

class ECity extends Entity
{
	var $ID_Country;
	var $Code;
	var $Population;
	var $Latitude_Degree;
	var $Longitude_Degree;
	var $Factor_Tourism;

	var $Company;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = 'Cities';
		$this->AddColumns(Array("ID_Country", "Code", "Population", "Latitude_Degree", "Longitude_Degree", "Factor_Tourism"));
	}

	public function GetChildren()
	{
	}
}

?>
