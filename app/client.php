<?php

namespace App;

use Illuminate\Database\Capsule\Eloquent;

class client extends Eloquent
{
	/*const INDIVIDUAL_CLIENT = '0';
	*const COMPANY_CLIENT = '1';
	*/

	protected $table = "clients";



    /*public function isIndividualClient()
    *{
    *	return $this->type == Client::INDIVIDUAL_CLIENT;
    */}
}
