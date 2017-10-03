<?php

require_once 'Control.php';

class Page extends Control
{
	public function __construct($Context, $Name)
	{
		parent::__construct($Name, '', $Context->GetVars()->PageWidth, 1000);
	}
}

?>
