<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Customer::factory(20)->create()->each(function ($customer) {
            $phone= $customer->phone;

            //loai bo cac ki tu khong phai so
            $phone = preg_replace('/\D/', '', $phone);
            $customer->phone = $phone;
            $customer->save();
        });
    }
}
