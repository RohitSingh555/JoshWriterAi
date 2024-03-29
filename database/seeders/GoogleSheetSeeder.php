<?php

namespace Database\Seeders;

use App\Models\GoogleSheet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoogleSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoogleSheet::create([
            'client_id' => 'Update with your client id',
            'client_secret' => 'Update with your client secret',
            'api_key' => 'Update with your api key',
            'range' => 'Update with your range',
            'sheet_id' => 'Update with your sheet id',
        ]);
    }
}
