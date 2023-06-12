<?php

namespace Database\Seeders;

use App\Models\Plugin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PluginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Plugin::create([
            'name' => 'ebizcharge',
            'private_key' => 'connectedperformance',
            'secret_key' => 'Connectadmin123!',
            'security_id' => '462c7c86-c7e9-467b-9f88-5e18e5a2556c',
        ]);

    }
}
