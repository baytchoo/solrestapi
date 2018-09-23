<?php

namespace App;

use App\Person;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street',
        'nr',
        'city',
        'country',
        'zip',
        'comment',
        'lat',
        'lng',
    ];

public function person()
    {
    	return $this->hasOne(Person::class);
    }

}
