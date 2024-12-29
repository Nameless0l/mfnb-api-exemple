<?php

namespace Database\Seeders;

use App\Models\Styliste;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'Styliste',
            'email' => 'styliste@test.com',
            'is_stylist' => 1
        ]);
        Styliste::factory()->create(
            [
                'user_id' => 2,
                'biographie' => 'Je suis un styliste',
                'specialite' => 'Je suis spécialisé dans les vêtements pour femmes',
                'disponibilite' => 'Je suis disponible tous les jours',
                'note_moyenne' => 5
            ]
        );
        User::factory(9)->create();
        $this->call([
            StylisteSeeder::class,
            CategorieSeeder::class,
            ModeleSeeder::class,
            MensurationSeeder::class,
            ProduitSeeder::class,
            CommandeSeeder::class,
            PaiementSeeder::class,
            AvisStylisteSeeder::class,
            AvisClientSeeder::class,
            LigneCommandeSeeder::class,
            PhotoSeeder::class
        ]);


    }
}

