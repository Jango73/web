<?php

require_once 'Control.php';

class TextBox extends Control
{
	public function __construct($NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);
	}

	public function Render($Context)
	{
		// JQX
		// $Text = "$(\"#" . $this->Name . "\").jqxButton({ width: '" . $this->Width . "', height: '" . $this->Height . "', theme: theme });\n";
		// $Context->AddControlText($Text);

		// $Text = "";
		// $Text .= "$(\"#" . $this->Name . "\").bind('click', function()\n";
		// $Text .= "{\n";
		// $Text .= "	" . $this->GetEventString($Context, 'click', $this->Param);
		// $Text .= "});\n";
		// $Context->AddControlText($Text);

		// HTML
		$Text = "<div><input type='text' value='" . $this->Text . "' id='" . $this->Name . "' width='" . $this->Width. "'/></div>\n";
		$Context->AddText($Text);
	}
}

?>
