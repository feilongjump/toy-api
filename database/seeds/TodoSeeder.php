<?php

use Illuminate\Database\Seeder;

use App\Todo;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = factory(Todo::class)->times(100)->make();
        Todo::insert($articles->toArray());
    }
}
