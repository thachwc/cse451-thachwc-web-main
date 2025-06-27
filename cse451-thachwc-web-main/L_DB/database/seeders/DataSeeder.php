<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
	$handle = fopen(base_path("database/seeders/log.csv"), "r");
	while (($data = fgetcsv($handle, 20000, ",")) !== FALSE) {
		$sArray = explode(".", $data['2']);
		$sPort = array_pop($sArray);
		$sIP = implode(".", $sArray);

		$dArray = explode(".", $data['4']);
		$dPort = array_pop($dArray);
		$dIP = implode(".", $dArray);

		DB::table('log')->insert([
			'timeOfCapture' => $data['0'],
			'type' => $data['1'],
			'sourceIP' => $sIP,
			'sourcePort' => $sPort,
			'destIP' => $dIP,
			'destPort' => $dPort,
			'contentOfCapture' => $data['5']
		]);
	}
	//\App\Models\User::factory(10)->create();
	//$this->call([DataSeeder::class);
    }
}
