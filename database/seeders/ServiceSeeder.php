<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Service::create([
            'name' => '1 On 1 Training',
            'status' => '1',
            'admin_id'=> 1,
            'price'=>10000,
        ]);

        Service::create([
            'name' => 'Consulting',
            'status' => '1',
            'admin_id' => 1,
            'price' => 10000,
        ]);

        Service::create([
            'name' => 'Connect Software',
            'status' => '1',
            'admin_id' => 1,
            'price' => 10000,
        ]);
    }
}
