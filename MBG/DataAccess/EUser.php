<?php

require_once("Entity.php");

class EUser extends Entity
{
	var $Login;
	var $Password;
	var $Name;
	var $Robot;
    var $Cash;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = "Users";

		$this->AddColumns(Array(
			"Login",
			"Password",
			"Name",
			"Robot",
			"Cash"
		));
	}
}

?>
