<?php 

namespace App\Repositories\Contracts;

interface ContactsRepositoryInterface
{
	public function getAll($transformed);
	public function destroyAll();
}