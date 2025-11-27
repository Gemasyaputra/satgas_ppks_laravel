<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use App\Models\Counselor;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Halaman Landing Page Utama.
     */
    public function index()
    {
        // Ambil 3 artikel terbaru (Hanya yang sudah publish)
        $articles = Article::whereNotNull('published_at')
                           ->latest('published_at')
                           ->take(3)
                           ->get();
        
        // Ambil semua layanan
        $services = Service::orderBy('created_at')->get();
        
        // Data kontak untuk footer/navbar
        $contactMethods = [
            'hotline' => Service::where('title', 'like', '%Hotline%')->orWhere('icon', 'like', '%phone%')->first(),
            'email' => Service::where('title', 'like', '%Email%')->orWhere('icon', 'like', '%envelope%')->first(),
        ];
        
        // Ambil tim konselor
        $team = Counselor::where('is_active', true)->take(4)->get();

        return view('public.index', compact('articles', 'services', 'contactMethods', 'team'));
    }

    /**
     * Halaman Daftar Semua Artikel (Public).
     */
    public function articlesIndex(Request $request)
    {
        $query = Article::whereNotNull('published_at');

        // Filter Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter Kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Pagination 9 item per halaman
        $articles = $query->orderBy('published_at', 'desc')->paginate(9);

        // Data Kategori untuk Filter Dropdown
        $categories = Article::select('category')->distinct()->pluck('category');

        // Data Kontak (Jaga-jaga layout butuh ini)
        $contactMethods = [
            'hotline' => Service::where('title', 'like', '%Hotline%')->orWhere('icon', 'like', '%phone%')->first(),
            'email' => Service::where('title', 'like', '%Email%')->orWhere('icon', 'like', '%envelope%')->first(),
        ];

        // Menggunakan view yang baru kita buat: public.articles.index
        return view('public.articles.index', compact('articles', 'categories', 'contactMethods'));
    }

    /**
     * Halaman Baca Detail Artikel (Public).
     */
    public function showArticle(Article $article)
    {
        // Cek apakah artikel sudah terbit (mencegah akses draft)
        if (!$article->published_at) {
            abort(404);
        }

        // Data kontak untuk footer
        $contactMethods = [
            'hotline' => Service::where('title', 'like', '%Hotline%')->orWhere('icon', 'like', '%phone%')->first(),
            'email' => Service::where('title', 'like', '%Email%')->orWhere('icon', 'like', '%envelope%')->first(),
        ];

        // Rekomendasi Artikel Lain (Related Articles)
        $relatedArticles = Article::where('id', '!=', $article->id)
                                  ->where('category', $article->category)
                                  ->whereNotNull('published_at')
                                  ->latest('published_at')
                                  ->take(3)
                                  ->get();
        
        // Menggunakan view detail yang baru: public.articles.show
        return view('public.articles.show', compact('article', 'contactMethods', 'relatedArticles'));
    }
}