<?php

require_once("php-entities/DataAccess/Entity.php");
require_once("DBNames.php");

require_once("EBrand.php");
require_once("EResourceType.php");
require_once("EProductType.php");
require_once("ESurface.php");

class EContractDue extends Entity
{
	var $ID_Type;
	var $ID_Brand;
	var $ID_Resource_Type;
	var $ID_Product_Type;
	var $ID_Building;
	var $ID_Surface;
	var $ID_Company;
	var $ID_Group;
	var $Amount;

	var $Brand;
	var $Resource;
	var $Product;
	var $Building;
	var $Surface;
	var $Company;
	var $Group;

	public function __construct ()
	{
		parent::__construct();

		$this->TableName = DBNames::Tbl_ContractDue;

		$this->AddColumns(Array(
			DBNames::Tbl_ContractDue_Col_ID_Type,
			DBNames::Tbl_ContractDue_Col_ID_Brand,
			DBNames::Tbl_ContractDue_Col_ID_Resource_Type,
			DBNames::Tbl_ContractDue_Col_ID_Product_Type,
			DBNames::Tbl_ContractDue_Col_ID_Building,
			DBNames::Tbl_ContractDue_Col_ID_Surface,
			DBNames::Tbl_ContractDue_Col_ID_Company,
			DBNames::Tbl_ContractDue_Col_ID_Group,
			DBNames::Tbl_ContractDue_Col_Amount
		));
	}

	public function GetChildren()
	{
		$Search = new EBrand();
		$this->Brand = $Search->GetSingle($this->ID_Brand, true);

		$Search = new EResourceType();
		$this->Resource = $Search->GetSingle($this->ID_Resource_Type, true);

		$Search = new EProductType();
		$this->Resource = $Search->GetSingle($this->ID_Product_Type, true);

		$Search = new ESurface();
		$this->Surface = $Search->GetSingle($this->ID_Surface, true);
	}

	public function GetFormalString($Strings)
	{
		switch ($this->ID_Type)
		{
			case DBNames::Enum_ContractDue_Type_Money:
			{
				return $this->Amount . " " . $Strings->GetString("CURRENCY_PLURAL");
			}
			break;

			case DBNames::Enum_ContractDue_Type_Surface_Rent:
			{
				// return "100 square meters of commercial surface";
				$Text = "";

				if ($this->Surface->Residential_M2 > 0)
				{
					$Text .= sprintf(
						$Strings->GetString("SOMESQUAREMETERSOFSOMETHING"),
						$this->Surface->Residential_M2,
						$Strings->GetString("RESIDENTIALSURFACE")
					);
				}

				if ($this->Surface->Industrial_M2 > 0)
				{
					if ($Text != "") $Text .= ", ";

					$Text .= sprintf(
						$Strings->GetString("SOMESQUAREMETERSOFSOMETHING"),
						$this->Surface->Industrial_M2,
						$Strings->GetString("INDUSTRIALSURFACE")
					);
				}

				if ($this->Surface->Commercial_M2 > 0)
				{
					if ($Text != "") $Text .= ", ";

					$Text .= sprintf(
						$Strings->GetString("SOMESQUAREMETERSOFSOMETHING"),
						$this->Surface->Commercial_M2,
						$Strings->GetString("COMMERCIALSURFACE")
					);
				}

				if ($this->Surface->Storage_M3 > 0)
				{
					if ($Text != "") $Text .= ", ";

					$Text .= sprintf(
						$Strings->GetString("SOMECUBICMETERSOFSOMETHING"),
						$this->Surface->Storage_M3,
						$Strings->GetString("STORAGESURFACE")
					);
				}

				return $Text;
			}
			break;

			case DBNames::Enum_ContractDue_Type_Brand:
			{
				return sprintf(
					$Strings->GetString("USAGEOFBRAND"),
					$this->Brand->Name
				);
			}
			break;

			case DBNames::Enum_ContractDue_Type_Resource:
			{
				return sprintf(
					$Strings->GetString("SOMECUBICMETERSOFSOMETHING"),
					$this->Surface->Storage_M3,
					$Strings->GetString($this->Resource->Code)
				);
			}
			break;

			case DBNames::Enum_ContractDue_Type_Product:
			{
				return sprintf(
					$Strings->GetString("SOMECUBICMETERSOFSOMETHING"),
					$this->Surface->Storage_M3,
					$Strings->GetString($this->Product->Code)
				);
			}
			break;

			case DBNames::Enum_ContractDue_Type_Building:
			{
				return "building";
			}
			break;

			case DBNames::Enum_ContractDue_Type_Vehicle:
			{
				return "vehicle";
			}
			break;

			case DBNames::Enum_ContractDue_Type_Company_Parts:
			{
				return "company parts";
			}
			break;

			case DBNames::Enum_ContractDue_Type_Company:
			{
				return "company";
			}
			break;

			case DBNames::Enum_ContractDue_Type_Group:
			{
				return "group";
			}
			break;
		}

		return "";
	}
}

?>
