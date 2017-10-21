<?php

require_once "ProtectedPage.php";

require_once 'php-entities/Components/Label.php';
require_once 'php-entities/Components/Button.php';

require_once 'GroupPreview.php';

require_once 'DataAccess/EGroup.php';

class GroupsPage extends ProtectedPage
{
	protected $GroupList;

	public function __construct ($Context, $Name)
	{
		parent::__construct($Context, $Name);

		if ($this->checkAccess($Context))
		{
			// Create controls
	        $this->AddControl(new TitleLabel("Groups", $Context->GetString("MYGROUPS"), 100, 30));

			$this->GroupList = new EGroup();
			$Crit = Array("ID_User_Ceo" => $Context->GetVars()->User_ID);
			$this->GroupList = $this->GroupList->GetByCriteria($Crit, true);

			foreach ($this->GroupList as $Group)
			{
				$OwnedByUser = ($Group->ID_User_Ceo == $Context->GetVars()->User_ID);

				$this->AddControl(new GroupPreview($Context, $Group, $OwnedByUser, 'Group' . $Group->ID, '', $this->Width, 200));
			}
		}
	}

    /*
	public function Render($Context)
	{
		$Context->OpenParagraph('PageTitle');
		$Context->AddText('Companies');
		$Context->CloseParagraph();

		$CompanyList = new ECompany();
		$Crit = Array(0 => Array("Key" => "ID_User_Ceo", "Value" => $Context->GetVars()->User_ID));
		$CompanyList = $CompanyList->GetByCriteria($Crit);

		$Context->OpenParagraph('List');
		foreach ($CompanyList as $Company)
		{
			$Context->AddText($Company->Name);
			$Context->NewLine();
		}
		$Context->CloseParagraph();
	}
    */
}

?>
