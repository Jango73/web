<?php

require_once("Connection.php");

class EntityJoin
{
	var $SourceColumnName;
	var $TargetTableName;
	var $TargetColumnName;
	var $Alias;

	public function __construct ($SourceColumnName, $TargetTableName, $TargetColumnName, $Alias)
	{
		$this->SourceColumnName = $SourceColumnName;
		$this->TargetTableName = $TargetTableName;
		$this->TargetColumnName = $TargetColumnName;
		$this->Alias = $Alias;
	}
}

class Entity
{
	static $Connection;
	static $Cache = Array();
	var $TableName;
	var $Columns;
	var $ID;
	var $Joins;

	public static function GetQualifiedString($Table, $Column)
	{
		return "`" . $Table . "`.`" . $Column . "`";
	}

	public function __construct ()
	{
		$this->ID = null;
		$this->Columns = Array("ID");
		$this->Joins = Array();
	}

	public function AddColumns($NewColumns)
	{
		foreach ($NewColumns as $Col)
		{
			$this->Columns[] = $Col;
		}
	}

	public function AddJoins($NewJoins)
	{
		foreach ($NewJoins as $Join)
		{
			$this->Joins[] = $Join;
		}
	}

	public function AddToCache($Object)
	{
		$ClassName = get_class($this);

		$AlreadyCached = 0;

		foreach (Entity::$Cache as $Cache)
		{
			if ($Cache != null && get_class($Cache) == $ClassName && $Cache->ID == $Object->ID)
			{
				$AlreadyCached = 1;
				break;
			}
		}

		if ($AlreadyCached == 0)
		{
			Entity::$Cache[] = $Object;
		}
	}

	public function GetFromCache($ID)
	{
		$ClassName = get_class($this);

		foreach (Entity::$Cache as $Cache)
		{
			if ($Cache != null && get_class($Cache) == $ClassName && $Cache->ID == $ID)
			{
				return $Cache;
			}
		}

		return null;
	}

	public function CheckAvailable($Column, $Value)
	{
		$Criteria = Array($Column => $Value);
		$Objects = $this->GetByCriteria($Criteria);

		if (count($Objects) > 0) return false;

		return true;
	}

	public function Persist($IncludeChildren = false)
	{
		$Output = "";

		if ($this->ID == null)
		{
			$Output .= $this->CreateInsertClause();
		}
		else
		{
			$Criteria = Array("ID" => $this->ID);

			$Output .= $this->CreateUpdateClause();
			$Output .= $this->CreateWhereClause($Criteria);
		}

		$Result = Entity::$Connection->ExecuteMultiQuery($Output);

		if ($Result && $this->ID == null)
		{
			$this->ID = Entity::$Connection->GetLastInsertID();
		}

		if ($IncludeChildren)
		{
			$this->PersistChildren($IncludeChildren);
		}

		// Cache object
		$this->AddToCache($this);

		return $Result;
	}

	public function PersistChildren($IncludeChildren = false)
	{
	}

	public function GetSingle($InputID, $GetChildren = false, $IgnoreFields = "")
	{
		$Criteria = Array("ID" => $InputID);
		$Values = $this->GetByCriteria($Criteria, $GetChildren, $IgnoreFields);

		if (count($Values) > 0) return $Values[0];

		return null;
	}

	public function GetCountByCriteria($Criteria, $StartIndex, $Count, $GetChildren = false, $IgnoreFields = "")
	{
	}

	public function GetByCriteria($Criteria, $GetChildren = false, $IgnoreFields = "")
	{
		return $this->GetByCriteriaRanged($Criteria, 0, 0, $GetChildren, $IgnoreFields);
	}

	public function GetByCriteriaRanged($Criteria, $StartIndex, $Count, $GetChildren = false, $IgnoreFields = "")
	{
		if (count($Criteria) == 1 && isset($Criteria["ID"]))
		{
			$CachedObject = $this->GetFromCache($Criteria["ID"]);

			if ($CachedObject != null)
			{
				return Array($CachedObject);
			}
		}

		$Output = "";
		$Output .= $this->CreateSelectClause();
		$Output .= $this->CreateWhereClause($Criteria);

		// echo $Output . "<br><br>";

		$Dataset = Entity::$Connection->ExecuteDataset($Output);
		$Objects = Array();
		$ClassName = get_class($this);
		$RefClass = new ReflectionClass($ClassName);

		foreach ($Dataset as $DataRow)
		{
			$Instance = $RefClass->newInstance();

			$InstanceProperties = $RefClass->getProperties();

			foreach ($InstanceProperties as $Property)
			{
				if ($Property->getName() == "Connection")
				{
					// $Property->setValue($Instance, $this->Connection);
				}
				else
				{
					foreach ($DataRow as $Key => $Data)
					{	
						if ($Property->getName() == $Key)
						{
							$Property->setValue($Instance, $Data);
						}
					}
				}
			}

			// Select child objects
			if ($GetChildren) $Instance->GetChildren();

			$Objects[] = $Instance;
		}

		// Cache results
		foreach ($Objects as $Object)
		{
			$this->AddToCache($Object);
		}

		return $Objects;
	}

