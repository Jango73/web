<?php

require_once("Entity.php");

class ETransaction extends Entity
{
	var $ID_BankAccount;
	var $Time;
	var $Text;
	var $Value;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = 'Transactions';
		$this->AddColumns(Array("ID_BankAccount", "Time", "Text", "Value"));
	}

	public function GetChildren()
	{
	}
}

?>
