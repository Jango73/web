<?php
    
require_once("php-entities/DataAccess/Entity.php");

class EDictionaryEntry extends Entity
{
    var $Code;

    public function __construct ()
    {
		parent::__construct();

        $this->AddColumns(Array("Code"));
    }

    public function GetChildren()
    {
    }
}

?>
