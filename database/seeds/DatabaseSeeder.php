<?php

use App\Address;
use App\Company;
use App\Customer;
use App\Person;
use App\Telephone;
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

        Person::truncate(); // delete all rows
        Company::truncate();
        Customer::truncate();
        Telephone::truncate();
        Address::truncate();

        $peapleQuantities = 100;
        $companiesQuantities = 30;
        $customersQuantities = 80;



        factory(Person::class, $peapleQuantities)->create()
            ->each(
                function($person)
                {
                    $telephones = factory(Telephone::class,random_int(1,2))->make();
                    $person->telephones()->saveMany($telephones);

                    $person->address()->associate(factory(Address::class)->create());
                    error_log( " address in person created " . $person->id );
                   
                }
            );
        ;




        factory(Company::class, $companiesQuantities)->create()
            ->each(
                function($company)
                {   
                    $telephones = factory(Telephone::class,random_int(1,2))->make();
                    $company->telephones()->saveMany($telephones);

                    $company->address()->associate(factory(Address::class)->create());
                    error_log( " address in company created " . $company->id );
                    
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
