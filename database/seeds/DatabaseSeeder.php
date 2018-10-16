<?php

use App\Address;
use App\Company;
use App\Customer;
use App\Person;
use App\Telephone;
use App\User;
use Faker\Factory;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        // $faker= Factory::create('en_US');

       	DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate(); // delete all rows
        Person::truncate(); // delete all rows
        Company::truncate();
        Customer::truncate();
        Telephone::truncate();
        Address::truncate();

        $usersQuantities = 10;
        $peapleQuantities = 100;
        $companiesQuantities = 30;
        $customersQuantities = 80;


        User::create([
            'name' => 'me the admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
            'verified' => User::VERIFIED_USER,
            'verification_token' =>  null ,
            'admin' =>  User::ADMIN_USER,
        ]);
        factory(User::class, $usersQuantities)->create();
        factory(Person::class, $peapleQuantities)->create()
            ->each(
                function($person)
                {
                    $telephones = factory(Telephone::class,random_int(1,2))->make();
                    $person->telephones()->saveMany($telephones);

                    $address = factory(Address::class)->make();
                    $person->address()->save($address);
                    // $address = factory(Address::class)->create();
                    // $person->address()->save($address);
                    // error_log( " address in person created " . $person->id );
                   
                }
            );
        ;




        factory(Company::class, $companiesQuantities)->create()
            ->each(
                function($company)
                {   
                    $telephones = factory(Telephone::class,random_int(1,2))->make();
                    $company->telephones()->saveMany($telephones);

                    $address = factory(Address::class)->make();
                    $company->address()->save($address);
                    // $person = factory(Person::class)->create();
                    // $company->person()->associate($person);
                    // $address = factory(Address::class)->create();
                    // $company->address()->save($address);
                    // error_log( " address in company created " . $company->id );
                    
                }
            )
        ;


        for ($i=0; $i < $customersQuantities; $i++) { 
            $subject = factory(Customer::class)->make();
            repeat:
            try {
                $subject->save();
            } catch (\Illuminate\Database\QueryException $e) {
                $subject = factory(Customer::class)->make();
                goto repeat;
            }
        }
    }
}
