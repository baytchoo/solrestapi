<?php

namespace App;

use App\Address;
use App\Customer;
use App\Telephone;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
    	'title',
        'first_name',
        'last_name',
        'cin', 
        'email',
        'address_id',
    ];

    public function telephones()
    {
        return $this->morphMany(Telephone::class, 'telephoneable');
    }

    public function address()
    {
    	return $this->belongsTo(Address::class);
    }

    
}
