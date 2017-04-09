<?php

require_once("EDictionaryEntry.php");

class EContractDueType extends EDictionaryEntry
{
	public function __construct ()
	{
		parent::__construct();

		$this->TableName = "ContractDueType";
	}
}

?>
