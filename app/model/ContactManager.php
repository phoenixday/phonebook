<?php

namespace App\Model;

use Nette;

class ContactManager
{
	use Nette\SmartObject;

	private $database;
	private $contacts;

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
		$this->contacts = $database->table('contacts');
	}

	public function getAllContacts()
	{
		return $this->contacts->order('name, surname');
	}

	public function getContact($id)
	{
		return $this->contacts->get($id);
	}

	public function getContactGroups($id)
	{
		return $this->contacts->get($id)->related('contactGroups');
	}

	public function save($values)
	{
		$contact = $this->contacts->insert([
			'name' => $values->name,
			'surname' => $values->surname,
			'phone' => $values->phone,
			'email' => $values->email,
		]);
		foreach ($values->groups as $group)
		{
			$this->database->table('contactGroups')->insert([
				'id_contact' => $contact->id, 
				'id_group' => $group,
			]);
		}
	}
}