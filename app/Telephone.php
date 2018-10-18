<?php

namespace solider;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telephone extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    
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
