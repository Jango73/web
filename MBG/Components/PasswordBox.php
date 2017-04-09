<?php

require_once 'Control.php';

class PasswordBox extends Control
{
	public function __construct($NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);
	}

	public function Render($Context)
	{
		// HTML
		$Text = "<div><input type='password' value='" . $this->Text . "' id='" . $this->Name . "' width='" . $this->Width. "'/></div>\n";
		$Context->AddText($Text);
	}
}

?>
