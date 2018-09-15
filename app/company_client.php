<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company_client extends Model
{
     protected $fillable = [
        'company_name',
        'fiscal_code',
    ];
}
