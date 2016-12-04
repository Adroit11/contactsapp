<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response as IlluminateResponse;

class ApiController extends Controller
{
	protected $statusCode = 200;
    
	protected function getStatusCode()
	{
		return $this->statusCode;
	}

	protected function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	public function respondNotSaved($message = 'Not saved')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)->respondWithError($message);
	}

	public function respondForbidden($message = 'Forbidden')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
	}

	public function respondNotFound($message = 'Not found')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
	}

	public function respondCreated($message = 'Success')
	{		
		return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond(['message' => $message ]);	
	}

	public function respondOk($message = 'Ok')
	{
		return $this->setStatusCode(IlluminateResponse::HTTP_OK)->respond(['message' => $message]);
	}

	public function respond($data, $headers = [])
	{
		return response()->json($data, $this->getStatusCode(), $headers);
	}

	public function respondWithError($message)
	{
		$errors = ['status_code' => $this->getStatusCode()];
		if(is_array($message)){
			$errors['messages'] = $message;
		}else{
			$errors['message'] = $message;
		}
		return $this->respond(['error' => $errors]);
	}

}