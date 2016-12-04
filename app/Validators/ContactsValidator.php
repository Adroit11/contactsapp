<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use App\Validators\Contracts\ContactsValidatorInterface as Contract;

class ContactsValidator implements Contract
{
	protected $validator;

	public function __construct(Factory $validator)
	{
		$this->validator = $validator;
	}

	public function create(array $data)
	{
		return $this->validator->make($data, [
			'name' => 'required',
			'last_name' => 'required',
			'phone_number' => 'required|digits:10'

		]);
	}

	public function exists(array $data)
	{
		return $this->validator->make($data,[
			'uid' => 'required|exists:contacts,id'
		]);
	}

	public function update(array $data)
	{
		return $this->validator->make($data, [
			'uid' => 'required|exists:contacts,id',
			'name' => 'required',
			'last_name' => 'required',
			'phone_number' => 'required|digits:10'
		]);
	}
}