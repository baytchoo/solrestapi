<?php

namespace solider;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
	protected $primaryKey = 'id';
	protected $hidden = array('pivot');
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'display_name', 
        'description',
    ];
}
