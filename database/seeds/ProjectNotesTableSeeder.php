<?php

use Illuminate\Database\Seeder;
use Project\Entities\ProjectNote;


class ProjectNotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectNote::truncate();
        factory( ProjectNote::class , 50 )->create();
    }
}
