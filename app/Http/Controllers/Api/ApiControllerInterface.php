<?php 

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

interface ApiControllerInterface
{
	public function index();
	public function show($id);
	public function store(Request $request);
	public function respondNotSaved($message);
	public function respond($data, $headers = []);

}