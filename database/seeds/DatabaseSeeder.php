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

        $seeders = ['CategoryTableSeeder'];
        foreach ($seeders as $seeder) {
            $this->call($seeder);
            $this->command->info($seeder.' table seeded!');
        }
        //factory(App\DebateArgument::class, 100)->create();
        //factory(App\Question::class, 100)->create();
        factory(App\Debate::class, 5)->states('active')->create()
            ->each(function ($d) {
                $user1 = $d->users()->save(factory(App\User::class)->make());
                $user2 = $d->users()->save(factory(App\User::class)->make());
                $d->arguments()->save(factory(App\DebateArgument::class)->create([
                    'debate_id' => $d->id,
                    'user_id' => $user1->id
                ]));
                $d->arguments()->save(factory(App\DebateArgument::class)->create([
                    'debate_id' => $d->id,
                    'user_id' => $user2->id
                ]));
            });
        factory(App\Debate::class, 5)->states('needs_opponent')->create()
            ->each(function ($d) {
                $user1 = $d->users()->save(factory(App\User::class)->make());
                $d->arguments()->save(factory(App\DebateArgument::class)->create([
                    'debate_id' => $d->id,
                    'user_id' => $user1->id
                ]));
            });
    }
}
