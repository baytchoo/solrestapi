<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'description',
    ];

    public function customerable()
	{
   		return $this->morphTo();
	}
}
