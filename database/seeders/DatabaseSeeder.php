<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        $this->call([
      // RoleSeeder::class,
            CountrieskSeeder::class,
            StatesSeeder::class,
            CitySeeder::class,
            UserSeeder::class,
            FormBulderSeeder::class,
            FormFieldsSeeder::class,
            FormDropdownSeeder::class,
            ServiceSeeder::class,
            EmailTemplateSeeder::class,
            PluginSeeder::class,
          //   CustomerSeeder::class,
          //   InvoiceSeeder::class,
          //  ServicesSeeder::class
          //  FormSeeder::class,

        ]);
    }
}
