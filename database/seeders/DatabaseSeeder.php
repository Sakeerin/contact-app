<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     CompanySeeder::class,
        //     ContactSeeder::class,
        // ]);
        User::factory(10)->has(
            Company::factory(10)->has(
                Contact::factory(10)->state(function ($attributes, Company $company) {
                    return [
                        'user_id' => $company->user_id
                    ];
                })
            )
        )->create();
        // Contact::factory()->count(100)->create();
    }
}