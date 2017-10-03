<?php

require_once 'php-entities/Components/Page.php';

class MarketPage extends Page
{
	public function __construct ($Context, $Name)
	{
		parent::__construct($Context, $Name);
	}

	public function Render($Context)
	{
		$Context->OpenParagraph('PageTitle');
		$Context->AddText('Market');
		$Context->CloseParagraph();
	}
}

?>
