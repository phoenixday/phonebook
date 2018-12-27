<?php

namespace App\Model;

use Nette;

class GroupManager
{
	use Nette\SmartObject;

	private $database;
	private $groups;

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
		$this->groups = $database->table('groups');
	}

	public function getGroups()
	{
		return $this->groups;
	}

	public function getGroupName($id)
	{
		return $this->groups->get($id)->name;
	}

	public function ifGroupExists($name)
	{
		$count = $this->groups->where('name LIKE ?', $name)->count();
		if ($count) 
		{
			return true;
		}
		return false;
	}

	public function save(\stdClass $values)
	{
		$this->groups->insert($values);
	}
}