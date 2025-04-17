<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Import Category model
use Illuminate\Support\Str; // Import Str

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Membuat kategori untuk toko bahan bangunan...');

        // Kategori Utama
        $cat1 = $this->createCategory('Semen & Agregat', 'Berbagai jenis semen, pasir, batu, dan material dasar bangunan');
        $cat2 = $this->createCategory('Besi & Baja Ringan', 'Besi beton, kawat, baja ringan, dan material rangka');
        $cat3 = $this->createCategory('Cat & Pelapis', 'Cat tembok, cat kayu, cat besi, dan berbagai pelapis permukaan');
        $cat4 = $this->createCategory('Keramik & Sanitasi', 'Keramik lantai, dinding, dan perlengkapan sanitasi');
        $cat5 = $this->createCategory('Pipa & Fitting', 'Pipa air, pipa listrik, dan berbagai fitting');
        $cat6 = $this->createCategory('Alat Pertukangan', 'Peralatan tukang, mesin, dan alat bantu konstruksi');
        $cat7 = $this->createCategory('Material Atap', 'Genteng, asbes, seng, dan material atap lainnya');
        $cat8 = $this->createCategory('Kayu & Triplek', 'Berbagai jenis kayu, triplek, dan material berbahan kayu');
        $cat9 = $this->createCategory('Kunci & Engsel', 'Kunci pintu, engsel, dan aksesoris pintu/jendela');
        $cat10 = $this->createCategory('Listrik & Pencahayaan', 'Kabel, saklar, lampu, dan perlengkapan listrik');
        $cat11 = $this->createCategory('Adhesive & Sealant', 'Lem, perekat, silikon, dan bahan pengisi');
        $cat12 = $this->createCategory('Alat Keselamatan', 'Helm, sarung tangan, masker, dan alat keselamatan kerja');

        // Subkategori Semen & Agregat
        $this->createSubcategory('Semen', 'Berbagai jenis dan merk semen', $cat1->id);
        $this->createSubcategory('Pasir', 'Pasir halus, pasir kasar, dan pasir khusus', $cat1->id);
        $this->createSubcategory('Batu & Kerikil', 'Batu split, kerikil, dan material agregat kasar', $cat1->id);
        $this->createSubcategory('Bata & Batako', 'Bata merah, batako, bata ringan, dan material dinding', $cat1->id);

        // Subkategori Besi & Baja Ringan
        $this->createSubcategory('Besi Beton', 'Besi beton polos dan ulir berbagai ukuran', $cat2->id);
        $this->createSubcategory('Baja Ringan', 'Rangka atap baja ringan dan aksesorisnya', $cat2->id);
        $this->createSubcategory('Kawat', 'Kawat bendrat, kawat duri, dan kawat lainnya', $cat2->id);
        $this->createSubcategory('Paku & Sekrup', 'Berbagai jenis paku, sekrup, dan pengencang', $cat2->id);

        // Subkategori Cat & Pelapis
        $this->createSubcategory('Cat Tembok Interior', 'Cat untuk dinding dalam ruangan', $cat3->id);
        $this->createSubcategory('Cat Tembok Eksterior', 'Cat untuk dinding luar ruangan', $cat3->id);
        $this->createSubcategory('Cat Kayu & Besi', 'Cat untuk permukaan kayu dan logam', $cat3->id);
        $this->createSubcategory('Thinner & Pelarut', 'Pengencer cat dan pelarut', $cat3->id);
        $this->createSubcategory('Kuas & Roller', 'Alat aplikasi cat', $cat3->id);

        // Subkategori Keramik & Sanitasi
        $this->createSubcategory('Keramik Lantai', 'Keramik untuk lantai berbagai ukuran dan motif', $cat4->id);
        $this->createSubcategory('Keramik Dinding', 'Keramik untuk dinding berbagai ukuran dan motif', $cat4->id);
        $this->createSubcategory('Closet & Toilet', 'Closet duduk, jongkok, dan perlengkapan toilet', $cat4->id);
        $this->createSubcategory('Wastafel & Kitchen Sink', 'Wastafel kamar mandi dan bak cuci dapur', $cat4->id);
        $this->createSubcategory('Shower & Kran', 'Shower, kran air, dan aksesoris kamar mandi', $cat4->id);

        // Subkategori Pipa & Fitting
        $this->createSubcategory('Pipa PVC', 'Pipa PVC untuk saluran air dan limbah', $cat5->id);
        $this->createSubcategory('Pipa HDPE', 'Pipa HDPE untuk saluran air bertekanan', $cat5->id);
        $this->createSubcategory('Fitting PVC', 'Sambungan dan aksesoris pipa PVC', $cat5->id);
        $this->createSubcategory('Pipa Listrik', 'Pipa untuk instalasi kabel listrik', $cat5->id);

        // Subkategori Alat Pertukangan
        $this->createSubcategory('Alat Tangan', 'Palu, obeng, tang, dan alat tangan lainnya', $cat6->id);
        $this->createSubcategory('Alat Ukur', 'Meteran, waterpass, dan alat pengukuran', $cat6->id);
        $this->createSubcategory('Mesin Pertukangan', 'Bor, gerinda, dan mesin pertukangan lainnya', $cat6->id);
        $this->createSubcategory('Perkakas Tukang', 'Toolbox, tas, dan penyimpanan perkakas', $cat6->id);

        // Subkategori Material Atap
        $this->createSubcategory('Genteng', 'Genteng beton, keramik, dan metal', $cat7->id);
        $this->createSubcategory('Seng & Spandek', 'Atap seng gelombang dan spandek', $cat7->id);
        $this->createSubcategory('Asbes', 'Atap asbes gelombang', $cat7->id);
        $this->createSubcategory('Talang & Aksesoris', 'Talang air dan aksesoris atap', $cat7->id);

        // Subkategori Kayu & Triplek
        $this->createSubcategory('Kayu Olahan', 'Kayu yang sudah diolah untuk konstruksi', $cat8->id);
        $this->createSubcategory('Triplek', 'Triplek berbagai ketebalan dan jenis', $cat8->id);
        $this->createSubcategory('MDF & Partikel', 'Papan MDF dan papan partikel', $cat8->id);
        $this->createSubcategory('Kusen & Daun Pintu', 'Kusen dan daun pintu jadi', $cat8->id);

        // Subkategori Kunci & Engsel
        $this->createSubcategory('Kunci Pintu', 'Kunci pintu rumah dan kamar', $cat9->id);
        $this->createSubcategory('Engsel', 'Engsel pintu dan jendela', $cat9->id);
        $this->createSubcategory('Handle & Grendel', 'Handle pintu dan grendel', $cat9->id);
        $this->createSubcategory('Gembok & Rantai', 'Gembok dan rantai pengaman', $cat9->id);

        // Subkategori Listrik & Pencahayaan
        $this->createSubcategory('Kabel Listrik', 'Kabel listrik berbagai ukuran', $cat10->id);
        $this->createSubcategory('Saklar & Stop Kontak', 'Saklar dan stop kontak', $cat10->id);
        $this->createSubcategory('Lampu', 'Lampu LED, neon, dan bohlam', $cat10->id);
        $this->createSubcategory('MCB & Panel', 'MCB, sekring, dan panel listrik', $cat10->id);

        // Subkategori Adhesive & Sealant
        $this->createSubcategory('Lem Kayu', 'Lem untuk material kayu', $cat11->id);
        $this->createSubcategory('Lem Keramik', 'Semen putih dan lem keramik', $cat11->id);
        $this->createSubcategory('Silikon & Sealant', 'Silikon dan bahan pengisi celah', $cat11->id);
        $this->createSubcategory('Epoxy & Resin', 'Lem epoxy dan resin', $cat11->id);

        // Subkategori Alat Keselamatan
        $this->createSubcategory('Helm Proyek', 'Helm untuk keselamatan kepala', $cat12->id);
        $this->createSubcategory('Sarung Tangan', 'Sarung tangan kerja berbagai jenis', $cat12->id);
        $this->createSubcategory('Masker & Respirator', 'Masker debu dan respirator', $cat12->id);
        $this->createSubcategory('Sepatu Safety', 'Sepatu boots dan sepatu safety', $cat12->id);

        $this->command->info('Berhasil membuat ' . Category::count() . ' kategori!');
    }

    /**
     * Membuat kategori utama
     */
    private function createCategory($name, $description = null)
    {
        return Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $description,
        ]);
    }

    /**
     * Membuat subkategori
     */
    private function createSubcategory($name, $description = null, $parentId = null)
    {
        return Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $description,
            'parent_id' => $parentId,
        ]);
    }
}
