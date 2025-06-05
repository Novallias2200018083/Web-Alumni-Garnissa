<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log; // Jangan lupa import Log
// use Illuminate\Support\Facades\Auth; // Tidak perlu di-import di sini
use App\Models\EventRegistration;
use App\Models\User; // Perlu ini karena method menerima User
// use App\Models\Major; // Tidak perlu di-import di sini

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'image', 'event_date', 'location',
        'event_time', 'rsvp_required', 'audience_type', 'target_majors',
        'target_years', 'max_attendees', 'is_paid', 'price',
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime',
        'rsvp_required' => 'boolean',
        'is_paid' => 'boolean',
        'target_majors' => 'array',
        'target_years' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeForAlumni(Builder $query, User $user): Builder
    {
        // 1. Muat relasi yang diperlukan pada objek $user
        //    'major' untuk mendapatkan major_id dari user
        //    'alumniProfile' untuk mendapatkan graduation_year
        $user->loadMissing('major', 'alumniProfile');

        // 2. Ambil data yang dibutuhkan dari user
        //    major_id diambil langsung dari user->major (relasi BelongsTo)
        $alumniMajorId = optional($user->major)->id; // Mengambil ID dari objek Major yang berelasi
        //    graduation_year diambil dari alumniProfile
        $alumniGraduationYear = optional($user->alumniProfile)->graduation_year;

        Log::info('ScopeForAlumni Debug (Skenario A):', [
            'user_id' => $user->id,
            'alumni_major_id_for_query' => $alumniMajorId,
            'alumni_graduation_year_for_query' => $alumniGraduationYear,
        ]);

        return $query->where(function ($q) use ($alumniMajorId, $alumniGraduationYear) {
            // 1. Event umum (audience_type = 'all')
            $q->where('audience_type', 'all');

            // 2. Event spesifik Jurusan Saja (audience_type = 'major_only')
            if (!is_null($alumniMajorId)) { // Pastikan ID jurusan alumni ada
                $q->orWhere(function ($subQ) use ($alumniMajorId) {
                    $subQ->where('audience_type', 'major_only')
                         ->whereJsonContains('target_majors', (int)$alumniMajorId);
                });
            }

            // 3. Event spesifik Tahun Angkatan Saja (audience_type = 'year_only')
            if (!is_null($alumniGraduationYear)) { // Pastikan tahun kelulusan alumni ada
                $q->orWhere(function ($subQ) use ($alumniGraduationYear) {
                    $subQ->where('audience_type', 'year_only')
                         ->whereJsonContains('target_years', (int)$alumniGraduationYear);
                });
            }

            // 4. Event spesifik Jurusan DAN Tahun Angkatan (audience_type = 'major_and_year')
            if (!is_null($alumniMajorId) && !is_null($alumniGraduationYear)) { // Pastikan kedua data ada
                $q->orWhere(function ($subQ) use ($alumniMajorId, $alumniGraduationYear) {
                    $subQ->where('audience_type', 'major_and_year')
                         ->whereJsonContains('target_majors', (int)$alumniMajorId)
                         ->whereJsonContains('target_years', (int)$alumniGraduationYear);
                });
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Methods
    |--------------------------------------------------------------------------
    */

    public function isEligibleForAlumni(User $user): bool
    {
        // Jika tipe audiens 'all', semua eligible (termasuk non-alumni di UI publik)
        if ($this->audience_type === 'all') {
            return true;
        }

        // Pastikan user adalah alumni
        if ($user->role !== 'alumni') {
            return false;
        }

        // 1. Muat relasi yang diperlukan pada objek $user
        $user->loadMissing('major', 'alumniProfile');

        // 2. Ambil data yang dibutuhkan dari user
        $alumniMajorId = optional($user->major)->id; // Mengambil ID dari objek Major yang berelasi
        $alumniGraduationYear = optional($user->alumniProfile)->graduation_year;

        Log::info('isEligibleForAlumni Debug (Skenario A):', [
            'event_id' => $this->id,
            'event_audience_type' => $this->audience_type,
            'event_target_majors_casted' => $this->target_majors,
            'event_target_years_casted' => $this->target_years,
            'user_id' => $user->id,
            'alumni_major_id_from_user' => $alumniMajorId, // Perhatikan nama lognya
            'alumni_graduation_year_from_profile' => $alumniGraduationYear,
        ]);

        // Pastikan target_majors dan target_years adalah array non-null dari cast
        $eventTargetMajors = $this->target_majors ?? [];
        $eventTargetYears = $this->target_years ?? [];

        switch ($this->audience_type) {
            case 'major_only':
                if (empty($eventTargetMajors) || is_null($alumniMajorId)) {
                    Log::info('isEligibleForAlumni: major_only - Missing target_majors or alumniMajorId.', ['event_id' => $this->id, 'alumniMajorId' => $alumniMajorId, 'targetMajors' => $eventTargetMajors]);
                    return false;
                }
                return in_array((int)$alumniMajorId, array_map('intval', $eventTargetMajors));

            case 'year_only':
                if (empty($eventTargetYears) || is_null($alumniGraduationYear)) {
                    Log::info('isEligibleForAlumni: year_only - Missing target_years or alumniGraduationYear.', ['event_id' => $this->id, 'alumniGraduationYear' => $alumniGraduationYear, 'targetYears' => $eventTargetYears]);
                    return false;
                }
                return in_array((int)$alumniGraduationYear, array_map('intval', $eventTargetYears));

            case 'major_and_year':
                if (empty($eventTargetMajors) || empty($eventTargetYears) || is_null($alumniMajorId) || is_null($alumniGraduationYear)) {
                     Log::info('isEligibleForAlumni: major_and_year - Missing criteria.', [
                        'event_id' => $this->id,
                        'alumniMajorId' => $alumniMajorId,
                        'alumniGraduationYear' => $alumniGraduationYear,
                        'targetMajors' => $eventTargetMajors,
                        'targetYears' => $eventTargetYears
                    ]);
                    return false;
                }
                $isMajorMatch = in_array((int)$alumniMajorId, array_map('intval', $eventTargetMajors));
                $isYearMatch = in_array((int)$alumniGraduationYear, array_map('intval', $eventTargetYears));
                Log::info('isEligibleForAlumni: major_and_year - Match results.', [
                    'event_id' => $this->id,
                    'isMajorMatch' => $isMajorMatch,
                    'isYearMatch' => $isYearMatch
                ]);
                return $isMajorMatch && $isYearMatch;

            default:
                Log::info('isEligibleForAlumni: Unknown audience_type or "all" handled.', ['event_id' => $this->id, 'audience_type' => $this->audience_type]);
                return false;
        }
    }

    public function hasAvailableSlots(): bool
    {
        if ($this->max_attendees === null || $this->max_attendees <= 0) {
            return true;
        }

        $currentAttendees = $this->eventRegistrations()->where('status', 'confirmed')->count();

        return $currentAttendees < $this->max_attendees;
    }
}