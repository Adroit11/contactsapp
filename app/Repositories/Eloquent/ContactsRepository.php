<?php 

namespace App\Repositories\Eloquent;

use App;
use App\Models\Eloquent\Contact;
use App\Transformers\Eloquent\Contracts\ContactsTransformerInterface;
use App\Repositories\Contracts\ContactsRepositoryInterface as Contract;

class ContactsRepository extends BaseRepository implements Contract
{
	protected $transformer;

	public function __construct()
	{
		$this->model = new Contact;
		$this->transformer = App::make(ContactsTransformerInterface::class);
	}

	public function getAll($transformed = false)
	{
		$results = $this->all();
		if(!$transformed){
			return $results;
		}
		return fractal()->collection($results)->transformWith($this->transformer)->toArray();
	}
}