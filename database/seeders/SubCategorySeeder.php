<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::insert([
            // Transporte
            ['name' => 'Autobuses (líneas regulares)', 'category_id' => 1, 'order' => 1],
            ['name' => 'A demanda', 'category_id' => 1, 'order' => 2],
            ['name' => 'Taxis', 'category_id' => 1, 'order' => 3],
            ['name' => 'Trenes', 'category_id' => 1, 'order' => 4],

            // Sanitario
            ['name' => 'Centro de Salud', 'category_id' => 2, 'order' => 1],
            ['name' => 'Consulta médica', 'category_id' => 2, 'order' => 2],
            ['name' => 'Farmacia', 'category_id' => 2, 'order' => 3],
            ['name' => 'Gabinete psicológico', 'category_id' => 2, 'order' => 4],
            ['name' => 'Dentista', 'category_id' => 2, 'order' => 5],
            ['name' => 'Fisioterapia', 'category_id' => 2, 'order' => 6],
            ['name' => 'Podología', 'category_id' => 2, 'order' => 7],
            ['name' => 'Consulta Veterinaria', 'category_id' => 2, 'order' => 8],

            // Emergencias
            ['name' => 'Guardia Civil', 'category_id' => 3, 'order' => 1],
            ['name' => 'Bomberos', 'category_id' => 3, 'order' => 2],
            ['name' => 'Protección Civil', 'category_id' => 3, 'order' => 3],
            ['name' => 'Policía Local', 'category_id' => 3, 'order' => 4],

            // Institucional
            ['name' => 'Ayuntamiento', 'category_id' => 4, 'order' => 1],
            ['name' => 'Secretaría', 'category_id' => 4, 'order' => 2],
            ['name' => 'SEPE', 'category_id' => 4, 'order' => 3],
            ['name' => 'Oficina de la Seguridad Social', 'category_id' => 4, 'order' => 4],
            ['name' => 'Oficina de Correos', 'category_id' => 4, 'order' => 5],
            ['name' => 'Juzgado', 'category_id' => 4, 'order' => 6],
            ['name' => 'Ventanilla única', 'category_id' => 4, 'order' => 7],
            ['name' => 'Notaría', 'category_id' => 4, 'order' => 8],
            ['name' => 'Punto limpio', 'category_id' => 4, 'order' => 9],
            ['name' => 'Otros', 'category_id' => 4, 'order' => 10],

            // Cultural y Deportes
            ['name' => 'Biblioteca', 'category_id' => 5, 'order' => 1],
            ['name' => 'Bibliobús', 'category_id' => 5, 'order' => 2],
            ['name' => 'Fiestas patronales', 'category_id' => 5, 'order' => 3],
            ['name' => 'Oficina de Turismo', 'category_id' => 5, 'order' => 4],
            ['name' => 'Casa de la Cultura', 'category_id' => 5, 'order' => 5],
            ['name' => 'Cine', 'category_id' => 5, 'order' => 6],

            // Patrimonial y Turístico
            ['name' => 'Museos', 'category_id' => 6, 'order' => 1],
            ['name' => 'Centros de interpretación', 'category_id' => 6, 'order' => 2],
            ['name' => 'Parques', 'category_id' => 6, 'order' => 3],
            ['name' => 'Iglesias', 'category_id' => 6, 'order' => 4],
            ['name' => 'Ermitas', 'category_id' => 6, 'order' => 5],
            ['name' => 'Lugares de interés', 'category_id' => 6, 'order' => 6],

            // Asociaciones
            ['name' => 'De carácter social', 'category_id' => 7, 'order' => 1],
            ['name' => 'De carácter cultural', 'category_id' => 7, 'order' => 2],
            ['name' => 'De carácter religioso', 'category_id' => 7, 'order' => 3],
            ['name' => 'De carácter medioambiental', 'category_id' => 7, 'order' => 4],
            ['name' => 'Deportivas', 'category_id' => 7, 'order' => 5],

            // Comercio, Restauración y Ocio
            ['name' => 'Tiendas', 'category_id' => 8, 'order' => 1],
            ['name' => 'Servicios', 'category_id' => 8, 'order' => 2],
            ['name' => 'Alojamientos', 'category_id' => 8, 'order' => 3],
            ['name' => 'Hostelería', 'category_id' => 8, 'order' => 4],
            ['name' => 'Mercados y Venta Ambulante', 'category_id' => 8, 'order' => 5],

            // Servicios Sociales
            ['name' => 'Centro de Mayores', 'category_id' => 9, 'order' => 1],
            ['name' => 'Diversidad funcional', 'category_id' => 9, 'order' => 2],
            ['name' => 'Salud Mental', 'category_id' => 9, 'order' => 3],
            ['name' => 'Mujer', 'category_id' => 9, 'order' => 4],
            ['name' => 'Alcoholismo, dependencias y adicciones', 'category_id' => 9, 'order' => 5],
            ['name' => 'Migración', 'category_id' => 9, 'order' => 6],
            ['name' => 'Infancia', 'category_id' => 9, 'order' => 7],
            ['name' => 'Juventud', 'category_id' => 9, 'order' => 8],
            ['name' => 'Otros', 'category_id' => 9, 'order' => 9],

            // Industria
            ['name' => 'Agricultura', 'category_id' => 10, 'order' => 1],
            ['name' => 'Ganadería', 'category_id' => 10, 'order' => 2],
            ['name' => 'Apicultura', 'category_id' => 10, 'order' => 3],
        ]);
    }
}
