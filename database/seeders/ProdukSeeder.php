<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $prod1 = Produk::create([
            'merk'          => 'Rucika',
            'name'          => 'PIPA PVC RUCIKA STANDARD',
            'description'   => 'APLIKASI AIR BERSIH & AIR LIMBAH',
            'satuan'        => 'Batang'
        ]);

        $tipe1 = [
            ['4 M', '1/2"', '26.800'],
            ['4 M', '3/4"', '36.300'],
            ['4 M', '1"', '49.700'],
            ['4 M', '1 1/4"', '74.200'],
            ['4 M', '1 1/2"', '85.200'],
            ['5 M', '1/2"', '39.700'],
            ['5 M', '3/4"', '54.400'],
            ['5 M', '1"', '74.100'],
            ['5 M', '1 1/4"', '111.300'],
            ['5 M', '1 1/2"', '127.300'],
        ];
        
        foreach ($tipe1 as $tipe) {
            $tipe = $prod1->tipe()->create([
                'name'      => $tipe[0],
                'ukuran'    => $tipe[1],
                'harga'     => $tipe[2]
            ]);

            
            for($i=0; $i<5; $i++) {
                $tipe->stoks()->create([
                    'tanggal'   => $faker->dateTimeBetween('-1 week', '-1 day'),
                    'stok_masuk'=> $faker->randomNumber(1, false),
                ]);
            }
        }

        // 

        $prod2 = Produk::create([
            'merk'          => 'Rucika',
            'name'          => 'PIPA PVC RUCIKA JIS K-6741 / K-6742',
            'description'   => 'APLIKASI AIR BERSIH & AIR LIMBAH',
            'satuan'        => 'Batang'
        ]);

        $tipe2 = [
            ['4 M', '1/2"', '48.500'],
            ['4 M', '3/4"', '58.000'],
            ['4 M', '1"', '84.200'],
            ['4 M', '1 1/4"', '113.600'],
            ['4 M', '1 1/2"', '147.500'],
            ['5 M', '1/2"', '69.700'],
            ['5 M', '3/4"', '84.200'],
            ['5 M', '1"', '121.700'],
            ['5 M', '1 1/4"', '164.000'],
            ['5 M', '1 1/2"', '213.700'],
        ];

        foreach ($tipe2 as $tipe) {
            $tipe = $prod2->tipe()->create([
                'name'      => $tipe[0],
                'ukuran'    => $tipe[1],
                'harga'     => $tipe[2]
            ]);

            for($i=0; $i<5; $i++) {
                $tipe->stoks()->create([
                    'tanggal'   => $faker->dateTimeBetween('-1 week', '-1 day'),
                    'stok_masuk'=> $faker->randomNumber(1, false),
                ]);
            }
        }

        $prod3 = Produk::create([
            'merk'          => 'Rucika',
            'name'          => 'PIPA PP-R RUCIKA KELEN GREEN 4 M',
            'description'   => 'SPESIALIS AIR PANAS DAN DINGIN BERTEKANAN',
            'satuan'        => 'Batang'
        ]);

        $tipe3 = [
            ['4 M PN10', '1/2"', '39.820'],
            ['4 M PN10', '3/4"', '52.162'],
            ['4 M PN10', '1"', '83.874'],
            ['4 M PN10', '1 1/4"', '132.883'],
            ['4 M PN10', '1 1/2"', '206.036'],
            
            ['4 M PN16', '1/2"', '49.009'],
            ['4 M PN16', '3/4"', '76.577'],
            ['4 M PN16', '1"', '123.064'],
            ['4 M PN16', '1 1/4"', '191.261'],
            ['4 M PN16', '1 1/2"', '298.649'],

            ['4 M PN20', '1/2"', '55.225'],
            ['4 M PN20', '3/4"', '84.775'],
            ['4 M PN20', '1"', '139.369'],
            ['4 M PN20', '1 1/4"', '214.865'],
            ['4 M PN20', '1 1/2"', '335.766'],
        ];

        foreach ($tipe3 as $tipe) {
            $tipe = $prod3->tipe()->create([
                'name'      => $tipe[0],
                'ukuran'    => $tipe[1],
                'harga'     => $tipe[2]
            ]);

            for($i=0; $i<2; $i++) {
                $tipe->stoks()->create([
                    'tanggal'   => $faker->dateTimeBetween('-1 week', '-1 day'),
                    'stok_masuk'=> $faker->randomNumber(1, false),
                ]);
            }
        }
    }
}
