<?php

require_once("EDictionaryEntry.php");

class EContractType extends EDictionaryEntry
{
	public function __construct ()
	{
		parent::__construct();

		$this->TableName = "ContractType";
	}
}

?>
