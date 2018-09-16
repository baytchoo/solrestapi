<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    
	const TYPES = [
		'private',
		'fixe',
		'bureau',
		'maison',
		'fax',
		'autre',
	];
	

	protected $fillable = [
        'type',
        'nr',
        'comment',
    ];


    public function isTypePrivate()
    {
    	return $this->type == 'private';
    }
    
    public function isTypeFixe()
    {
    	return $this->type == 'fixe';
    }
    
    public function isTypeBureau()
    {
    	return $this->type == 'bureau';
    }
    
    public function isTypeMaison()
    {
    	return $this->type == 'maison';
    }
   
    public function isTypeFax()
    {
    	return $this->type == 'fax';
    }
  
    public function isTypeAutre()
    {
    	return $this->type == 'autre';
    }
    

    public function telephoneable()
	{
   		return $this->morphTo();
	}
}
