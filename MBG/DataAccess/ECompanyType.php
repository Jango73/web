<?php
    
require_once("EDictionaryEntry.php");

class ECompanyType extends EDictionaryEntry
{
    public function __construct ()
    {
		parent::__construct();

        $this->TableName = 'CompanyType';
    }
}

?>
