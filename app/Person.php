<?php

namespace solider;

use solider\Address;
use solider\Customer;
use solider\Telephone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
    	'title',
        'first_name',
        'last_name',
        'cin', 
        'email',
        // 'address_id',
    ];

    public function telephones()
    {
        return $this->morphMany(Telephone::class, 'telephoneable');
    }

    public function address()
    {
    	return $this->morphone(Address::class, 'addressable');
    }

    public function company()
    {
        return $this->hasMany(Company::class);
    }
    
}
