<?php

use App\Validators\Contracts\ContactsValidatorInterface as Validator;
use App\Repositories\Contracts\ContactsRepositoryInterface;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactsValidationTest extends TestCase
{

	public function test_return_error_message_on_empty_name_when_storing_new_contact()
	{
		$validator = App::make(Validator::class);
		$data = ['name' => '', 'last_name' => 'bar', 'phone_number' => '5555555555'];
		$validator = $validator->create($data);
		$this->assertTrue($validator->fails());
		$this->assertEquals('The name field is required.', array_flatten($validator->errors()->toArray())[0]);
	}

	public function test_return_error_message_on_empty_last_name_when_storing_new_contact()
	{
		$validator = App::make(Validator::class);
		$data = ['name' => 'foo', 'last_name' => '', 'phone_number' => '5555555555'];
		$validator = $validator->create($data);
		$this->assertTrue($validator->fails());
		$this->assertEquals('The last name field is required.', array_flatten($validator->errors()->toArray())[0]);
	}

	public function test_return_error_message_on_empty_phone_number_when_storing_new_contact()
	{
		$validator = App::make(Validator::class);
		$data = ['name' => 'foo', 'last_name' => 'bar', 'phone_number' => ''];
		$validator = $validator->create($data);
		$this->assertTrue($validator->fails());
		$this->assertEquals('The phone number field is required.', array_flatten($validator->errors()->toArray())[0]);
	}	

	public function test_return_error_message_on_invalid_phone_number_when_storing_new_contact()
	{
		$validator = App::make(Validator::class);
		$data = ['name' => 'foo', 'last_name' => 'bar', 'phone_number' => '888hhh'];
		$validator = $validator->create($data);
		$this->assertTrue($validator->fails());
		$this->assertEquals('The phone number must be 10 digits.', array_flatten($validator->errors()->toArray())[0]);
	}

	public function test_return_error_on_invalid_uid()
	{
		$validator = App::make(Validator::class);
		$validator = $validator->exists(['uid' => 1]);
		$this->assertTrue($validator->fails());
		$this->assertEquals('The selected uid is invalid.', array_flatten($validator->errors()->toArray())[0]);	
	}
}
