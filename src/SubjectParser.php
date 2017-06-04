<?php 

include_once('simplehtmldom/simple_html_dom.php');

require 'Subject.php';
require 'Group.php';
require 'Schedule.php';
require 'ScheduleEntry.php';

class SubjectParser
{
	protected $data;
	protected $html;

	public function __construct($data)
	{
		$this->data = $data;
		$this->html = str_get_html($data); 
	}

	public function parseAll()
	{
		$elements = $this->html->find('select', 0)->children();
		$subjects = [];

		foreach($elements as $element)
		{
			if($element->value == '-1' || $element->value == 'PROHIBID')
				continue;

			$subject = new stdClass;
			$subject->id = $element->value;
			$subject->name = $element->innertext;

			$subjects[] = $subject;
		}

		return $subjects;
	}

	public function parse()
	{
		// The second row of the fourth table contains the
		// subject's basic information
		$basicInfo = $this->html->find('table', 3)->find('tr', 1)->children();

		$subject = new Subject([
			'id' => $basicInfo[0]->innertext,
			'name' => $basicInfo[1]->innertext,
			'optional' => $basicInfo[2]->innertext == 'S',
			'credits' => intval($basicInfo[3]->innertext),
			'major' => explode(',', $basicInfo[5]->innertext),
			'groups' => $this->parseGroups(),
		]);

		return $subject;	
	}

	protected function parseGroups()
	{
		// The groups information for the subject is in the table with
		// the class 'interesante'
		$groupsInfo = $this->html->find('.interesante', 0)->children();

		$groups = [];

		foreach ($groupsInfo as $groupInfo)
		{
			$groupBasicInfo = explode('<br>', $groupInfo->find('td', 0)->innertext);
			$enrollInfo = explode('/', substr($groupBasicInfo[3], 6));

			$group = new Group([
				'id' => substr($groupBasicInfo[1], 6),
				'teacher' => $groupBasicInfo[2],
				'enrolledStudents' => $enrollInfo[0],
				'capacity' => $enrollInfo[1],
				'schedule' => $this->parseSchedule($groupInfo->find('table', 0)),
			]);

			$groups[] = $group;
		}

		return $groups;
	}

	protected function parseSchedule($scheduleInfo)
	{
		$scheduleEntriesInfo = $scheduleInfo->children();
		array_shift($scheduleEntriesInfo);

		$entries = [];

		foreach($scheduleEntriesInfo as $entryInfo)
		{
			$entryElements = $entryInfo->children();

			$entry = new ScheduleEntry([
				'day' => $this->getDayNumber($entryElements[0]->innertext),
				'startTime' => $entryElements[1]->innertext,
				'endTime' => $entryElements[2]->innertext,
				'classroom' => $entryElements[3]->innertext,
			]);

			$entries[] = $entry;
		}

		$schedule = new Schedule($entries);

		return $schedule;	
	}

	protected function getDayNumber($day)
	{
	    switch($day) {
	        case 'Lun': return 0;
	        case 'Mar': return 1;
	        case 'Mie': return 2;
	        case 'Jue': return 3;
	        case 'Vie': return 4;
	        case 'Sab': return 4;
	        default: return -1;
	    } 
	}
}