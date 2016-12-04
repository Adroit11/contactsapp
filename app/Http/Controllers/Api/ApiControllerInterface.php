<?php 

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

interface ApiControllerInterface
{
	public function index();
	public function show($id);
	public function store(Request $request);
	public function update(Request $request);
	public function delete(Request $request, $uid);
	public function refresh();
	public function respondNotSaved($message);
	public function respond($data, $headers = []);

}