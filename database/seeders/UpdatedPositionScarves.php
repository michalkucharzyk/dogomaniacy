<?php

namespace Database\Seeders;

use App\Models\Scarves;
use Illuminate\Database\Seeder;

class UpdatedPositionScarves extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scarves::query()->update(['position' => 9999]);
    }
}
