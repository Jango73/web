<?php

class Connection
{
	var $Host;
	var $Login;
	var $Pass;
	var $Database;
	var $Link;

	public function __construct ($Host, $Login, $Pass, $Database)
	{
		$this->Host = $Host;
		$this->Login = $Login;
		$this->Pass = $Pass;
		$this->Database = $Database;
		$this->Link = null;
	}
	
	public function Connect()
	{
		$this->Link = mysqli_connect($this->Host, $this->Login, $this->Pass);

		if ($this->Link != null && $this->Database != '')
		{
			mysqli_select_db($this->Link, $this->Database);
			return true;
		}

		return false;
	}

	public function Disconnect()
	{
		if ($this->Link != null)
		{
			mysqli_close($this->Link);
			$this->Link = null;
		}
	}

	public function ExecuteDataset($Query)
	{
		$Output = Array();
		$Result = mysqli_query($Query, $this->Link);
		if ($Result != null)
		{
			while ($Row = mysqli_fetch_object($Result))
			{
				$Output[] = $Row;
			}
		}
		return $Output;
	}

	public function ExecuteMultiQuery($Query)
	{
		$Result = mysql_unbuffered_query($Query, $this->Link);
		return $Result;
	}

	public function GetLastInsertID()
	{
		return mysql_insert_id($this->Link);
	}
}

?>
