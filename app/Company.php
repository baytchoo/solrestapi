<?php

namespace App;

use App\Address;
use App\Customer;
use App\Person;
use App\Telephone;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name',
        'tax_reg_nr',
        'business_reg_nr',
        'email',
        'address_id',
        'person_id',
    ];

    public function customer()
    {
        return $this->morphone(Customer::class, 'customerable');
    }

    public function person()
    {
        return $this->hasOne(Person::class ,  'foreign_key');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function telephones()
    {
        return $this->morphMany(Telephone::class, 'telephoneable');
    }
}
