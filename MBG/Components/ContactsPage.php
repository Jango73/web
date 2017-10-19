<?php

require_once 'php-entities/Components/Page.php';
require_once 'php-entities/Components/RenderContext.php';

class ContactsPage extends Page
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
