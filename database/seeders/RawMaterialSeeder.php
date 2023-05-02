<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'YELLOW CORN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO'
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'EXTRUDED CORN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'US SOYA',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'COPRA',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'RICE BRAN D1',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'POLLARD',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LIMESTONE (FINE)',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LIMESTONE (GRITS)',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'COCO OIL',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MOLASSES',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SALT',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MDCP',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SOY PROTEIN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'WHEY DEPRO',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'NUTIDE N100',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'CAPSOQUIN L',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'PALM OIL',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SKIMMED MILK',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MIXIPORC',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'TRYPTOPHAN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'L-THREONINE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LYSINE (SWINE)',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LYSINE (POULTRY)',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'L-METHIONINE (SWINE)',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'DL-METHIONINE (POULTRY)',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'VITAMIN SWINE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'VITAMIN POULTRY',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MINERAL SWINE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MINERAL POULTRY',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'CHOLINE CHLORIDE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'COPPER SULFATE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'APSACID',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ZINC OXIDE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SODIUM BICARBONATE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SELENIUM',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'HOLTOX POULTRY',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MAYYA TOXIN GUARD',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'CAPSOZYME',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'RACTOPAMINE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'VITAMIN E 50%',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SUCRAM',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'L-VALINE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LYPOSORB',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MAGNESIUM SULFATE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'GUSTOR BP',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'BIOTIN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'NUTRASE XYLA',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'FORMYCINE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ROVIMIX HY-D',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'BIOMYCOZEA',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ECO MANGANESE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ECO ZINC',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'VEVO VITALL-BENZOIC ACID',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'PRAZIQUANTEL 5%',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'AGRIMOS',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'TOYOCERIN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ZINBAC',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'OXICAP',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'DOXYCYCLINE',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'CHLORIDEN 15 %',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'FLORFENICOL 20%',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'AMOXICILIN 50%',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'IVERMECTIN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'COLISTIN 20%',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'NORFLOXACIN 10%',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'TMPS',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MAXIBAN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ENRAMYCIN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LARVADEX',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'PARACETAMOL',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MEBENDAZOLE 10%',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'TILMICOSIN HI BAC 50%',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LINCO-SPECTIN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'TIAMULIN 20%',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'AML30',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'GLOBIGEN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ENROFLAXACIN',
            'price_per_kgs' => '50',
            'inventory_cost' => '0',
            'kgs_per_bag' => '25',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
    }
}
