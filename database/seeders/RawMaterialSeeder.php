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
            'standard_days' => '7',
            'category' => 'MACRO'
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'EXTRUDED CORN',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'US SOYA',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'COPRA',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'RICE BRAN D1',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'POLLARD',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LIMESTONE (FINE)',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LIMESTONE (GRITS)',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'COCO OIL',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MOLASSES',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SALT',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MDCP',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SOY PROTEIN',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'WHEY DEPRO',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'NUTIDE N100',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'CAPSOQUIN L',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'PALM OIL',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SKIMMED MILK',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MIXIPORC',
            'standard_days' => '7',
            'category' => 'MACRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'TRYPTOPHAN',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'L-THREONINE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LYSINE (SWINE)',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LYSINE (POULTRY)',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'L-METHIONINE (SWINE)',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'DL-METHIONINE (POULTRY)',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'VITAMIN SWINE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'VITAMIN POULTRY',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MINERAL SWINE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MINERAL POULTRY',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'CHOLINE CHLORIDE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'COPPER SULFATE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'APSACID',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ZINC OXIDE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SODIUM BICARBONATE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SELENIUM',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'HOLTOX POULTRY',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MAYYA TOXIN GUARD',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'CAPSOZYME',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'RACTOPAMINE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'VITAMIN E 50%',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'SUCRAM',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'L-VALINE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LYPOSORB',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MAGNESIUM SULFATE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'GUSTOR BP',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'BIOTIN',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'NUTRASE XYLA',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'FORMYCINE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ROVIMIX HY-D',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'BIOMYCOZEA',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ECO MANGANESE',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ECO ZINC',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'VEVO VITALL-BENZOIC ACID',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'PRAZIQUANTEL 5%',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'AGRIMOS',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'TOYOCERIN',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ZINBAC',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'OXICAP',
            'standard_days' => '7',
            'category' => 'MICRO',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'DOXYCYCLINE',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'CHLORIDEN 15 %',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'FLORFENICOL 20%',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'AMOXICILIN 50%',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'IVERMECTIN',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'COLISTIN 20%',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'NORFLOXACIN 10%',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'TMPS',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MAXIBAN',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ENRAMYCIN',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LARVADEX',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'PARACETAMOL',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'MEBENDAZOLE 10%',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'TILMICOSIN HI BAC 50%',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'LINCO-SPECTIN',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'TIAMULIN 20%',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'AML30',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'GLOBIGEN',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
        DB::table('raw_materials')->insert([
            'raw_material_name' => 'ENROFLAXACIN',
            'standard_days' => '7',
            'category' => 'MEDICINE',
        ]);
    }
}
