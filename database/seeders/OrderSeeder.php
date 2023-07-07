<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\ProdukTipe;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $user  = User::role('customer')->first();

        for($i=0; $i<10; $i++) {
            $order = Order::create([
                'no_po'         => 'PO.00'.$faker->randomNumber(3, false).'.'.now()->format('m').'.'.now()->format('y'),
                'tanggal'       => $faker->dateTimeBetween('-1 week', '+1 week'),
                'user_id'       => $user->id
            ]);
    
            $products = ProdukTipe::inRandomOrder()->limit($faker->randomDigitNotNull())->get();

            foreach($products as $prod) {
                $orderProd = $order->orderProducts()->create([
                    'produk_tipe_id'    => $prod->id,
                    'harga'             => $prod->harga,
                    'qty'               => $faker->randomDigitNotNull(),
                ]);
                
                $orderProd->update([
                    'sub_total'         => $orderProd->harga*$orderProd->qty
                ]);
            }

            $order->update([
                'total'         => $order->orderProducts->sum('sub_total'),
                'ppn'           => (($order->orderProducts->sum('sub_total'))*11)/100,
                'grand_total'   => $order->orderProducts->sum('sub_total') + (($order->orderProducts->sum('sub_total'))*11)/100,
            ]);
        }

    }
}
