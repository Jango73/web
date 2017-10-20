<?php

require_once "ProtectedPage.php";

class ContactsPage extends ProtectedPage
{
	public function __construct ($Context, $Name)
	{
		parent::__construct($Context, $Name);

		if ($this->checkAccess($Context))
		{
			// Create controls
			$this->AddControl(new TitleLabel("", "Contacts", $this->Width, 30));
		}
	}
}

?>
