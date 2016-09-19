<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call(RoleTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ConversationsTableSeeder::class);
        $this->call(ConversationsUsersTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(SubjectUserTableSeeder::class);
        $this->call(MessagesNotificationsTableSeeder::class);
        
    }
}
