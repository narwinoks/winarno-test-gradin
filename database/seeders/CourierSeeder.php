<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $model = new Courier();
//        $model->name ="john";
//        $model->telp="081477084167";
//        $model->city ="solo";
//        $model->level=1;
//        $model->save();
//
//        $model = new Courier();
//        $model->name ="mark zuckerberg";
//        $model->telp="081477084167";
//        $model->city ="jakarta";
//        $model->level=2;
//        $model->save();
//
//        $model = new Courier();
//        $model->name ="elon musk";
//        $model->telp="081477084167";
//        $model->city ="bandung";
//        $model->level=3;
//        $model->save();
//
//        $model = new Courier();
//        $model->name ="bill gates";
//        $model->telp="081477084167";
//        $model->city ="surabaya";
//        $model->level=4;
//        $model->save();
//
//        $model = new Courier();
//        $model->name ="Jokowi";
//        $model->telp="081477084167";
//        $model->city ="kalimatan";
//        $model->level=5;
//        $model->save();

        $model = new Courier();
        $model->name ="Budiono Hadi Agung";
        $model->telp="081477084167";
        $model->city ="kalimatan";
        $model->level=5;
        $model->save();
    }
}
