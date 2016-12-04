<?php 

namespace App\Validators\Contracts;

interface ContactsValidatorInterface
{
	public function create(array $data);
	public function exists(array $data);
	public function update(array $data);

}