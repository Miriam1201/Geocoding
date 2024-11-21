<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Transporte',
            'Sanitario',
            'Emergencias',
            'Institucional',
            'Cultural y Deportes',
            'Patrimonial y Turístico',
            'Asociaciones',
            'Comercio, Restauración y Ocio',
            'Servicios Sociales',
            'Industria',
        ];

        foreach ($categories as $index => $name) {
            Category::create([
                'name' => $name,
                'order' => $index + 1,
                'color' => '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6),
                'background' => null,
                'icon' => null,
            ]);
        }
    }
}
