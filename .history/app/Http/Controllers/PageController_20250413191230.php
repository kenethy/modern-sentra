<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $aboutContent = Setting::getValue('about_content');
        $history = Setting::getValue('history', 'Modern Sentra didirikan pada tahun 2010 sebagai toko bahan bangunan kecil di Jakarta. Dengan fokus pada kualitas produk dan layanan pelanggan yang prima, kami terus berkembang dan memperluas jangkauan produk kami.

Pada tahun 2013, kami membuka cabang kedua dan memperluas jangkauan produk untuk memenuhi kebutuhan proyek konstruksi yang lebih besar. Tiga tahun kemudian, kami meluncurkan layanan konsultasi profesional untuk membantu klien memilih bahan bangunan yang tepat untuk proyek mereka.

Tahun 2019 menjadi tonggak penting bagi kami ketika Modern Sentra menjadi distributor resmi untuk beberapa merek bahan bangunan terkemuka dan memperluas jangkauan distribusi ke seluruh Jabodetabek. Pada tahun 2022, kami meluncurkan platform digital untuk mempermudah pelanggan memesan produk dan berkonsultasi secara online.

Hingga saat ini, kami terus berinovasi dan berkembang untuk menjadi supplier bahan bangunan terdepan dengan komitmen pada kualitas dan kepuasan pelanggan.');

        $vision = Setting::getValue('vision', 'Menjadi supplier bahan bangunan terdepan di Indonesia yang dikenal karena kualitas produk, layanan prima, dan inovasi berkelanjutan.');

        $mission = Setting::getValue('mission', '1. Menyediakan produk bahan bangunan berkualitas tinggi dengan harga yang kompetitif\n\n2. Memberikan layanan pelanggan yang luar biasa dan solusi yang disesuaikan dengan kebutuhan proyek\n\n3. Menjalin kemitraan jangka panjang dengan pelanggan, pemasok, dan mitra bisnis\n\n4. Berinvestasi dalam teknologi dan inovasi untuk meningkatkan efisiensi dan pengalaman pelanggan\n\n5. Berkontribusi pada pembangunan berkelanjutan melalui praktik bisnis yang bertanggung jawab');

        $team = [
            [
                'name' => 'Ahmad Fauzi',
                'position' => 'CEO & Founder',
                'photo' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=256&q=80',
            ],
            [
                'name' => 'Siti Rahayu',
                'position' => 'Marketing Manager',
                'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=256&q=80',
            ],
            [
                'name' => 'Budi Santoso',
                'position' => 'Technical Advisor',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=256&q=80',
            ],
        ];

        return view('about', compact('aboutContent', 'history', 'vision', 'mission', 'team'));
    }

    public function contact()
    {
        $contactInfo = [
            'address' => Setting::getValue('contact_address', 'Jl. Raya Sidoarjo No. 123, Sidoarjo'),
            'phone' => Setting::getValue('contact_phone', '+62 812 3456 7890'),
            'email' => Setting::getValue('contact_email', 'info@modernsentra.com'),
            'hours' => Setting::getValue('contact_hours', 'Senin - Sabtu: 08:00 - 17:00'),
        ];

        return view('contact', compact('contactInfo'));
    }
}
