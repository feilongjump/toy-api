<?php

use App\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = factory(Content::class)->times(100)->make();
        Content::insert($contents->toArray());
    }
}
