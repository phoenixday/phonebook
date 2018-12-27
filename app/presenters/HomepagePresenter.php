<?php

namespace App\Presenters;

use Nette;
use App\Model\ContactManager;
use App\Model\GroupManager;
use Nette\Application\UI\Form;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	private $contactManager;
	private $groupManager;

	public function __construct(ContactManager $contactManager, GroupManager $groupManager)
	{
		$this->contactManager = $contactManager;
		$this->groupManager = $groupManager;
	}

	public function renderDefault($page = 1, $selectedGroup='all')
	{
		$contacts = [];
		foreach ($this->contactManager->getAllContacts() as $contact)
		{
			$temp = new \stdClass;
			$temp->id = $contact->id;
			$temp->name = $contact->name;
			$temp->surname = $contact->surname;
			$temp->email = $contact->email;
			$temp->phone = $contact->phone;
			$temp->groups = [];
			foreach ($this->contactManager->getContactGroups($contact->id) as $group)
			{
				$temp->groups[] = $this->groupManager->getGroupName($group->id_group);
			}
			if ($selectedGroup == 'all' || in_array($selectedGroup, $temp->groups))
			{
				$contacts[] = $temp;
			}
		}
		$paginator = new Nette\Utils\Paginator;
		$paginator->setItemCount(count($contacts));
		if ($selectedGroup == 'all')
		{
			$paginator->setItemsPerPage(4);
		}
		else
		{
			$paginator->setItemsPerPage(count($contacts));
		}
		$paginator->setPage($page);
		$this->template->paginator = $paginator;
		$this->template->contacts = array_slice($contacts, $paginator->getOffset(), $paginator->getLength());
		$this->template->groups = $this->groupManager->getGroups();
	}

	public function createComponentSelectForm()
	{
		$form = new Form;
		$groups = []; 
		$groups['all'] = 'all';
		foreach ($this->groupManager->getGroups() as $group)
		{
			$groups[$group->name] = $group->name;
		}
		$form->addSelect('selectedGroup', '', $groups);
		$form->addSubmit('select');
		$form->onSuccess[] = [$this, 'selectFormSucceeded'];
		return $form;
	}

	public function selectFormSucceeded(Form $form, \stdClass $values)
	{
		if ($values->selectedGroup != 'all')
		{
			$this->flashMessage('Selected contacts in group ' . $values->selectedGroup);
		}
		$this->redirect('Homepage:', 1, $values->selectedGroup);
	}
}
