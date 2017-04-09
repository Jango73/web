<?php

require_once("EDictionaryEntry.php");

class EBankAccountType extends EDictionaryEntry
{
	public function __construct ()
	{
		parent::__construct();

		$this->TableName = "BankAccountType";
	}
}

?>
