<?php

require_once("php-entities/DataAccess/Entity.php");

class EBrand extends Entity
{
	var $ID_Company;
	var $Name;

	var $Company;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = "Brands";

		$this->AddColumns(Array(
			"ID_Company",
			"Name"
		));
	}

	public function GetChildren()
	{
		$Search = new ECompany();
		$this->Company = $Search->GetSingle($this->ID_Company, true);
	}
}

?>
