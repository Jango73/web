<?php

require_once 'Control.php';

class Panel extends Control
{
	public function __construct($NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);
	}

	public function Render($Context)
	{
		// JQX
		// $txt = "$(\"#" . $this->Name . "\").jqxPanel({ width: '" . $this->Width . "', height: '" . $this->Height . "', theme: theme });\n";
		$txt = "$(\"#" . $this->Name . "\").jqxPanel({ width: '" . $this->Width . "', height: '" . $this->Height . "' });\n";
		// $Context->AddControlText($txt);

		// HTML
		// $Context->AddText("<div id='" . $this->Name . "' style='width:" . $this->Width . "px; height:" . $this->Height . "'>\n");
		$Context->AddText("<div id='" . $this->Name . "'>\n");
		// $Context->AddText("<div id='" . $this->Name . "' style='margin:" . $this->Margin . "'>");

		$Context->IncIndent();

		parent::Render($Context);

		$Context->DecIndent();

		$Context->AddText("</div>\n\n");
	}
}

?>
