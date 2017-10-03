<?php

require_once("php-entities/DataAccess/Entity.php");
require_once("php-entities/DataAccess/Connection.php");
require_once("DataAccess/Config.php");

session_start();

Entity::$Connection = new Connection($DB_Host, $DB_Login, $DB_Password, $DB_Database);
Entity::$Connection->Connect();

include("Components/MainPage.php");

Entity::$Connection->Disconnect();

?>
