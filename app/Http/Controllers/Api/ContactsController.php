<?php 

namespace App\Http\Controllers\Api;

use App;
use Artisan;
use App\Models\Eloquent\Contact;
use Illuminate\Http\Request;
use App\Jobs\Contacts\CreateContact;
use App\Jobs\Contacts\UpdateContact;
use App\Jobs\Contacts\DeleteContact;
use App\Jobs\Contacts\ShowContact;
use App\Http\Controllers\Api\ApiControllerInterface as Contract;
use App\Validators\Contracts\ContactsValidatorInterface as Validator;
use App\Repositories\Contracts\ContactsRepositoryInterface as Repo;

class ContactsController extends ApiController implements Contract
{
	protected $contact;

	public function __construct(Repo $contact)
	{
		$this->contact = $contact;
	}

	public function index()
	{	
		return $this->respond($this->contact->getAll(true));
	}

	public function show($uid)
	{
		return $this->dispatch(new ShowContact(App::make(Validator::class), $this->contact, ['uid' => $uid], $this));
	}

	public function store(Request $request)
	{
		return $this->dispatch(new CreateContact(App::make(Validator::class), $this->contact, $request->all(), $this));
	}

	public function update(Request $request)
	{
		return $this->dispatch(new UpdateContact(App::make(Validator::class), $this->contact, $request->all(), $this));
	}

	public function delete(Request $request, $uid)
	{
		return $this->dispatch(new DeleteContact(App::make(Validator::class), $this->contact, ['uid' => $uid], $this));
	}

	public function refresh()
	{
		Artisan::call('migrate:refresh', ['--force' => true,]);
		factory(Contact::class, 15)->create();
		return $this->respond('contacts refreshed');
	}
}