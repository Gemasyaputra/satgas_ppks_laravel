<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Import DB

class ArticleController extends Controller
{
    /**
     * Menampilkan daftar artikel dengan filter dan statistik.
     */
    public function index(Request $request)
    {
        // Kategori yang ada di 'StudentArticles.tsx'
        $categories = ["Edukasi", "Pencegahan", "Panduan", "Berita", "Tips"];

        // Query dasar
        $query = Article::query();

        // Terapkan filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Terapkan filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->latest('published_at')->paginate(9);

        // Menghitung statistik (mirip di StudentArticles.tsx)
        $stats = [];
        $stats[] = [
            'name' => 'Total Artikel',
            'count' => Article::count(),
            'color' => 'text-warning'
        ];
        
        foreach ($categories as $cat) {
            $stats[] = [
                'name' => $cat,
                'count' => Article::where('category', $cat)->count(),
                'color' => 'text-primary' // Bisa disesuaikan
            ];
            // Batasi 3 stats kategori saja agar pas 4 kolom
            if(count($stats) >= 4) break; 
        }

        return view('student.articles.index', compact('articles', 'stats', 'categories'));
    }

    /**
     * Menampilkan satu artikel secara penuh.
     */
    public function show(Article $article)
    {
        return view('student.articles.show', compact('article'));
    }
}