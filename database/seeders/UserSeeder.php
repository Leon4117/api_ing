<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'Erika Reyna',
            'email' => 'contacto@benthocode.com',
            'updated_by' => 1,
            'password' => bcrypt('admin')
        ]);
        $user->save();
    }
}
