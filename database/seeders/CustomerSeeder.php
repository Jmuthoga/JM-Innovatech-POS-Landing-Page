<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Primary customer profile
        User::updateOrCreate(
            ['email' => 'johnmuthogakanyingi@gmail.com'],
            [
                'first_name' => 'John',
                'last_name'  => 'Muthoga',
                'password'   => Hash::make('password123'),
                'phone'      => '0791446968',

                // Base Address Fields
                'address'    => 'Garden Estate Apartment B12',
                'town'       => 'Nyeri Town',
                'county'     => 'Nyeri',

                // Shipping Fields
                'shipping_name'    => 'John Muthoga',
                'shipping_phone'   => '0791446968',
                'shipping_email'   => 'customer@gmail.com',
                'shipping_address' => 'Kimathi Estate House 24',
                'shipping_town'    => 'Nyeri Town',
                'shipping_county'  => 'nyeri',

                'email_verified_at' => now(),
            ]
        );

        // 2. Secondary test customer
        User::updateOrCreate(
            ['email' => 'janemwangi@gmail.com'],
            [
                'first_name' => 'Jane',
                'last_name'  => 'Mwangi',
                'password'   => Hash::make('password123'),
                'phone'      => '0722111222',

                // Base Address
                'address' => 'Kilimani Heights Apt 4C',
                'town'    => 'Nairobi Central',
                'county'  => 'nairobi',

                // Shipping
                'shipping_name'    => 'Jane Mwangi',
                'shipping_phone'   => '0722111222',
                'shipping_email'   => 'jane.doe@example.com',
                'shipping_address' => 'Kilimani Heights Apt 4C',
                'shipping_town'    => 'Nairobi Central',
                'shipping_county'  => 'nairobi',

                'email_verified_at' => now(),
            ]
        );
    }
}
