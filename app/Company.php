<?php

namespace App;

use App\Address;
use App\Customer;
use App\Person;
use App\Telephone;
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
