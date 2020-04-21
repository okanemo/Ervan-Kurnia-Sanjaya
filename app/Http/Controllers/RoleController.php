<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    private $status = 'error';
    private $statusCode = 400;
    private $message = '';
    private $data = null;

    public function all(Request $request)
    {
       	$this->message = 'Role retrieved';
       	$this->data = Role::all();
		$this->statusCode = 200;
		$this->status = 'success';
	   
    	return response()->json([
        	'status' => $this->status,
        	'data' => $this->data,
            'message' => $this->message
        ], $this->statusCode);
    }
}
