<?php 

namespace App\Repositories\Contracts;

interface ContactsRepositoryInterface
{
	public function getAll($transformed);
	public function destroyAll();
	public function byId($id, $transformed);
	public function byName($name, $transformed);
	public function create(array $data);
	public function getCurrent($transformed);
}