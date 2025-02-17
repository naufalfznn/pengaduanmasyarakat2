<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'username' => 'adminpengaduan',
            'password' => Hash::make('adminpm61'), 
            'nama_admin' => 'Admin PM', 
            'telp' => '08123456789'
        ]);
    }
}
