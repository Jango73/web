<?php

require_once 'GlobalVars.php';
require_once 'Renderable.php';
require_once 'Strings.php';

class RenderContext
{
    protected $ControlText;
	protected $Text;
	protected $Vars;
	protected $PageClasses;
	protected $Indent;
	protected $Strings;

	public function __construct()
	{
		$this->Indent = 1;
		$this->Vars = new GlobalVars();
		$this->Strings = new Strings($this->Vars->Lang);
		$this->PageClasses = array();
		$this->Clear();
	}

	public function RegisterPage($PageName, $PageController)
	{
		$PageName = $PageName;
		$this->PageClasses[$PageName] = $PageController;
	}

	public function GetVars()
	{
		return $this->Vars;
	}

	public function GetStrings()
	{
		return $this->Strings;
	}

	public function GetString($Code)
	{
		return $this->Strings->GetString($Code);
	}

	public function Clear()
	{
		$this->Text = "";
	}

	public function OpenParagraph($CSSClass = '')
	{
		$this->Text .= "<div>";
		$this->Text .= "<p class='" . $CSSClass . "'>";
	}

	public function CloseParagraph()
	{
		$this->Text .= "</p>";
		$this->Text .= "</div>\n";
	}

	public function GetIndentString()
	{
		$Text = '';

		for ($Index = 0; $Index < $this->Indent; $Index++)
		{
			$Text .= '	';
		}

		return $Text;
	}

	public function AddText($AddText)
	{
		$this->Text .= $this->GetIndentString() . $AddText;
	}

	public function IncIndent()
	{
		$this->Indent++;
	}

	public function DecIndent()
	{
		$this->Indent--;
	}

	public function NewLine()
	{
		$this->Text .= "<br>";
	}

	public function GetText()
	{
		return $this->Text;
	}

    public function AddControlText($AddText)
    {
        $this->ControlText .= $AddText;
    }

    public function GetControlText()
    {
        return $this->ControlText;
    }

	public function AddButton($ID, $Label)
	{
		echo "<input type='button' name='" . $ID . "' value='" . $Label . "'></input>";
	}

	public function Render()
	{
		$RequiredPage = $this->Vars->Page;
		$WrongPage = 'WrongPage';

		if (isset($this->PageClasses[$RequiredPage]))
		{
			$Class = new ReflectionClass($this->PageClasses[$RequiredPage]);
			$Class->newInstanceArgs(Array($this, $this->PageClasses[$RequiredPage]))->Render($this);
			return;
		}

		if ($this->PageClasses[$WrongPage] != null)
		{
			$Class = new ReflectionClass($this->PageClasses[$WrongPage]);
			$Class->newInstanceArgs(Array($this, $this->PageClasses[$WrongPage]))->Render($this);
		}
	}

	public function ProcessEvents()
	{
		$RequiredPage = $this->Vars->Page;

		if (isset($this->PageClasses[$RequiredPage]))
		{
			$Class = new ReflectionClass($this->PageClasses[$RequiredPage]);
			return $Class->newInstanceArgs(Array($this, $this->PageClasses[$RequiredPage]))->ProcessEvents($this);
		}

		return '';
	}

	public function RedirectToPage($Page, $Args)
	{
		$Page = $Page;

		$Text = "";
		$Text .= "window.location = '?page=" . $Page;

		if ($Args != null)
		{
			foreach ($Args as $Key => $Value)
			{
				$Text .= "&" . $Key . "=" . $Value;
			}
		}

		$Text .= "';";

		return $Text;
	}

	public function DebugOut($Text)
	{
		return "DebugOut(\"" . $Text . "\");";
	}

	public function MessageOut($Text)
	{
		return "MessageOut(\"" . $Text . "\");";
	}

	public function WarningOut($Text)
	{
		return "WarningOut(\"" . $Text . "\");";
	}

	public function ErrorOut($Text)
	{
		return "ErrorOut(\"" . $Text . "\");";
	}
}

?>
