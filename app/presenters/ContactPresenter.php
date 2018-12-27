<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\ContactManager;
use App\Model\GroupManager;

class ContactPresenter extends Nette\Application\UI\Presenter
{
	private $contactManager;
	private $groupManager;

	public function __construct(ContactManager $contactManager, GroupManager $groupManager)
	{
		$this->contactManager = $contactManager;
		$this->groupManager = $groupManager;
	}

	public function renderShow($id)
	{
		$contact = $this->contactManager->getContact($id);
		if (!$contact)
		{
			$this->error('Contact not found.');
		}
		$this->template->contact = $contact;
		$groups = array();
		foreach ($this->contactManager->getContactGroups($id) as $group)
		{
			$groups[] = $this->groupManager->getGroupName($group->id_group);
		}
		$this->template->groups = $groups;
	}

	protected function createComponentContactForm()
	{
		$form = new Form;
		$form->addText('name')->setRequired('Name is required.');
		$form->addText('surname');
		$form->addText('phone')->setRequired('Phone number is required.')->addRule(Form::PATTERN, 'Phone number must contain only numbers and +', '^\+([0-9])+$');
		$form->addEmail('email');
		$groups = array();
		foreach ($this->groupManager->getGroups() as $group)
		{
			$groups[$group->id] = $group->name;
		}
		$form->addMultiSelect('groups', '', $groups)->setHtmlAttribute('class', 'form-control');
		$form->addSubmit('add');
		$form->onSuccess[] = [$this, 'contactFormSucceeded'];
		return $form;
	}

	public function contactFormSucceeded(Form $form, \stdClass $values)
	{
		$this->contactManager->save($values);
		$this->flashMessage('Contact was added.');
		$this->redirect('Homepage:');
	}
}