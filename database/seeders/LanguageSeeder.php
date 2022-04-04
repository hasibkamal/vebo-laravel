<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = array(
            array('code' => 'ar','name' => 'Arabic','status' => 1),
            array('code' => 'az','name' => 'Azerbaijan','status' => 1),
            array('code' => 'zh','name' => 'Chinese Simplified','status' => 1),
            array('code' => 'zh-TW','name' => 'Chinese Traditional','status' => 1),
            array('code' => 'cs','name' => 'Czech','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
//            array('code' => 'ar','name' => 'Arabic','status' => 1),
        );
//
//
//        'da' => ['name' => 'Danish', 'rtl' => false],
//            'de' => ['name' => 'German', 'rtl' => false],
//            'el' => ['name' => 'Greek', 'rtl' => false],
//            'en' => ['name' => 'English', 'rtl' => false],
//            'es' => ['name' => 'Spanish', 'rtl' => false],
//            'fa' => ['name' => 'Persian', 'rtl' => true],
//            'fr' => ['name' => 'French', 'rtl' => false],
//            'he' => ['name' => 'Hebrew', 'rtl' => true],
//            'id' => ['name' => 'Indonesian', 'rtl' => false],
//            'it' => ['name' => 'Italian', 'rtl' => false],
//            'ja' => ['name' => 'Japanese', 'rtl' => false],
//            'ko' => ['name' => 'Korean', 'rtl' => false],
//            'nl' => ['name' => 'Dutch', 'rtl' => false],
//            'no' => ['name' => 'Norwegian', 'rtl' => false],
//            'pl' => ['name' => 'Polish', 'rtl' => false],
//            'pt_BR' => ['name' => 'Brazilian Portuguese', 'rtl' => false],
//            'pt_PT' => ['name' => 'Portuguese', 'rtl' => false],
//            'ro' => ['name' => 'Romana', 'rtl' => false],
//            'ru' => ['name' => 'Russian', 'rtl' => false],
//            'sv' => ['name' => 'Swedish', 'rtl' => false],
//            'th' => ['name' => 'Thai', 'rtl' => false],
//            'tr' => ['name' => 'Turkish', 'rtl' => false],
//            'uk' => ['name' => 'Ukrainian', 'rtl' => false],
//            'vi' => ['name' => 'Vietnam', 'rtl' => false]

        Language::insert($languages);
    }
}
