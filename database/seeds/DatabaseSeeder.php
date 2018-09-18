<?php

use App\Address;
use App\Company;
use App\Customer;
use App\Person;
use App\Telephone;
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
       	DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Person::truncate(); // delete all rows
        Company::truncate();
        Customer::truncate();
        Telephone::truncate();
        Address::truncate();

        $peapleQuantities = 1000;
        $companiesQuantities = 300;
        $customersQuantities = 800;

        factory(Person::class, $peapleQuantities)->create()
            ->each(
                function($person)
                {
                    $person->telephones()->saveMany(factory(Telephone::class,random_int(1,2))->create([
                                                         'telephoneable_id' => $person->id,
                                                         'telephoneable_type' =>Person::class,
                    ]));
                    $person->address()->associate(factory(Address::class)->create());
                    error_log( " address in person created " . $person->id );
                    // for ($i=0; $i < random_int(1,3); $i++) { 
                    //    factory(Telephone::class)
                    //    ->create([
                    //             'telephoneable_id' => $person->id,
                    //             'telephoneable_type' =>Person::class,
                    //             ]);
                    // }
                    // $person->Telephones->save();
                    // $address = factory(Address::class)->save();
                    // $person->address_id = $address->id;
                }
            );
        ;
        factory(Company::class, $companiesQuantities)->create()
            ->each(
                function($company)
                {   
                    $company->telephones()->saveMany(factory(Telephone::class,random_int(1,2))->create([
                                                         'telephoneable_id' => $company->id,
                                                         'telephoneable_type' =>Company::class,
                    ]));
                    $company->address()->associate(factory(Address::class)->create());
                    error_log( " address in company created " . $company->id );
                    
                    //    factory(Telephone::class,random_int(1,2))
                    //    ->create([
                    //             'telephoneable_id' => $company->id,
                    //             'telephoneable_type' =>Company::class,
                    //             ]);
                    
                    // $company->Telephones->save();
                    // $address = factory(Address::class)->save();
                    // $company->address_id = $address->id;
                }
            )
        ;

        // $subjects =factory(Customer::class, $customersQuantities)->make();

        // foreach ($subjects as $subject) {
        //     repeat:
        //     try {
        //         $subject->save();
        //     } catch (\Illuminate\Database\QueryException $e) {
        //         $subject = factory(Customer::class)->make();
        //         goto repeat;
        //     }
        // }
        for ($i=0; $i < 800; $i++) { 
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
