<?php

class Schedule
{
	public $entries;
	
	public function __construct(array $entries)
	{
		$this->entries = $entries;
	}
}