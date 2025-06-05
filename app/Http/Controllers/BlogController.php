<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ambil query pencarian dari request
        $search = $request->query('search');

        // Mulai query blog
        $query = Blog::query();

        // Jika ada query pencarian, tambahkan kondisi where
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }

        // Ambil blog dengan pagination, urutkan berdasarkan tanggal terbaru
        $blogs = $query->latest()->paginate(10); // Menampilkan 10 blog per halaman

        // Kembalikan view dengan data blog dan query pencarian (untuk mempertahankan nilai di input search)
        return view("dashboard.admin.blogs.index", compact("blogs", "search"));
    }

    /**
     * Show all blogs for public UI.
     *
     * @return \Illuminate\Http\Response
     */
    public function front(Request $request)
    {
        $query = Blog::query();

        // 1. Filter for published blogs (essential for frontend)
        $query->whereNotNull('published_at');
        $query->where('published_at', '<=', Carbon::now()); // Also ensure it's published on or before today

        // 2. Add Search Logic
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
                // You can add more searchable fields here, e.g., ->orWhere('author', 'like', '%' . $searchTerm . '%');
            });
        }

        // 3. Add any other filter logic you might want in the future (e.g., categories)
        // if ($request->filled('category')) {
        //     $query->where('category_id', $request->input('category'));
        // }

        // Order the results (latest first)
        $query->latest('published_at'); // Sort by published_at in descending order

        // Paginate the results and include the query string so filters persist
        $blogs = $query->paginate(6)->withQueryString();

        return view('dashboard.admin.blogs.front', compact('blogs')); // Anda mungkin ingin view terpisah untuk front-end (misal: 'alumni.blogs.index')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'published_at' => 'nullable|date',
            'comments_enabled' => 'boolean', // Tambahkan validasi untuk ini
        ]);

        $data = $request->only(['title', 'description', 'published_at']);

        $data['slug'] = Str::slug($request->title);
        $data['comments_enabled'] = $request->has('comments_enabled'); // Set nilai berdasarkan checkbox

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        // Add logic here to ensure only published blogs can be viewed publicly
        if (!$blog->published_at || $blog->published_at > Carbon::now()) {
            abort(404); // Or redirect to a 'not found' page or the blog list
        }
        // Eager load semua komentar dan balasan, serta pengguna yang membuat komentar/balasan
        $blog->load(['comments']); // Menggunakan relasi 'comments'
        return view('dashboard.admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('dashboard.admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $rules = [
            'title' => 'required|string|max:255|unique:blogs,title,' . $blog->id,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'published_at' => 'nullable|date',
            'comments_enabled' => 'boolean', // Validasi untuk field ini
        ];

        $validatedData = $request->validate($rules);

        $dataToUpdate = $request->only(['title', 'description', 'published_at']);

        if ($request->title !== $blog->title) {
            $dataToUpdate['slug'] = Str::slug($request->title);
        }

        if ($request->hasFile('image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $dataToUpdate['image'] = $request->file('image')->store('blogs', 'public');
        } elseif ($request->input('remove_image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $dataToUpdate['image'] = null;
        }

        // Set comments_enabled berdasarkan checkbox
        $dataToUpdate['comments_enabled'] = $request->has('comments_enabled');

        $blog->update($dataToUpdate);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog berhasil dihapus.');
    }
}