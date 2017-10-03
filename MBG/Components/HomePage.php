<?php

require_once 'Page.php';
require_once 'RenderContext.php';

require_once "TitleLabel.php";

class HomePage extends Page
{
	public function __construct($Context, $Name)
	{
		parent::__construct($Context, $Name);

		$this->AddControl(new TitleLabel("", $Context->GetString("HOME"), $this->Width, 30));
	}

	public function Render($Context)
	{
		parent::Render($Context);

		$Context->OpenParagraph("PageTitle");
		$Context->AddText($Context->GetString("WELCOMETEXT"));
		$Context->CloseParagraph();
	}
}

?>
