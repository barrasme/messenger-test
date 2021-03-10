<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new User;
        $u->name = 'Lyle';
        $u->email = 'lyle@barras.me';
        $u->password = Hash::make('123123123');
        $u->email_verified_at = now();
        $u->remember_token = 'qwertyuiop';
        $u->save();

        User::factory()
            ->count(10)
            ->has(Message::factory()->count(5))
            ->create();
    }
}
