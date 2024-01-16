<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configs = [
            [
                "name" => "device_registration_amount",
                "value" => "3000",
                "model" => null,
                "seeds" => null,
                "field_type" => "input",
                "created_at" => now(),
                "updated_at"=> now(),
            ],
        ];
        Configuration::insert($configs);
    }
}
