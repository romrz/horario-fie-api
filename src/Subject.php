<?php 

/**
* 
*/
class Subject
{
	public $id;
	public $name;
	public $optional;
	public $credits;
	public $major;
	public $groups;
	
	function __construct(array $data)
	{
		$this->id = $data['id'];
		$this->name = $data['name'];
		$this->optional = $data['optional'];
		$this->credits = $data['credits'];
		$this->major = $data['major'];
		$this->groups = $data['groups'];
	}
}