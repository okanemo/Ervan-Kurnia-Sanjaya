<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	public function accesses() 
	{
		return $this->hasMany(Access::class);
	}
}
