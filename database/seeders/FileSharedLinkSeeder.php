<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\FileSharedLink;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class FileSharedLinkSeeder extends Seeder
{
    private $files;
    public function __construct()
    {
        $this->files = File::all()->pluck('id');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 15; $i++) {
            $id = $faker->randomElement($this->files);
            $sharedCode = Str::random(10);
            $key = substr(encrypt($id),0, 30);
            FileSharedLink::create([
                'file_id'   => $id,
                'expire_at' => Carbon::now()->addMinutes($faker->randomElement([3, 4, 5, 6,10, 7, 8, 9])),
                'file_link'  => env('APP_URL') . '/files/'.$id.'/sharer/'.$sharedCode.'/code?key='.$key,
                'shared_code' => $sharedCode,
            ]);
        }
    }
}
