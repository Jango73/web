<?php

require_once 'Page.php';
require_once "RenderContext.php";

class ContactsPage extends Page
{
	public function __construct ($Context, $Name)
	{
		parent::__construct($Context, $Name);

		// Check base features
		if ($Context->GetVars()->User_ID == null)
		{
			$this->AddControl(new Label("", $Context->GetString("NOACCESSIFNOLOGGED"), 100, 30));
			return;
		}

		// Create controls
		$this->AddControl(new TitleLabel("", "Contacts", $this->Width, 30));
	}
}

?>
