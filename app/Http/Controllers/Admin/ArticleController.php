<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // Import Str facade untuk excerpt
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $dataPath = null;
        if ($request->hasFile('image')) {
            $dataPath = $request->file('image')->store('article_images', 'public');
        }

        // Jika excerpt tidak diisi, buat otomatis dari konten
        $excerpt = $request->excerpt ?: Str::limit(strip_tags($request->content), 150);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $excerpt,
            'image_url' => $dataPath,
            'author' => $request->author,
            'category' => $request->category,
            'user_id' => Auth::id(), // Admin yang memposting
            'published_at' => now(), // Publikasi langsung
        ]);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil dipublikasikan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $dataPath = $article->image_url;
        if ($request->hasFile('image')) {
            if ($article->image_url) {
                Storage::disk('public')->delete($article->image_url);
            }
            $dataPath = $request->file('image')->store('article_images', 'public');
        }
        
        // Jika excerpt tidak diisi, buat otomatis dari konten
        $excerpt = $request->excerpt ?: Str::limit(strip_tags($request->content), 150);

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $excerpt,
            'image_url' => $dataPath,
            'author' => $request->author,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->image_url) {
            Storage::disk('public')->delete($article->image_url);
        }
        $article->delete();
        return redirect()->route('admin.articles.index')
                         ->with('success', 'Artikel berhasil dihapus.');
    }
}
