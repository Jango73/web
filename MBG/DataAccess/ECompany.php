<?php

require_once("php-entities/DataAccess/Entity.php");
require_once("DBNames.php");
require_once("EUser.php");
require_once("ECountry.php");
require_once("ECompanyType.php");
require_once("ELifetime.php");

class ECompany extends Entity
{
	var $ID_Group;
	var $ID_User_Ceo;
	var $ID_Country;
	var $ID_Type;
	var $ID_Lifetime;
	var $Name;
	var $Number;
	var $Cash;
	var $Worker_Daily_Wage;

	var $Group;
	var $User_Ceo;
	var $Country;
	var $Type;
	var $Lifetime;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_Companies;

		$this->AddColumns(Array(
			DBNames::Tbl_Companies_Col_ID_Group,
			DBNames::Tbl_Companies_Col_ID_User_Ceo,
			DBNames::Tbl_Companies_Col_ID_Country,
			DBNames::Tbl_Companies_Col_ID_Type,
			DBNames::Tbl_Companies_Col_ID_Lifetime,
			DBNames::Tbl_Companies_Col_Name,
			DBNames::Tbl_Companies_Col_Number,
			DBNames::Tbl_Companies_Col_Cash,
			DBNames::Tbl_Companies_Col_Worker_Daily_Wage
		));

		$this->AddJoins(Array(
			new EntityJoin(DBNames::Tbl_Companies_Col_ID_Lifetime, DBNames::Tbl_Lifetime, DBNames::Generic_Col_ID, DBNames::Tbl_Lifetime)
		));
	}

	public function GetChildren()
	{
		$SearchGroup = new EGroup();
		$this->Group = $SearchGroup->GetSingle($this->ID_Group, true);

		$SearchUser = new EUser();
		$this->User_Ceo = $SearchUser->GetSingle($this->ID_User_Ceo, true);

		$SearchCountry = new ECountry();
		$this->Country = $SearchCountry->GetSingle($this->ID_Country, true);

		$SearchType = new ECompanyType();
		$this->Type = $SearchType->GetSingle($this->ID_Type, true);

		$SearchLifetime = new ELifetime();
		$this->Lifetime = $SearchLifetime->GetSingle($this->ID_Lifetime, true);
	}

	public function PersistChildren($IncludeChildren = false)
	{
	}

	public static function Create($User_ID, $Name)
	{
		$Lifetime = ELifetime::Create();

		$Company = new ECompany();
		$Company->ID_Group = null;
		$Company->ID_User_Ceo = $User_ID;
		$Company->ID_Country = 1;
		$Company->ID_Type = 1;
		$Company->ID_Lifetime = $Lifetime->ID;
		$Company->Name = $Name;
		$Company->Number = 0;
		$Company->Cash = 5000;
		$Company->Worker_Daily_Wage = 10;

		$Company->Persist();
		return $Company;
	}
}

?>