	public function CreateInsertClause()
	{
		$Output = "INSERT INTO " . $this->TableName;
		$Output .= " ( ";
		$Fields = GetClassProperties(get_class($this), $types="public");
		$First = true;

		foreach ($Fields as $f)
		{
			$Name = $f->getName();
			$Value = $f->getValue($this);

			if ($Value != null && $this->IsDatabaseField($Name) && $Name != "ID")
			{
				if ($First == false) $Output .= ", ";
				$Output .= "`" . $Name . "`";
				$First = false;
			}
		}

		$Output .= " ) VALUES ( ";
		$First = true;

		foreach ($Fields as $f)
		{
			$Name = $f->getName();
			$Value = $f->getValue($this);

			if ($Value != null && $this->IsDatabaseField($Name) && $Name != "ID")
			{
				if ($First == false) $Output .= ", ";
				$Output .= "'" . $Value . "'";
				$First = false;
			}
		}

		$Output .= " );";
		return $Output;
	}

	public function CreateUpdateClause()
	{
		$Output = "UPDATE " . $this->TableName . " ";
		$Output .= "SET ";
		$Fields = GetClassProperties(get_class($this), $types="public");
		$First = true;

		foreach ($Fields as $f)
		{
			$Name = $f->getName();
			$Value = $f->getValue($this);

			if ($this->IsDatabaseField($Name))
			{
				$Output .= $Name . "=" . $Value;
				if ($First == false) $Output .= ", ";
				$First = false;
			}
		}

		return $Output;
	}

	public function CreateSelectClause()
	{
		$Output = "SELECT ";
		$Fields = GetClassProperties(get_class($this), $types="public");
		$First = true;

		foreach ($Fields as $f)
		{
			$Name = $f->getName();

			if ($this->IsDatabaseField($Name))
			{
				if ($First == false) $Output .= ", ";
				$Output .= "`" . $this->TableName .  "`.`" . $Name .  "`";
				$First = false;
			}
		}

		$Output .= " FROM " . "`" . $this->TableName . "`";

		// Handle joins
		foreach ($this->Joins as $Join)
		{
			$Output .= " LEFT JOIN " . "`" . $Join->TargetTableName . "`" . " AS " . "`" . $Join->Alias . "`";
			$Output .= " ON " . "`" . $this->TableName . "`.`" . $Join->SourceColumnName . "`";
			$Output .= " = " . "`" . $Join->Alias . "`.`" . $Join->TargetColumnName . "`";
		}

		return $Output;
	}

	public function CreateWhereClause($Criteria)
	{
		if (count($Criteria) == 0) return "";
		$Output = " WHERE 1=1";

		foreach ($Criteria as $Key => $Value)
		{
			if (strstr($Key, "."))
			{
				$Output .= " AND " . $Key . "='" . $Value . "'";
			}
			else
			{
				$Output .= " AND " . Entity::GetQualifiedString($this->TableName, $Key) . "='" . $Value . "'";
			}
		}

		return $Output;
	}

	public function CreateGetLastIDClause()
	{
		return "SELECT LAST_INSERT_ID();";
	}

	public function GetChildren()
	{
	}

	public function IsDatabaseField($Fld)
	{
		foreach ($this->Columns as $Col)
		{
			if ($Col == $Fld) return true;
		}
		return false;
	}
}

function GetClassProperties($className, $types = "public")
{
	$ref = new ReflectionClass($className);
	$props = $ref->getProperties();
	$props_arr = array();

	foreach ($props as $prop)
	{
		$f = $prop->getName();

		if($prop->isPublic() and (stripos($types, "public") === FALSE)) continue;
		if($prop->isPrivate() and (stripos($types, "private") === FALSE)) continue;
		if($prop->isProtected() and (stripos($types, "protected") === FALSE)) continue;
		if($prop->isStatic() and (stripos($types, "static") === FALSE)) continue;

		$props_arr[$f] = $prop;
	}

	if ($parentClass = $ref->getParentClass())
	{
		$parent_props_arr = getClassProperties($parentClass->getName());
		if (count($parent_props_arr) > 0) $props_arr = array_merge($parent_props_arr, $props_arr);
	}

	return $props_arr;
} 

?>
