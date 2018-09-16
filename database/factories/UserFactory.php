<?php

use App\Company;
use App\Customer;
use App\Person;
use App\Telephone;
use Faker\Generator as Faker;

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

$factory->define(Telephone::class, function (Faker $faker) {
    
    return [
        'type'=> $faker->randomElement(Telephone::TYPES),
        'last_name' => $faker->phoneNumber,
    ];

});

$factory->define(Person::class, function (Faker $faker) {
    
    return [
        'first_name'=> $faker->firstName,
        'last_name' => $faker->lastName,
    ];

});


$factory->define(Company::class, function (Faker $faker) {

    return [
        'company_name'=> $faker->company,
        'person_id' =>Person::all()->random()->id,
    ];

});

$factory->define(Customer::class, function (Faker $faker) {


    
        
        $customerable_id = -1 ;

        $customerable = [
                        Person::class,
                        Company::class,
                        Person::class,
                        Person::class,
                        ];

                            
                            
         $customerable_type = $customerable[array_rand($customerable,1)];
         #error_log(Person::class);
         #error_log('customer_type' . $customerable_type);
        if(($customerable_type==Company::class) && ((Customer::where(['customerable_type' => Company::class])->get()->count()) >= 250 )){

            $customerable_type = Person::class;
        }
        $temp = true;
        if ($customerable_type==person::class) {
            $customerable_id = Person::all()->random()->id;
            //  while ( $temp) {
            //     $customerable_id = Person::all()->random()->id;
            //     $customer = Customer::where([
            //         'customerable_type'=> Person::class,
            //         'customerable_id' => strval($customerable_id)
            //     ])->get();
                
            // if($customer->count() == 0){
            //         $temp = false ;
            //     }
                
            // }
            

        } else {
            $customerable_id = Person::all()->random()->id;
            // while ( $temp ) {
            //     $customerable_id = Company::all()->random()->id;
            
            //     $customerable_id = Person::all()->random()->id;
            //     $customer = Customer::where([
            //         'customerable_type'=> Company::class,
            //         'customerable_id' => strval($customerable_id)
            //     ])->get();
            //     if($customer->count() == 0){
            //         $temp = false ;
            //     }
                
            // }
            
                
        }
        

    
        error_log( $customerable_id . " - " . $customerable_type );
        error_log( Customer::all()->count());
    return [
        'description' => $faker->realText(100),
        'customerable_id' => $customerable_id,
        'customerable_type' => $customerable_type,
    ];

});
