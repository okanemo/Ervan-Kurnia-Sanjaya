<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\OauthAccessToken;

class UserController extends Controller
{
    private $status = 'error';
    private $statusCode = 400;
    private $message = '';
    private $data = null;

    public function all(Request $request)
    {
       	$this->message = 'User retrieved';
       	$this->data = User::all();
		$this->statusCode = 200;
		$this->status = 'success';
	   
    	return response()->json([
        	'status' => $this->status,
        	'data' => $this->data,
            'message' => $this->message
        ], $this->statusCode);
    }

    public function update(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
            'new_role_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $this->message = $validator->errors()->first();
        } else {
        	$user = null;
        	if ($request->user()->id == $id) {
        		$user = $request->user();
        	} else {
        		$user = User::where('id', $id)->first();
        	}

        	if ($user) {
        		$user->role_id = $request->new_role_id;
        		$update = $user->save();

        		if ($update) {
        			$this->message = 'User role updated';
		    		$this->statusCode = 200;
		    		$this->status = 'success';

        			// Revoke all user access token
        			$revoke = OauthAccessToken::where('user_id', $id)
        				->update([
        					'revoked' => 1
        				]);
        			if ($revoke) {
        				$this->message .= ', token revoked';
        			}
        		} else {
        			$this->message = 'Failed to update user`s role, please try again';
        		}
        	} else {
        		$this->message = 'User not found';
        	}
        }

    	return response()->json([
        	'status' => $this->status,
            'message' => $this->message
        ], $this->statusCode);
    }
}
