<?php

require_once("EDictionaryEntry.php");

class EProductType extends EDictionaryEntry
{
	public function __construct ()
	{
		parent::__construct();

		$this->TableName = "ProductType";
	}
}

?>
