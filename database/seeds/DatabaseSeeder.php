<?php

use Illuminate\Database\Seeder;
use App\Customer;
use App\Transaction;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=10; $i++)
        {
            /*
            $code = mt_rand(100000, 999999);

            $Customer = new Customer;
            $Customer->customer_code = $code;
            $Customer->name = "Kustomer No : ".$i;
            $Customer->phone = $code;
            $Customer->address = "Jl Dayak Modang RT 17 No 28 Samarinda";
            $Customer->save();
            

            $Transaction = new Transaction;
            $Transaction->customer_id = 2;
            $Transaction->value = 1000;
            $Transaction->point = 100;
            $Transaction->save();*/
        }

        $User = new User;
        $User->name = 'Kebab';
        $User->email = 'julian.aryo1989@gmail.com';
        $User->password = bcrypt('buyung');
        $User->save();
    }
}
