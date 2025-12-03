<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah user admin sudah ada
        $exists = DB::table('user')->where('nama', 'admin')->exists();
        
        if (!$exists) {
            DB::table('user')->insert([
                'nama' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('admin123'), // Password default
            ]);
            
            $this->command->info('✅ User admin berhasil dibuat!');
            $this->command->info('📋 Login dengan:');
            $this->command->info('   Username: admin');
            $this->command->info('   Password: admin123');
        } else {
            $this->command->info('⚠️  User admin sudah ada di database.');
        }
    }
}