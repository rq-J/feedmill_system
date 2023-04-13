<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $arrItems = [
            'Booster',
            'Pre Starter',
            'Starter',
            'Grower (BFC)',
            'Finisher 1',
            'Finisher 2',
            'Gilt Dev G',
            'Gilt Dev F',
            'GBM',
            'LBM',
            'Boar',
            'C-Booster',
            'C-Starter',
            'C-Grower',
            'Pullet',
            'Prelay',
            'Layer 1',
            'Layer 2'
        ];

        foreach($arrItems as $item)
        {
            DB::table('items')->insert([
                'item_name' => $item
            ]);
        }

    }
}
