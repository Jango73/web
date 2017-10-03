<?php

require_once 'Control.php';
require_once 'Renderable.php';

class MenuEntry extends Control
{
	public function __construct($NewName, $NewText, $Children)
	{
		parent::__construct($NewName, $NewText, 100, 10);

		$this->Controls = $Children;
	}

	public function Render($Context)
	{
		$Context->AddText("<li id='" . $this->Name . "'>\n");
		$Context->IncIndent();

		$Context->AddText($this->Text . "\n");

		if ($this->Controls != null)
		{
			$Context->AddText("<ul>\n");
			$Context->IncIndent();

			parent::Render($Context);

			$Context->DecIndent();
			$Context->AddText("</ul>\n");
		}

		$Context->DecIndent();
		$Context->AddText("</li>\n");
	}
}

class Menu extends Control
{
	public function __construct($NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);
	}

	public function Render($Context)
	{
		// JQX
		// $Text = "$(\"#" . $this->Name . "\").jqxMenu({ width: '" . $this->Width . "', height: '" . $this->Height . "', theme: theme });\n";
		$Text = "$(\"#" . $this->Name . "\").jqxMenu({ width: '" . $this->Width . "', height: '" . $this->Height . "' });\n";
		$Text .= "$(\"#" . $this->Name . "\").css('visibility', 'visible');\n";
		$Context->AddControlText($Text);

		$Text = "";
		$Text .= "$(\"#" . $this->Name . "\").bind('itemclick', function(event)\n";
		$Text .= "{\n";
		$Text .= "	var args = event.args;\n";
		$Text .= "	" . $this->GetEventStringMenu($Context, 'itemclick', 'args.id');
		$Text .= "});\n";
		$Context->AddControlText($Text);

		// HTML
		$Context->AddText("<div id='" . $this->Name . "'>\n");

		$Context->IncIndent();
		$Context->AddText("<ul>\n");

		parent::Render($Context);

		$Context->AddText("</ul>\n");
		$Context->DecIndent();

		$Context->AddText("</div>\n\n");
    }

	public function AddEntry($NewEntry)
	{
		$this->Controls[] = $NewEntry;
	}
}

?>
