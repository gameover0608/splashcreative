<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    
	public function company()
    {
        return $this->belongsTo(Company::class, 'id');
    }

    public function menu()
    {
        return $this->hasOne(Menu::class, 'facility_id');
    }

}
