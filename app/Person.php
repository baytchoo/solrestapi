<?php

namespace App;

use App\Customer;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'first_name',
        'last_name', 
    ];

    public function customer()
    {
        return $this->morphone(Customer::class, 'customerable');
    }
}
