<?php

require_once("php-entities/DataAccess/Entity.php");
require_once("EUser.php");
require_once("ECountry.php");
require_once("ELifetime.php");

class EGroup extends Entity
{
	var $ID_User_Ceo;
	var $ID_Country;
	var $ID_Lifetime;
	var $Name;
	var $Number;

    var $User_Ceo;
    var $Lifetime;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = 'Groups';
		$this->AddColumns(Array("ID_User_Ceo", "ID_Country", "ID_Lifetime", "Name", "Number"));
	}

	public function GetChildren()
	{
		$SearchUser = new EUser();
		$this->User_Ceo = $SearchUser->GetSingle($this->ID_User_Ceo, true);

        $SearchCountry = new ECountry();
        $this->Country = $SearchCountry->GetSingle($this->ID_Country, true);

        $SearchLifetime = new ELifetime();
        $this->Lifetime = $SearchLifetime->GetSingle($this->ID_Lifetime, true);
    }
}

?>
