<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini

class AlumniProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alumni_code',
        'phone',
        'address',
        'graduation_year',
        'bio',
        'image',
        'current_job',      // Kolom baru
        'company',          // Kolom baru
        'position',         // Kolom baru
        'linkedin_url',     // Kolom baru
        'website_url',      // Kolom baru
        'major_id',
    ];

    protected $casts = [
        'graduation_year' => 'integer', // Pastikan casting ini jika perlu
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // Relasi ke Major dari AlumniProfile
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
