<?php

class ScheduleEntry
{
	public $day;
	public $startTime;
	public $endTime;
	public $classroom;

	public function __construct(array $data)
	{
		$this->day = $data['day'];
		$this->startTime = $data['startTime'];
		$this->endTime = $data['endTime'];
		$this->classroom = $data['classroom'];
	}
}