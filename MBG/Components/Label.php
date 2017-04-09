<?php

require_once 'Control.php';

class Label extends Control
{
	public function __construct($NewName, $NewText, $NewWidth = 100, $NewHeight = 30)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);
	}

	public function Render($Context)
	{
		$Text = "";

		// HTML
		if ($this->Name != "")
		{
			$Text .= "<div id='" . $this->Name . "'><p>" . $this->Text . "</p></div>\n\n";
		}
		else
		{
			$Text .= "<div><p>" . $this->Text . "</p></div>\n\n";
		}

		$Context->AddText($Text);
	}
}

?>
