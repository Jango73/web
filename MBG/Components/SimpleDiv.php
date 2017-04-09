<?php

require_once 'Control.php';

class SimpleDiv extends Control
{
	protected $Columns;

	public function __construct($NewName, $NewText, $NewWidth=100, $NewHeight=30)
	{
		parent::__construct($NewName, $NewText, $NewWidth, $NewHeight);

		$this->Columns = 2;
	}

	public function Render($Context)
	{
		/*
		// HTML
		$Context->AddText("<div id='" . $this->Name . "'>");

		parent::Render($Context);

		$Context->AddText("</div>");
		*/

		$Percentage = 100 / $this->Columns;

		$NumColumns = 0;

		$Context->AddText("<div id='" . $this->Name . "' style='margin:" . $this->Margin . "'>");
		$Context->AddText("<table width='100%' style='font-size: 13px; font-family: Verdana,Arial,sans-serif;'>\n");
		$Context->AddText("<tr>\n");

		if ($this->Controls != null)
		{
			foreach ($this->Controls as $Ctl)
			{
				$Context->AddText("<td width='" . $Percentage . "%'>\n");
				$Ctl->Render($Context);
				$Context->AddText("</td>\n");

				$NumColumns++;
				if ($NumColumns >= $this->Columns)
				{
					$Context->AddText("</tr>\n");
					$Context->AddText("<tr>\n");
					$NumColumns = 0;
				}
			}
		}

		$Context->AddText("</tr>\n");
		$Context->AddText("</table>\n");
		$Context->AddText("</div>");
	}
}

?>
