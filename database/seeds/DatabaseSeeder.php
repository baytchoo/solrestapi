<?php

use App\Company;
use App\Customer;
use App\Person;
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

        $peapleQuantities = 1000;
        $companiesQuantities = 300;
        $customersQuantities = 800;

        factory(Person::class, $peapleQuantities)->create();
        factory(Company::class, $companiesQuantities)->create();

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
