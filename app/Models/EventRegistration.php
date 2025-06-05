<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    // Kolom-kolom yang boleh diisi secara massal
    protected $fillable = [
        'user_id',
        'event_id',
        'status',          // Contoh: 'pending_payment', 'pending_confirmation', 'confirmed', 'rejected', 'cancelled'
        'payment_proof',   // Path ke file bukti pembayaran
        'registered_at',   // Opsional, bisa pakai timestamps() bawaan Laravel
    ];

    // Casting atribut ke tipe data tertentu
    protected $casts = [
        'registered_at' => 'datetime',
    ];

    /**
     * Get the user that owns the event registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event that the registration belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getPaymentProofUrlAttribute()
    {
        if ($this->payment_proof) {
            return \Illuminate\Support\Facades\Storage::url($this->payment_proof);
        }
        return null;
    }
}