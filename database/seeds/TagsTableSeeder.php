<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    */
    public function run()
    {
        $data = ['novel','fiction','classic','wealth','women','autobiography','nonfiction'];

        foreach($data as $tagName) {
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        }
    }
}
