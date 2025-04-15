<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $aboutContent = Setting::getValue('about_content');
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

        return view('about', compact('aboutContent', 'team'));
    }

    public function contact()
    {
        $contactInfo = [
            'address' => Setting::getValue('address', 'Jl. Raya Sidoarjo No. 123, Sidoarjo'),
            'phone' => Setting::getValue('phone', '+62 812 3456 7890'),
            'email' => Setting::getValue('email', 'info@modernsentra.com'),
            'hours' => Setting::getValue('business_hours', 'Senin - Sabtu: 08:00 - 17:00'),
        ];

        return view('contact', compact('contactInfo'));
    }
}
