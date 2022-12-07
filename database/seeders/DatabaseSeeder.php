<?php

namespace Database\Seeders;
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
        $this->call([
            CitySeeder::class,
            PersonSeeder::class,
            HekalSeeder::class,
            representativeSeeder::class,
            ItinerarySeeder::class,
            ItineraryDetailsSeeder::class,
            ClientSeeder::class,
            companySeeder::class,
            OwnerSeeder::class,
            ManufactorySeeder::class,
            transportationSeeder::class,
            UserSeeder::class,
            DriverSeeder::class,
            shipmentSeeder::class,
            shipmentDetailsSeeder::class,
            CementTypeSeeder::class,
            couponSeeder::class,
            ShareholderSeeder::class,
            BondSeeder::class,
            ExpenseTypeSeeder::class,
            ExpenseSeeder::class,
            BankSeeder::class,
            IncomeSeeder::class,
        ]);
    }
}
