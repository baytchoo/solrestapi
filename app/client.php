<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
	const INDIVIDUAL_CLIENT = '0';
	const COMPANY_CLIENT = '1';

    protected $fillable = [
        'type',
    ];


    public function isIndividualClient()
    {
    	return $this->type == Client::INDIVIDUAL_CLIENT;
    }
}
