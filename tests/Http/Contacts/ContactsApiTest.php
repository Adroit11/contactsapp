<?php

use App\Repositories\Contracts\ContactsRepositoryInterface;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactsApiTest extends TestCase
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
						['uid'=> 1, 'first_name' => 'foo', 'last_name' => 'bar', 'phone_number' => '1111111111'],
						['uid' => 2, 'first_name' => 'bar', 'last_name' => 'foo', 'phone_number' => '2222222222']

				]
			]		
		);
		$contactsRepo->destroyAll();
	}

	public function test_display_contact_by_uid()
	{
		$contactsRepo = App::make(ContactsRepositoryInterface::class);

		$contactsRepo->destroyAll();

		factory(App\Models\Eloquent\Contact::class, 5)->create();

		$contacts = $contactsRepo->getAll();

		$this->assertCount(5, $contacts);

		$firstContact = $contacts->first();

		$this->json('GET', 'api/v1/contacts/'.$firstContact->id)->seeJsonEquals(
			[
				'contact' => [
					'uid' => $firstContact->id,
					'first_name' => $firstContact->name,
					'last_name' => $firstContact->last_name,
					'phone_number' => $firstContact->phone_number
				]

			]
		);
		$contactsRepo->destroyAll();
	}

	public function test_display_error_when_retrieving_invalid_uid()
	{
		$this->json('GET', 'api/v1/contacts/1')->seeJsonEquals(
		[
			'error' => [
				'status_code' => 400,
				'messages' => [
					'The selected uid is invalid.'
				]
			]
				
		]);
	}

	public function test_update_existing_contact()
	{
		$contactsRepo = App::make(ContactsRepositoryInterface::class);
		$contactsRepo->destroyAll();
		factory(App\Models\Eloquent\Contact::class, 3)->create();
		$contacts = $contactsRepo->getAll();
		$contact = $contacts->first();
		$this->json('PATCH', 'api/v1/contacts', ['uid' => $contact->id, 'name' => 'foo', 'last_name' => 'bar', 'phone_number' => '8888888888'])->seeJson();
		$this->json('GET', 'api/v1/contacts/'.$contact->id)->seeJsonEquals(
			[
				'contact' => [
					'uid' => $contact->id,
					'first_name' => 'foo',
					'last_name' => 'bar',
					'phone_number' => '8888888888'
				]

			]
		);
		$contactsRepo->destroyAll();
	}

	public function test_create_new_contact()
	{
		$contactsRepo = App::make(ContactsRepositoryInterface::class);
		$contactsRepo->destroyAll();
		factory(App\Models\Eloquent\Contact::class, 2)->create();
		$this->assertCount(2, $contactsRepo->getAll(false));
		$this->json('POST', 'api/v1/contacts', ['name' => 'foo', 'last_name' => 'bar', 'phone_number' => '8888888888'])->seeJson();
		$contact = $contactsRepo->byName('foo');
		$this->json('GET', 'api/v1/contacts/'.$contact->id)->seeJsonEquals(
			[
				'contact' => [
					'uid' => $contact->id,
					'first_name' => 'foo',
					'last_name' => 'bar',
					'phone_number' => '8888888888'
				]

			]
		);
		$this->assertCount(3, $contactsRepo->getAll(false));
		$contactsRepo->destroyAll();
	}

	public function test_remove_contact()
	{
		$contactsRepo = App::make(ContactsRepositoryInterface::class);
		$contactsRepo->destroyAll();
		factory(App\Models\Eloquent\Contact::class, 2)->create();
		$contacts = $contactsRepo->getAll();
		$this->assertCount(2, $contacts);
		$contact = $contacts->first();		
		$this->json('DELETE', 'api/v1/contacts', ['uid' => $contact->id])->seeJsonEquals([
			'message' => 'Contact removed.'
		]);
		$contacts = $contactsRepo->getAll();
		$this->assertCount(1, $contacts);
		$contactsRepo->destroyAll();
	}

	public function test_display_errors_when_creating_contact_with_empty_fields()
	{
		$this->json('POST', 'api/v1/contacts', ['name' => '', 'last_name' => '', 'phone_number' => ''])->seeJsonEquals([
			'error' => 	[
				'status_code' => 400,
				'messages' => ["The name field is required.", "The last name field is required.", "The phone number field is required."]
			]

		]);
	}
}