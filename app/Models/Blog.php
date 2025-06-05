<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'published_at',
        'slug',
        'comments_enabled', // Tambahkan kolom baru
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'comments_enabled' => 'boolean', // Cast ke boolean
    ];

    /**
     * Get the comments for the blog post.
     * Hanya ambil komentar level atas (bukan balasan)
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->with('user')->orderBy('created_at', 'desc');
    }

    /**
     * Get all comments (including replies) for the blog post.
     * Digunakan untuk memuat semua komentar untuk tampilan hierarkis
     */
    public function allComments()
    {
        return $this->hasMany(Comment::class)->with('user', 'replies.user')->orderBy('created_at', 'desc');
    }
}
