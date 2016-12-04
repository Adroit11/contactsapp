<?php

namespace App\Jobs\Contacts;

use App\Jobs\Job;
use App\Events\Api\ValidationFailed;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Validators\Contracts\ContactsValidatorInterface as Validator;
use App\Repositories\Contracts\ContactsRepositoryInterface as Repo;
use App\Http\Controllers\Api\ApiControllerInterface as Listener;
use App\Events\Api\ObjectFound;

class ShowContact extends Job
{
    protected $validator;
    protected $data;
    protected $repo;
    protected $listener;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct
    (
        Validator $validator, 
        Repo $repo, 
        array $data,
        Listener $listener
    )
    {
        $this->validator = $validator;
        $this->repo = $repo;
        $this->data = $data;
        $this->listener = $listener;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invalid = $this->validate();
        if($invalid){
            return $invalid;
        }
        if($contact = $this->repo->byId($this->data['uid'], true)){
            $response = event(new ObjectFound($contact, $this->listener));
            return $response[0];
        }
    }

    private function validate()
    {
        $validator = $this->validator->exists($this->data);
        if($validator->fails()){
            $response = event(new ValidationFailed(array_flatten($validator->errors()->toArray()), $this->listener));
            return $response[0];
        }
    }
}
