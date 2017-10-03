<?php

require_once 'php-entities/Components/Control.php';

class WorldMap extends Control
{
	public function __construct ($NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);
	}
}

?>
