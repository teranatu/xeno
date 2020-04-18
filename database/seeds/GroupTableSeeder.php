<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::insert([
    		[ 'group_name' => 'グループ1'],
    		[ 'group_name' => 'グループ2'],
    		[ 'group_name' => 'グループ3'],
    		[ 'group_name' => 'グループ4'],
    		[ 'group_name' => 'グループ5'],
    		[ 'group_name' => 'グループ6'],
    		[ 'group_name' => 'グループ7'],
    		[ 'group_name' => 'グループ8'],
    		[ 'group_name' => 'グループ9'],
    		[ 'group_name' => 'グループ10'],
        ]);
    }
}
