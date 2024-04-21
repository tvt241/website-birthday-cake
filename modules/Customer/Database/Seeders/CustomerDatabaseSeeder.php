<?php

namespace Modules\Customer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Models\Customer;

class CustomerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            "username" => "default",
            "email" => "customers@gmail.com",
            "phone" => "0987654321",
            "password" => bcrypt("12345678"),
        ]);
    }
}
