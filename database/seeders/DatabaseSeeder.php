<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Professor;
use App\Models\Section;
use App\Models\PanelSlot;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    $this->call([
        AdviserSeeder::class,
        PanelSeeder::class,
        AssignmentSeeder::class,
    ]);
}

}
