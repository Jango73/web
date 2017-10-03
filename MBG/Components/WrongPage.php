<?php

require_once "php-entities/Components/Page.php";
require_once "php-entities/Components/RenderContext.php";

class WrongPage extends Page
{
	public function __construct ($Context, $Name)
	{
		parent::__construct($Context, $Name);
	}

	public function Render($Context)
	{
		$Context->OpenParagraph("PageTitle");
		$Context->AddText($Context->GetString("PAGENOTEXIST"));
		$Context->CloseParagraph();
	}
}

?>
