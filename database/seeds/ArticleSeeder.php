<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = factory(Article::class)->times(100)->make();
        Article::insert($articles->toArray());
    }
}
