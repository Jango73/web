<?php

require_once("php-entities/DataAccess/Entity.php");
require_once("DBNames.php");

class ELifetime extends Entity
{
	var $Issue_Date;
	var $Creation_Date;
	var $Termination_Date;
	var $Is_Active;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_Lifetime;

		$this->AddColumns(Array(
			DBNames::Tbl_Lifetime_Col_Issue_Date,
			DBNames::Tbl_Lifetime_Col_Creation_Date,
			DBNames::Tbl_Lifetime_Col_Termination_Date,
			DBNames::Tbl_Lifetime_Col_Is_Active
		));
	}

	public function GetChildren()
	{
	}

	public static function Create()
	{
		$Lifetime = new ELifetime();
		// $NewLifetime->Issue_Date = new DateTime();
		$Lifetime->Creation_Date = null;
		$Lifetime->Termination_Date = null;
		$Lifetime->Is_Active = 0;

		$Lifetime->Persist();
		return $Lifetime;
	}
}

?>
