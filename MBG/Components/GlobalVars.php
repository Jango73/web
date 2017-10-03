<?php

class GlobalVars
{
	// Volatile variables
	public $Page;
	public $Lang;
	public $Event;
	public $Control;
	public $Param;
	public $ID;
	public $SuspectCheat;

	// Session variables
	public $User_ID;

    public $PageWidth;

	const VarName_UserID = "userid";

	public function __construct()
	{
		$this->CheckCheating();

		$this->Page = $this->GetVar("page");
		$this->Lang = $this->GetVar("lang");
		$this->Event = $this->GetVar("event");
		$this->Control = $this->GetVar("control");
		$this->Param = $this->GetVar("param");
		$this->ID = $this->GetVar("id");

		$this->User_ID = $this->GetVar(GlobalVars::VarName_UserID);

		$this->PageWidth = 1000;

		// Check vars
		if ($this->Page == null || $this->Page == "") $this->Page = "Home";
		if ($this->Lang == null || $this->Lang == "") $this->Lang = "en";
	}

	public function LoadUser($UserID)
	{
		$this->User_ID = $UserID;
		$this->Persist();
	}

	public function UnloadUser()
	{
		$this->User_ID = null;
		$this->Persist();
	}

	public function Persist()
	{
		$this->SetVar(GlobalVars::VarName_UserID, $this->User_ID);
		$this->SetVar("page", $this->Page);
		$this->SetVar("lang", $this->Lang);
		$this->SetVar("id", $this->ID);
	}

	public function GetVar($VarName)
	{
		if ($VarName == "userid")
		{
			if (isset($_SESSION[$VarName])) return $_SESSION[$VarName];
		}
		else
		{
			if (isset($_GET[$VarName])) return $_GET[$VarName];
			if (isset($_POST[$VarName])) return $_POST[$VarName];
			if (isset($_SESSION[$VarName])) return $_SESSION[$VarName];
		}

		return "";
	}

	protected function SetVar($VarName, $Value)
	{
		$_SESSION[$VarName] = $Value;
	}

	protected function CheckCheating()
	{
		$this->SuspectCheat = 0;

		if (isset($_GET[GlobalVars::VarName_UserID])) $this->SuspectCheat = 1;
		if (isset($_POST[GlobalVars::VarName_UserID])) $this->SuspectCheat = 1;
	}

	public function CheatSuspected()
	{
		$this->SuspectCheat = 1;
	}
}

?>
