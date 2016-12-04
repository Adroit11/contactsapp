<?php 

namespace App\Repositories\Eloquent;

use App;
use App\Models\Eloquent\Contact;
use App\Repositories\Contracts\ContactsRepositoryInterface as Contract;
use App\Transformers\Eloquent\Contracts\ContactsTransformerInterface as Transformer;

class ContactsRepository extends BaseRepository implements Contract
{
	protected $transformer;

	public function __construct()
	{
		$this->model = new Contact;
		$this->transformer = App::make(Transformer::class);
	}

	public function getAll($transformed = false)
	{
		$results = $this->all();
		if(!$transformed){
			return $results;
		}
		return fractal()->collection($results)->transformWith($this->transformer)->toArray();
	}

	public function byId($id, $transformed = false)
	{
		$this->model = $this->findOrFail($id);
		if(!$transformed){
			return $this->model;
		}
		return fractal()->item($this->model)->transformWith($this->transformer)->toArray();
	}

	public function byName($name, $transformed = false)
	{
		$this->model = $this->model->whereName($name)->firstOrFail();
		if(!$transformed){
			return $this->model;
		}
		return fractal()->item($this->model)->transformWith($this->transformer)->toArray();
	}

	public function create(array $data)
	{
		if($contact = $this->model->create($data)){
			$this->model = $contact;
			return true;
		}
	}

	public function getCurrent($transformed = false)
	{
		if(!$transformed){
			return $this->model;
		}
		return fractal()->item($this->model)->transformWith($this->transformer)->toArray();
	}
}