<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    
	public function facility()
	{
		return $this->belongsTo(Facility::class, 'id');
	}

}
