<?php

require_once 'php-entities/Components/Page.php';
require_once 'php-entities/Components/RenderContext.php';

class ProtectedPage extends Page
{
    public function __construct ($Context, $Name)
    {
        parent::__construct($Context, $Name);
    }

    public function checkAccess($Context)
    {
        // Check base features
        if ($Context->GetVars()->User_ID == null)
        {
            $this->AddControl(new Label("", $Context->GetString("NOACCESSIFNOLOGGED"), 100, 30));
            return false;
        }

        return true;
    }
}

?>
