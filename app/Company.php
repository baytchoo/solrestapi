<?php

namespace App;

use App\Customer;
use App\Person;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name',
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
}
