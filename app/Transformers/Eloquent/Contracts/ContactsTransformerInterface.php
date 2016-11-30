<?php 

namespace App\Transformers\Eloquent\Contracts;

use App\Models\Eloquent\Contact;

interface ContactsTransformerInterface
{
	public function transform(Contact $contact);
}