<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
	private $status = 'error';
    private $statusCode = 400;
    private $message = '';
    private $data = null;

    public function login(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        if ($validator->fails()) {
            $this->message = $validator->errors()->first();
        } else {
	        $credentials = request(['email', 'password']);
	        
	        if(!Auth::attempt($credentials)) {
	        	$this->statusCode = 401;
	        	$this->message = 'Username/password not found';
	        } else {
		        $user = $request->user();
		        $tokenResult = $user->createToken('Personal Access Token');
		        $token = $tokenResult->token;
		        if ($request->remember_me) $token->expires_at = Carbon::now()->addWeeks(1);
		        $token->save();

		       	$this->message = 'Login success';
		       	$this->data = $tokenResult->accessToken;
	    		$this->statusCode = 200;
	    		$this->status = 'success';
	        }
        }

    	return response()->json([
        	'status' => $this->status,
        	'data' => $this->data,
            'message' => $this->message
        ], $this->statusCode);
    }

    public function logout(Request $request)
    {
        $revoke = $request->user()->token()->revoke();
        	
        if ($revoke) {
    		$this->message = 'Logout successful';
    		$this->statusCode = 200;
    		$this->status = 'success';
    	} else {
    		$this->message = 'Server failure, please try again';
    	}

        return response()->json([
    		'status' => $this->status,
            'message' => $this->message
        ], $this->statusCode);
    }

    public function register(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        if ($validator->fails()) {
            $this->message = $validator->errors()->first();
        } else {
	        $user = new User([
	            'name' => $request->name,
	            'email' => $request->email,
	            'password' => bcrypt($request->password),
	            'role_id' => 3 // as a member
	        ]);

	        $save = $user->save();
	    	
	    	if ($save) {
	    		$this->message = 'Register complete, please try to log in';
	    		$this->statusCode = 200;
	    		$this->status = 'success';
	    	} else {
	    		$this->message = 'Server failure, please try again';
	    	}
	    }

	    return response()->json([
        	'status' => $this->status,
            'message' => $this->message
        ], $this->statusCode);
    }

    public function user(Request $request)
    {
    	$this->status = 'success';
    	$this->data = $request->user();
    	$this->message = 'User fetched';
    	$this->statusCode = 200;

    	return response()->json([
    		'status' => $this->status,
    		'data' => $this->data,
            'message' => $this->message
        ], $this->statusCode);
    }
}
