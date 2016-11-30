<?php 

namespace App\Http\Controllers\Api;

use App\Repositories\Contracts\ContactsRepositoryInterface;

class ContactsController extends ApiController
{
	public function index(ContactsRepositoryInterface $contact)
	{	
		return $this->respond($contact->getAll(true));
	}
}