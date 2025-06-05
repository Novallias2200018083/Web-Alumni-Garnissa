<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Pastikan ini diimpor!

class CommentController extends Controller
{
    /**
     * Menyimpan komentar baru ke penyimpanan.
     * Metode ini digunakan oleh alumni untuk menambahkan komentar utama pada blog.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog  Objek Blog yang akan dikomentari (disediakan melalui Route Model Binding).
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id', // Validasi parent_id jika ini balasan (meskipun biasanya store untuk komentar utama)
        ]);

        $comment = new Comment([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id ?? null,
        ]);

        $blog->comments()->save($comment);

        // --- DEBUGGING LOG untuk Metode store ---
        $redirectUrl = route('alumni.blogs.show', $blog->id);
        Log::info("COMMENT STORE: User " . Auth::user()->name . " (ID: " . Auth::id() . ") added comment to blog ID: {$blog->id}.");
        Log::info("COMMENT STORE: Redirecting to: " . $redirectUrl);
        // --- END DEBUGGING LOG ---

        return redirect($redirectUrl)
                         ->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Menyimpan balasan untuk komentar yang sudah ada.
     * Metode ini digunakan oleh admin dan alumni untuk membalas komentar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $parentComment  Komentar induk yang akan dibalas.
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, Comment $parentComment)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $reply = $parentComment->replies()->create([
            'user_id' => Auth::id(),
            'blog_id' => $parentComment->blog_id,
            'content' => $request->content,
        ]);

        // --- DEBUGGING LOG untuk Metode reply ---
        $userRole = Auth::user()->role ?? 'unknown'; // Ambil peran user
        $redirectRouteName = '';
        $redirectBlogId = $parentComment->blog_id;
        $finalRedirectUrl = '';

        if ($userRole === 'admin') {
            $redirectRouteName = 'blogs.show';
            $finalRedirectUrl = route($redirectRouteName, $redirectBlogId);
            Log::info("REPLY (ADMIN): User " . Auth::user()->name . " (ID: " . Auth::id() . ", Role: {$userRole}) replied to comment ID: {$parentComment->id} on blog ID: {$redirectBlogId}.");
            Log::info("REPLY (ADMIN): Redirecting to route '{$redirectRouteName}' with blog ID '{$redirectBlogId}'. Full URL: {$finalRedirectUrl}");
            return redirect($finalRedirectUrl)
                             ->with('success', 'Balasan berhasil ditambahkan!');
        } else {
            $redirectRouteName = 'alumni.blogs.show';
            $finalRedirectUrl = route($redirectRouteName, $redirectBlogId);
            Log::info("REPLY (ALUMNI): User " . Auth::user()->name . " (ID: " . Auth::id() . ", Role: {$userRole}) replied to comment ID: {$parentComment->id} on blog ID: {$redirectBlogId}.");
            Log::info("REPLY (ALUMNI): Redirecting to route '{$redirectRouteName}' with blog ID '{$redirectBlogId}'. Full URL: {$finalRedirectUrl}");
            return redirect($finalRedirectUrl)
                             ->with('success', 'Balasan berhasil ditambahkan!');
        }
        // --- END DEBUGGING LOG ---
    }

    /**
     * Menghapus komentar dari penyimpanan.
     * Hanya pemilik komentar atau admin yang dapat menghapus komentar.
     *
     * @param  \App\Models\Comment  $comment  Komentar yang akan dihapus.
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $blogId = $comment->blog_id; // Simpan ID blog sebelum komentar dihapus

        // --- DEBUGGING LOG untuk Metode destroy ---
        $userRole = Auth::user()->role ?? 'unknown';
        Log::info("COMMENT DESTROY: User " . Auth::user()->name . " (ID: " . Auth::id() . ", Role: {$userRole}) attempting to delete comment ID: {$comment->id} on blog ID: {$blogId}.");
        // --- END DEBUGGING LOG ---

        if (Auth::id() === $comment->user_id || (Auth::check() && $userRole === 'admin')) {
            $comment->delete();

            // --- DEBUGGING LOG untuk Redirect setelah destroy ---
            $redirectRouteName = '';
            $finalRedirectUrl = '';
            if ($userRole === 'admin') {
                $redirectRouteName = 'blogs.show';
                $finalRedirectUrl = route($redirectRouteName, $blogId);
                Log::info("COMMENT DESTROY (ADMIN SUCCESS): Redirecting to route '{$redirectRouteName}' with blog ID '{$blogId}'. Full URL: {$finalRedirectUrl}");
            } else {
                $redirectRouteName = 'alumni.blogs.show';
                $finalRedirectUrl = route($redirectRouteName, $blogId);
                Log::info("COMMENT DESTROY (ALUMNI SUCCESS): Redirecting to route '{$redirectRouteName}' with blog ID '{$blogId}'. Full URL: {$finalRedirectUrl}");
            }
            // --- END DEBUGGING LOG ---

            return redirect($finalRedirectUrl)
                             ->with('success', 'Komentar berhasil dihapus!');
        }

        // --- DEBUGGING LOG untuk Gagal Hapus ---
        Log::warning("COMMENT DESTROY (AUTH FAILED): User " . Auth::user()->name . " (ID: " . Auth::id() . ", Role: {$userRole}) attempted to delete comment ID: {$comment->id} but was unauthorized.");
        // --- END DEBUGGING LOG ---

        return back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
    }
}