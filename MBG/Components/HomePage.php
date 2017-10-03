<?php

require_once 'php-entities/Components/Page.php';
require_once 'php-entities/Components/RenderContext.php';

require_once "php-entities/Components/TitleLabel.php";

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
