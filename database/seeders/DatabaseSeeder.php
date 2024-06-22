<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Yamin',
            'email' => 'needyamin@gmail.com',
            'password' => Hash::make('needyamin@gmail.com'),
        ]);

        // Status
        DB::table('core_status_table')->insert([
            // Status
            ['type' => 'status', 'code' => 1, 'description' => 'Submitted', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'status', 'code' => 2, 'description' => 'Under Review', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'status', 'code' => 3, 'description' => 'Published', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'status', 'code' => 4, 'description' => 'Rejected', 'created_at' => now(), 'updated_at' => now()],
        
            // Recommendation
            ['type' => 'recommendation', 'code' => 1, 'description' => 'Accept', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'recommendation', 'code' => 2, 'description' => 'Minor Revision', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'recommendation', 'code' => 3, 'description' => 'Major Revision', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'recommendation', 'code' => 4, 'description' => 'Reject', 'created_at' => now(), 'updated_at' => now()],
        
            // Decision
            ['type' => 'decision', 'code' => 1, 'description' => 'Accept', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'decision', 'code' => 2, 'description' => 'Minor Revision', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'decision', 'code' => 3, 'description' => 'Major Revision', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'decision', 'code' => 4, 'description' => 'Reject', 'created_at' => now(), 'updated_at' => now()],
        
            // Role
            ['type' => 'role', 'code' => 1, 'description' => 'Author', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'role', 'code' => 2, 'description' => 'Reviewer', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'role', 'code' => 3, 'description' => 'Editor', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'role', 'code' => 4, 'description' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'role', 'code' => 5, 'description' => 'Superadmin', 'created_at' => now(), 'updated_at' => now()],
        ]);
        

    }
}
