<?php

require_once "Button.php";
require_once("DataAccess/EUser.php");

if (isset($_SESSION['User']))
{
	echo $_SESSION['User']->Name;
}
else
{
	AddButton('Button_Login', 'Login');
}

?>
