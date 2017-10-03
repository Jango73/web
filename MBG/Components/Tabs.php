<?php

require_once 'Control.php';

class Tabs extends Control
{
	public function __construct($NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);
	}

	public function Render($Context)
	{
		// JQX
		/*
		$Text = "$(\"#" . $this->Name . "\").jqxTabs({ "
			. "width: '". $this->Width
			. "', height: '" . $this->Height
			. "', selectionTracker: 'checked"
			. "', theme: theme });\n";
		*/

		$Text = "$(\"#" . $this->Name . "\").jqxTabs({ "
			. "width: '". $this->Width
			. "', height: '" . $this->Height
			. "', selectionTracker: 'checked });\n";

		$Context->AddControlText($Text);

		// HTML
		$Context->AddText("<div id='" . $this->Name . "'>\n");

		$Context->IncIndent();
		$Context->AddText("<ul>\n");

		foreach ($this->Controls as $Ctl)
		{
			$Context->AddText("<li>\n");
			$Context->IncIndent();

			$Context->AddText($Ctl->Text . "\n");

			$Context->DecIndent();
			$Context->AddText("</li>\n");
		}

		$Context->AddText("</ul>\n\n");

		parent::Render($Context);

		$Context->DecIndent();
		$Context->AddText("</div>\n\n");
	}
}

?>
