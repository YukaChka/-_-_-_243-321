<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Заполняем роли
        $this->call(RoleSeeder::class);

        $moderatorRole = Role::where('name', 'moderator')->first();
        $readerRole    = Role::where('name', 'reader')->first();

        // 2. Создаём модератора
        User::firstOrCreate(
            ['email' => 'moderator@example.com'],
            [
                'name'     => 'Модератор',
                'password' => bcrypt('password'),
                'role_id'  => $moderatorRole->id,
            ]
        );

        // 3. Создаём читателя
        User::firstOrCreate(
            ['email' => 'reader@example.com'],
            [
                'name'     => 'Читатель',
                'password' => bcrypt('password'),
                'role_id'  => $readerRole->id,
            ]
        );

        // 4. Статьи
        Article::factory(10)->create();
    }
}
