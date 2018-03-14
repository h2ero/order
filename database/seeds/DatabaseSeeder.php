<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::truncate();
        \App\Models\User::create(array("name"=>"甲", "email"=>"1@qq.com", "password"=>"123"));
        \App\Models\User::create(array("name"=>"乙", "email"=>"2@qq.com", "password"=>"123"));
        \App\Models\User::create(array("name"=>"丙", "email"=>"3@qq.com", "password"=>"123"));
        \App\Models\User::create(array("name"=>"丁", "email"=>"4@qq.com", "password"=>"123"));

        \App\Models\User::truncate();
        for ($i = 1; $i < 10; $i++) {
            \App\Models\Product::create(array(
                'name' => "套餐{$i}"
            ));
        }

        for ($i = 1; $i <= 4; $i++) {
            for ($n = 1; $n < 10; $n++) {
                \App\Models\Order::create(array(
                    'user_id' => $i,
                    'product_id' => $n,
                    'month' => '201801',
                ));
            }
        }
    }
}
