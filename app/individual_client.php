<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\client;

class individual_client extends client
{
	protected $table = 'individual_clients';

    protected $fillable = [
        'first_name',
        'last_name',
    ];
}
