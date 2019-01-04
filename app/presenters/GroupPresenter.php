<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model\GroupManager;

class GroupPresenter extends Nette\Application\UI\Presenter
{
	private $groupManager;

	public function __construct(GroupManager $groupManager)
	{
		$this->groupManager = $groupManager;
	}

	public function createComponentGroupForm()
	{
		$form = new Form;
		$form->addText('name')->setRequired('Enter the name.');
		$form->addSubmit('add');
		$form->onSuccess[] = [$this, 'groupFormSucceeded'];
		return $form;
	}

	public function groupFormSucceeded(Form $form, \stdClass $values)
	{
		if ($this->groupManager->ifGroupExists($values->name))
		{
			$this->flashMessage("The group already exists.");
		}
		else
		{
			$this->groupManager->save($values);
			$this->flashMessage('Group was added.');
		}
		$this->redirect('Homepage:');
	}

	public function actionDelete($selectedGroup)
	{
		$this->groupManager->delete($selectedGroup);
		$this->flashMessage('Group was deleted.');
		$this->redirect('Homepage:');
	}
}