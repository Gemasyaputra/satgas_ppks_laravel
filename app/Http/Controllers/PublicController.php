<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use App\Models\Counselor;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Ambil 3 artikel terbaru
        $articles = Article::latest('published_at')->take(3)->get();
        
        // Ambil semua layanan (dari AdminDashboard.tsx / ServiceManagement.tsx)
        $services = Service::orderBy('created_at')->get();
        
       
        $contactMethods = [
            'hotline' => Service::where('title', 'like', '%Hotline%')->orWhere('icon', 'like', '%phone%')->first(),
            'email' => Service::where('title', 'like', '%Email%')->orWhere('icon', 'like', '%envelope%')->first(),
        ];
        
        // Ambil tim (dari AboutSection.tsx / ConselorManagement.tsx)
        $team = Counselor::where('is_active', true)->take(4)->get();

        return view('public.index', compact('articles', 'services', 'contactMethods', 'team'));
    }

    /**
     * Menampilkan satu artikel di halaman publik.
     */
    public function showArticle(Article $article)
    {
        // Data kontak untuk footer
       $contactMethods = [
            'hotline' => Service::where('title', 'like', '%Hotline%')->orWhere('icon', 'like', '%phone%')->first(),
            'email' => Service::where('title', 'like', '%Email%')->orWhere('icon', 'like', '%envelope%')->first(),
        ];
        
        return view('public.show_article', compact('article', 'contactMethods'));
    }
}