<?php

class EventHandler
{
	protected $Control;

	public function __construct($NewControl)
	{
		$this->Control = $NewControl;
	}

	public function HandleEvent($Event, $Param)
	{
	}
}

?>
