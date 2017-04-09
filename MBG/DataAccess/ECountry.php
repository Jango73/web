<?php

require_once("EGovernmentType.php");
require_once("EDictionaryEntry.php");

class ECountry extends EDictionaryEntry
{
    var $ID_GovernmentType;

    var $GovernmentType;

    public function __construct ()
    {
		parent::__construct();

        $this->TableName = "Countries";
        $this->AddColumns(Array("ID_GovernmentType"));
    }

    public function GetChildren()
    {
        $SearchGovernmentType = new EGovernmentType();
        $this->GovernmentType = $SearchGovernmentType->GetSingle($this->ID_GovernmentType, true);
    }
}

?>
