<?php

namespace solider;

use solider\Company;
use solider\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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

public function addresseable()
    {
        return $this->morphTo();
    }
}
