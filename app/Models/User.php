<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\EventRegistration; // <--- TAMBAHKAN INI
use App\Models\Major;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <--- Tambahkan ini

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'student_id', // Tambahkan ini
        'major_id',   // Tambahkan ini
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function alumniProfile()
    {
        return $this->hasOne(AlumniProfile::class);
    }
    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'major_id', 'id'); // Jika kolomnya major_id di users
    }
    // <--- TAMBAHKAN METHOD INI --- >
    /**
     * Get the event registrations for the user.
     */
    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
    // <--- AKHIR TAMBAHKAN METHOD INI --- >
     public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
