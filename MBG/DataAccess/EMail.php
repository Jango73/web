<?php

require_once("php-entities/DataAccess/Entity.php");
require_once("EUser.php");

class EMail extends Entity
{
	var $ID_User;
	var $ID_User_Sender;
	var $Text;

	var $User;
	var $User_Sender;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = 'Mail';
		$this->AddColumns(Array("ID_User", "ID_User_Sender", "Text"));
	}

	public function GetChildren()
	{
		$SearchUser = new EUser();
		$this->User = $SearchUser->GetSingle($ID_User, true);
		$this->User_Sender = $SearchUser->GetSingle($ID_User_Sender, true);
	}
}

?>
