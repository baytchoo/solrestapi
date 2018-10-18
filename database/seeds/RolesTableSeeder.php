<?php

use Illuminate\Database\Seeder;
use solider\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create([
        	'name' => 'manager',
        	'display_name' => 'manager',
        	'description' => 'Have access to all functions in the system.',
        ]);
	    $user = Role::create([
		    'name' => 'regular_user',
		    'display_name' => 'regular user',
		    'description' => 'Have limited access to some functions in the system.',
	    ]);
	  }
}
