<?php

require_once 'Label.php';

class TitleLabel extends Label
{
	public function __construct($NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);
	}

	public function Render($Context)
	{
		// HTML
		$txt = "<div id='" . $this->Name . "' align='center'><p><b>" . $this->Text . "</b></p></div>\n\n";
		$Context->AddText($txt);
	}
}

?>
