<?php

use Illuminate\Database\Seeder;
use Project\Entities\ProjectMember;


class ProjectMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectMember::truncate();
        factory( ProjectMember::class , 30 )->create();
    }
}
