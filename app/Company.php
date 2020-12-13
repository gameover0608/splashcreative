<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    
	public function facilities1()
	{
		return $this->hasMany(Facility::class, 'company_id', 'id')
		->join('menus', 'menus.facility_id', '=', 'facilities.id', 'left')
		->select('facilities.*')
		->orderBy('price', 'ASC');
	}

	public function facilities2()
	{
		return $this->hasMany(Facility::class, 'company_id', 'id')
		->join('menus', 'menus.facility_id', '=', 'facilities.id')
		->select('facilities.*')
		->where('menus.name', 'like', '%Supa%');
	}

}
