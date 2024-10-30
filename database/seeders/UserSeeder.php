<?php

namespace Database\Seeders;

use App\Models\ComRegion;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'admin',
            'email'     => 'admin@app.com',
            'password'  => Hash::make('password'),
            'status'     => true,
            'wa'     => '0851',
            'wa_verified_at' => now(),
            'email_verified_at'     => now(),
        ])->assignRole('admin')->givePermissionTo(['home', 'dashboard', 'master']);
        User::create([
            'name'      => 'user',
            'email'     => 'user@app.com',
            'password'  => Hash::make('password'),
            'status'     => true,
            'wa'     => '08512',
            'wa_verified_at' => now(),
            'email_verified_at' => now(),
        ])->assignRole('user')->givePermissionTo(['home', 'dashboard']);
        User::create([
            'name'      => 'SuperAdmin',
            'email'     => 'superadmin@app.com',
            'password'  => Hash::make('password'),
            'status'     => true,
            'wa'     => '0851',
            'wa_verified_at' => now(),
            'email_verified_at'     => now(),
        ])->assignRole('super-admin')->givePermissionTo(Permission::all());
        User::create([
            'name'      => 'Admin TPS',
            'email'     => 'admintps@app.com',
            'password'  => Hash::make('password'),
            'status'     => true,
            'wa'     => '0851',
            'wa_verified_at' => now(),
            'email_verified_at'     => now(),
        ])->assignRole('admin-tps')->givePermissionTo(['dashboard-tps', 'tps', 'pendaftaran-tps']);
        $data = ComRegion::where('region_root', 3307)->get();
        $no = 1;
        foreach ($data as $row) {
            User::create([
                'name'      => $row->region_nm,
                'email'     => strtolower($row->region_nm) . '@app.com',
                'password'  => Hash::make('@password' . $no++),
                'status'     => true,
                'wa'     => '0851',
                'wa_verified_at' => now(),
                'email_verified_at'     => now(),
                'region_cd' => $row->region_cd
            ])->assignRole('tps')->givePermissionTo(['dashboard-tps', 'tps']);
        }
    }
}