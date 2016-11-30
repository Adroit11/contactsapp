<?php 

namespace App\Transformers\Eloquent;

use App\Models\Eloquent\Contact;
use League\Fractal\TransformerAbstract;
use App\Transformers\Eloquent\Contracts\ContactsTransformerInterface as Contract;

class ContactsTransformer extends TransformerAbstract implements Contract
{
	public function transform(Contact $contact)
	{
		return [
			'first_name' => $contact->name,
			'last_name' => $contact->last_name,
			'phone_number' => $contact->phone_number
		];
	}

}