<?php

require_once("php-entities/DataAccess/Entity.php");
require_once("DBNames.php");

class ESurface extends Entity
{
	var $Residential_M2;
	var $Industrial_M2;
	var $Commercial_M2;
	var $Storage_M3;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_Surfaces;

		$this->AddColumns(Array(
			DBNames::Tbl_Surfaces_Col_Residential_M2,
			DBNames::Tbl_Surfaces_Col_Industrial_M2,
			DBNames::Tbl_Surfaces_Col_Commercial_M2,
			DBNames::Tbl_Surfaces_Col_Storage_M3
		));
	}
}

?>
