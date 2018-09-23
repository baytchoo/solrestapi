<?php

use App\Address;
use App\Company;
use App\Customer;
use App\Person;
use App\Telephone;
use Faker\Generator as FakerGenerator;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/



$factory->define(Person::class, function (FakerGenerator $faker) {
    // $faker= Faker\Factory::create('en_US');    
    return [

        'title'=> $faker->title,
        'first_name'=> $faker->firstName,
        'last_name' => $faker->lastName,
        'cin' => $faker->unique()->numberBetween(1000000,9999999),
        'email' => $faker->unique()->safeEmail,
        'address_id'=> '0',
    ];

});


$factory->define(Company::class, function (FakerGenerator $faker) {

    return [
        'company_name'=> $faker->company,
        'person_id' =>Person::all()->random()->id,
        'tax_reg_nr' => $faker->lexify($string = '??????'),
        'business_reg_nr' => $faker->lexify($string = '????????'),
        'email' => $faker->unique()->safeEmail,
        'person_id' => Person::all()->unique()->random()->id,
    ];

});

$factory->define(Address::class, function (FakerGenerator $faker) {
    // $faker= Faker\Factory::create('en_US');
    return [
        'street'=> $faker->streetName,
        'nr' => $faker->numberBetween(1,1000),
        'comment' => $faker->realText(100),
        'city'=> $faker->city,
        'country'=> 'tunisie',
        'zip'=> $faker->numberBetween(11111,99999),
        'comment' => $faker->realText(50),
        'lat'=> $faker->latitude,
        'lng'=> $faker->longitude,
    ];

});

$factory->define(Telephone::class, function (FakerGenerator $faker) {
    
    return [
        'type'=> $faker->randomElement(Telephone::TYPES),
        'nr' => $faker->numberBetween(20000000,99999999),
        'comment' => $faker->realText(30),
    ];

});

$factory->define(Customer::class, function (FakerGenerator $faker) {


    
        
        $customerable_id = -1 ;

        $customerable = [
                        Person::class,
                        Company::class,
                        Person::class,
                        Person::class,
                        ];

                            
                            
         $customerable_type = $customerable[array_rand($customerable,1)];
        
        if(($customerable_type==Company::class) && ((Customer::where(['customerable_type' => Company::class])->get()->count()) >= 25 )){

            $customerable_type = Person::class;
        }
        $temp = true;
        if ($customerable_type==person::class) {
            $customerable_id = Person::all()->random()->id;
            

        } else {
            $customerable_id = Person::all()->random()->id;
                
        }
       
        error_log( $customerable_id . " - " . $customerable_type );
        error_log( Customer::all()->count());
    return [
        'description' => $faker->realText(50),
        'customerable_id' => $customerable_id,
        'customerable_type' => $customerable_type,
    ];

});
