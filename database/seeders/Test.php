<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Test extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'code' => 'a',
            'name' => 'a',
            'email' => 'thanh@gmail.com',
            'phone' => '0123123123',
            'address' => '1',
            'password' => Hash::make('123123123'),
            'birthday' => '2000-10-10',
            'gender' => '1',
        ]);
    }
}
