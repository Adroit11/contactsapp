<?php

use App;
use App\Repositories\Contracts\ContactsRepositoryInterface;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactsTest extends TestCase
{

	public function test_display_all_contacts()
	{
		$contactsRepo = App::make(ContactsRepositoryInterface::class);
		$contactsRepo->destroyAll();

		$contacts = [
			['name' => 'foo', 'last_name' => 'bar', 'phone_number' => 1111111111],
			['name' => 'bar', 'last_name' => 'foo', 'phone_number' => 2222222222]
		];

		foreach ($contacts as $contact) {
			$contactsRepo->save($contact);
		}
		$this->assertCount(2, $contactsRepo->getAll(false));

		$this->json('GET', 'api/v1/contacts')->seeJsonEquals(
		[
				'data' => [
					['first_name' => 'foo', 'last_name' => 'bar', 'phone_number' => '1111111111'],
					['first_name' => 'bar', 'last_name' => 'foo', 'phone_number' => '2222222222']

				]
			]		
		);
		$contactsRepo->destroyAll();
	}

}