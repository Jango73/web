<?php

require_once("DataAccess\Config.php");
require_once("DataAccess\Connection.php");

//-------------------------------------------------------------------------------------------------

// $FileName = "DataAccess/CreateDB.sql";
// $File = fopen($FileName, "r");
// $Text = fread($File, filesize($FileName));
// fclose($File);

//-------------------------------------------------------------------------------------------------

$Conn = new Connection($DB_Host, $DB_Login, $DB_Password, '');
$Conn->Connect();
$Output = $Conn->ExecuteMultiQuery("DROP DATABASE IF EXISTS `MBG`;");
echo $Output; echo "<br>";
$Output = $Conn->ExecuteMultiQuery("CREATE DATABASE IF NOT EXISTS `MBG`;");
echo $Output; echo "<br>";
$Conn->Disconnect();

//-------------------------------------------------------------------------------------------------

$Conn = new Connection($DB_Host, $DB_Login, $DB_Password, $DB_Database);
$Conn->Connect();

$requetes = "";
$sql = file("DataAccess/CreateDB.sql");
foreach ($sql as $l)
{
	if (substr(trim($l),0,2)!="--")
	{
		$requetes .= $l;
	}
}

$num_errors = 0;
 
$reqs = split(";",$requetes);

foreach ($reqs as $req)
{
	$req = trim($req);

	if ($req != '')
	{
		echo $req;
		echo "<br>";
		$Output = $Conn->ExecuteMultiQuery($req);
		// $Output = $Conn->ExecuteDataset($req);

		echo $Output;
		echo "<br>";

		if ($Output != 1)
		{
			$num_errors++;
			echo "<b>";
			echo mysql_error();
			echo "</b><br>";
		}
	}

	// if ($Output != 1) die("ERROR : ".$req);
}

if ($num_errors > 0)
{
	echo 'Errors : ' . $num_errors;
	echo "<br>";
}

// echo mysql_error();

$Conn->Disconnect();

?>
