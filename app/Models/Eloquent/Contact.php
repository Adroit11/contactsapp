<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'last_name', 'phone_number'];

    public function setNameAttribute($value)
    {
    	$this->attributes['name'] = title_case($value);
    }

    public function setLastNameAttribute($value)
    {
    	$this->attributes['last_name'] = title_case($value);
    }
}
