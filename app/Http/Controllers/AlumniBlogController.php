<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class AlumniBlogController extends Controller
{
    /**
     * Display a listing of the resource for alumni.
     * Hanya menampilkan blog yang sudah dipublikasikan.
     */
    public function index()
    {
        $blogs = Blog::whereNotNull('published_at') // Hanya tampilkan yang sudah dipublikasikan
                     ->latest()
                     ->paginate(6);
        return view('dashboard.alumni.blogs.index', compact('blogs'));
    }

    /**
     * Display the specified blog for alumni.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        // Pastikan blog sudah dipublikasikan sebelum ditampilkan ke alumni
        if (is_null($blog->published_at)) {
            abort(404, 'Blog tidak ditemukan atau belum dipublikasikan.');
        }

        // Eager load semua komentar dan balasan, serta pengguna yang membuat komentar/balasan
        // Hanya tampilkan jika comments_enabled bernilai true atau jika user adalah admin
        // Admin bisa melihat meskipun comments_enabled false (untuk debug/manage)
        if ($blog->comments_enabled || (Auth::check() && Auth::user()->role === 'admin')) {
             $blog->load(['allComments']);
        } else {
            // Jika komentar dinonaktifkan, pastikan allComments tidak dimuat atau kosongkan
            $blog->setRelation('allComments', collect());
        }

        return view('dashboard.alumni.blogs.show', compact('blog'));
    }

    // Method create, store, edit, update, destroy tidak diperlukan untuk AlumniBlogController
    // karena alumni hanya bisa melihat dan berkomentar, bukan mengelola blog.
}