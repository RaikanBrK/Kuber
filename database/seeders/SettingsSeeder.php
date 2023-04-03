<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'id' => 1,
            'title' => 'Título - Carlos Alexandre',
            'description' => 'Descrição - Carlos Alexandre',
        ]);
    }
}
