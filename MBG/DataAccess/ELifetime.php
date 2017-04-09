<?php

require_once("Entity.php");
require_once("DBNames.php");

class ELifetime extends Entity
{
	var $IssueDate;
	var $CreationDate;
	var $TerminationDate;
	var $IsActive;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_Lifetime;

		$this->AddColumns(Array(
			DBNames::Tbl_Lifetime_Col_IssueDate,
			DBNames::Tbl_Lifetime_Col_CreationDate,
			DBNames::Tbl_Lifetime_Col_TerminationDate,
			DBNames::Tbl_Lifetime_Col_IsActive
		));
	}

	public function GetChildren()
	{
	}

	public static function Create()
	{
		$NewLifetime = new ELifetime();
		// $NewLifetime->IssueDate = new DateTime();
		$NewLifetime->CreationDate = null;
		$NewLifetime->TerminationDate = null;
		$NewLifetime->IsActive = 0;

		$NewLifetime->Persist();

		return $NewLifetime;
	}
}

?>
