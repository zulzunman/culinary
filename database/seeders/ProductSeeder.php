<?php

namespace Database\Seeders;

use App\Models\MerchantProfile;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        // Daftar kategori makanan/minuman khas Indonesia (termasuk 5 kategori baru)
        $categories = [
            'Sate', 'Nasi Goreng', 'Bakso', 'Rendang', 'Soto', 'Gudeg',
            'Pempek', 'Rawon', 'Gado-Gado', 'Nasi Padang', 'Mie Ayam',
            'Es Cendol', 'Es Doger', 'Ayam Penyet', 'Lontong Sayur',
            'Ketoprak', 'Tahu Gejrot', 'Martabak Manis', 'Siomay', 'Tempe Mendoan',
            // yang diganti:
            'Dimsum', 'Grill', 'Telor Gulung', 'Teh Poci', 'Rujak'
        ];

        // Batasi kategori maksimal dipakai 4 kali
        $categoryUsage = array_fill_keys($categories, 0);

        $merchants = MerchantProfile::where('id', '>=', 19)->take(75)->get();
        $locationId = 2;

        foreach ($merchants as $merchant) {
            // Pilih kategori yang belum dipakai 4 kali
            do {
                $category = $faker->randomElement($categories);
            } while ($categoryUsage[$category] >= 4);

            $categoryUsage[$category]++;

            // Store name: Warung <Category> <Nama>
            $storeName = 'Warung ' . $category . ' ' . $faker->lastName;

            // Deskripsi makanan/minuman sesuai kategori
            $description = match ($category) {
                'Sate' => 'Sate lezat dari daging pilihan, dibakar dengan bumbu kacang khas Indonesia.',
                'Nasi Goreng' => 'Nasi goreng khas Indonesia dengan telur, ayam, dan bumbu rempah tradisional.',
                'Bakso' => 'Bakso sapi kenyal disajikan dengan kuah kaldu gurih dan mie.',
                'Rendang' => 'Rendang daging sapi empuk dengan cita rasa rempah kuat khas Padang.',
                'Soto' => 'Soto hangat berisi ayam, telur rebus, dan bihun, cocok untuk semua cuaca.',
                'Gudeg' => 'Masakan khas Yogyakarta dari nangka muda dengan rasa manis gurih.',
                'Pempek' => 'Pempek ikan Palembang dengan cuko pedas yang menggoda selera.',
                'Rawon' => 'Rawon daging khas Jawa Timur dengan kuah hitam dari kluwek.',
                'Gado-Gado' => 'Sayur segar dengan bumbu kacang kental, dilengkapi telur dan kerupuk.',
                'Nasi Padang' => 'Aneka lauk khas Padang dengan sambal pedas dan nasi hangat.',
                'Mie Ayam' => 'Mie ayam dengan topping ayam manis gurih dan pangsit renyah.',
                'Es Cendol' => 'Minuman segar dari cendol, santan, dan gula merah asli.',
                'Es Doger' => 'Minuman khas Betawi dengan tape, ketan hitam, dan serutan es.',
                'Ayam Penyet' => 'Ayam goreng empuk yang dipenyet dengan sambal super pedas.',
                'Lontong Sayur' => 'Lontong dengan kuah sayur labu dan santan gurih, khas lebaran.',
                'Ketoprak' => 'Tahu, bihun, dan lontong dengan siraman saus kacang gurih pedas.',
                'Tahu Gejrot' => 'Tahu goreng disiram kuah pedas manis khas Cirebon.',
                'Martabak Manis' => 'Martabak manis lembut dengan topping coklat, keju, dan kacang.',
                'Siomay' => 'Siomay ikan kukus disajikan dengan bumbu kacang dan jeruk limau.',
                'Tempe Mendoan' => 'Tempe tipis goreng tepung khas Banyumas, gurih dan renyah.',

                // Kategori baru:
                'Dimsum' => 'Aneka dimsum kukus dan goreng khas Asia, disajikan dengan saus spesial.',
                'Grill' => 'Daging dan sayuran segar dipanggang langsung, disajikan hangat di meja Anda.',
                'Telor Gulung' => 'Jajanan telur gulung khas abang-abang, gurih dan renyah.',
                'Teh Poci' => 'Teh panas khas Tegal yang disajikan dalam poci tanah liat, dengan gula batu.',
                'Rujak' => 'Rujak buah segar dengan bumbu kacang pedas manis khas Indonesia.',

                default => 'Makanan atau minuman khas Indonesia yang lezat dan menggugah selera.'
            };

            Product::create([
                'store_name'   => $storeName,
                'category'     => $category,
                'desctiption'  => $description,
                'merchant_id'  => $merchant->id,
                'location_id'  => $locationId,
            ]);

            $locationId++;
        }
    }
}
