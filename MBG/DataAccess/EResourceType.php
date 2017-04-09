<?php

require_once("EDictionaryEntry.php");

class EResourceType extends EDictionaryEntry
{
	public function __construct ()
	{
		parent::__construct();

		$this->TableName = "ResourceType";
	}
}

?>
