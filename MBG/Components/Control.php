<?php

require_once 'Renderable.php';

class EventHandler
{
	public function __construct()
	{
	}

	public function HandleEvent($Context, $Control, $Event, $Param)
	{
		return '';
	}
}

class Control extends Renderable
{
	protected $Name;
	protected $Text;
	protected $Width;
	protected $Height;
	protected $Param;
	protected $Margin;
	protected $EventProcessing;
	protected $EventHandler;
	protected $Controls;

	public function __construct($NewName, $NewText, $NewWidth, $NewHeight)
	{
		parent::__construct();

		$this->Controls = array();

		$this->Name = $NewName;
		$this->Text = $NewText;
		$this->Width = $NewWidth;
		$this->Height = $NewHeight;

		$this->Param = "";
		$this->EventHandler = null;
		$this->EventProcessing = 0;
	}

	public function SetMargin($Margin)
	{
		$this->Margin = $Margin;
	}

	public function Render($Context)
	{
		if ($this->Controls != null)
		{
			foreach ($this->Controls as $Ctl)
			{
				$Ctl->Render($Context);
			}
		}
	}

	public function ProcessEvents($Context)
	{
		$Response = '';

		$this->EventProcessing = 1;

		if ($Context->GetVars()->Control == $this->Name)
		{
			if ($this->EventHandler != null)
			{
				$Response .= $this->EventHandler->HandleEvent
				(
					$Context,
					$this,
					$Context->GetVars()->Event,
					$Context->GetVars()->Param
				);
			}
		}

		if ($this->Controls != null)
		{
			foreach ($this->Controls as $Ctl)
			{
				$Response .= $Ctl->ProcessEvents($Context);
			}
		}

		return $Response;
	}

	public function AddControl($NewControl)
	{
		$this->Controls[] = $NewControl;
	}

	public function GetEventString($Context, $Event, $Param = '')
	{
		$Text = "jQuery.ajax('?page=" . $Context->GetVars()->Page . "&event=" . $Event . "&control=" . $this->Name . "&param=" . $Param . "')\n";
		// $Text .= "	.done(function(msg)\n";
		// $Text .= "	{\n";
		// $Text .= "		eval(msg);\n";
		// $Text .= "	});\n";
		$Text .= ".done(function(msg) { eval(msg); });\n";

		return $Text;
	}

	public function GetEventStringMenu($Context, $Event, $Param = "")
	{
		$Text = "";

		// $Text .= "jQuery.ajax('?page=" . $Context->GetVars()->Page . "&event=" . $Event . "&control=' + " . $Param . ")\n";
		$Text .= "jQuery.ajax('?page=" . $Context->GetVars()->Page . "&event=" . $Event . "&control=" . $this->Name . "&param=' + " . $Param . ")\n";
		// $Text .= "	.done(function(msg)\n";
		// $Text .= "	{\n";
		// $Text .= "		eval(msg);\n";
		// $Text .= "	});\n";
		$Text .= ".done(function(msg) { eval(msg); });\n";

		return $Text;
	}

	public function GetEventStringForm($Context, $Event, $ControlNames)
	{
		$Text = "jQuery.ajax('?page=" . $Context->GetVars()->Page . "&event=" . $Event . "&control=" . $this->Name . "'\n";

		foreach ($ControlNames as $Name)
		{
			$Text .= "+ '&" . $Name . "=' + " . "$(\"#" . $Name . "\")[0].value\n";
		}

		$Text .= ")\n";
		// $Text .= "	.done(function(msg)\n";
		// $Text .= "	{\n";
		// $Text .= "		eval(msg);\n";
		// $Text .= "	});\n";
		$Text .= ".done(function(msg) { eval(msg); });\n";

		return $Text;
	}

	public function SetEventHandler($NewEventHandler)
	{
		$this->EventHandler = $NewEventHandler;
	}

	public function SetParam($NewParam)
	{
		$this->Param = $NewParam;
	}

	public function SetText($NewText)
	{
		if ($this->EventProcessing)
		{
			// JQX
			return "$(\"#" . $this->Name . "\")[0].value = '" . $NewText . "';\n";
		}
		else
		{
			$Text = $NewText;
		}
	}
}

?>
