<?php

class Group
{
	public $id;
	public $teacher;
	public $enrolledStudents;
	public $capacity;
	public $schedule;

	public function __construct(array $data)
	{
		$this->id = $data['id'];
		$this->teacher = $data['teacher'];
		$this->enrolledStudents = $data['enrolledStudents'];
		$this->capacity = $data['capacity'];
		$this->schedule = $data['schedule'];
	}
}