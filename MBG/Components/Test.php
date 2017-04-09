<?php

require_once 'DataAccess/EUser.php';
require_once 'DataAccess/EBuilding.php';
require_once 'DataAccess/EGroup.php';
require_once 'DataAccess/ECompany.php';

$crit = Array(0 => Array("Key" => "Name", "Value" => "admin"));
$v = new EUser();
echo "EUser criteria<br>";
var_dump($crit);
echo "<br>";
echo "EUser admin<br>";
var_dump($v->GetByCriteria($crit, true, ""));
echo "<br>";
$crit = Array();
echo "EUser all<br>";
var_dump($v->GetByCriteria($crit, true, ""));
echo "<br>";
echo "<br>";

$crit = Array(0 => Array("Key" => "ID_City", "Value" => "1"));
$v = new EBuilding();
echo "EBuilding criteria<br>";
var_dump($crit);
echo "<br>";
echo "EBuilding ID_City = 1<br>";
var_dump($v->GetByCriteria($crit, true, ""));
echo "<br>";

$crit = Array();
$v = new EGroup();
echo "EGroup criteria<br>";
var_dump($crit);
echo "<br>";
echo "EGroup all<br>";
var_dump($v->GetByCriteria($crit, true, ""));
echo "<br>";

$crit = Array();
$v = new ECompany();
echo "ECompany criteria<br>";
var_dump($crit);
echo "<br>";
echo "ECompany all<br>";
var_dump($v->GetByCriteria($crit, true, ""));
echo "<br>";

/*
$v = new ECompany();
$v->ID_Group = null;
$v->ID_User_Ceo = 4;
$v->ID_Country = 2;
$v->ID_Type = 15;
$v->Name = 'Gaumont';
$v->Number = '55664477';
$v->Cash = 5000;
$v->Gold_Money = 0;
$v->Worker_Daily_Wage = 5;
echo $v->Persist();
echo mysql_error();
*/

?>
