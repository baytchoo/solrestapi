<?php

namespace solider;

use solider\Address;
use solider\Customer;
use solider\Person;
use solider\Telephone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'company_name',
        'tax_reg_nr',
        'business_reg_nr',
        'email',
        // 'address_id',
        'person_id',
    ];

    public function customer()
    {
        return $this->morphone(Customer::class, 'customerable');
    }

    public function person()
    {
        return $this->belongsTo(Person::class , 'person_id' , 'id');
    }

    public function address()
    {
        return $this->morphone(Address::class, 'addressable');
    }

    public function telephones()
    {
        return $this->morphMany(Telephone::class, 'telephoneable');
    }
}
