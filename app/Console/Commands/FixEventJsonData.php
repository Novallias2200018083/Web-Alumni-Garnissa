<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event; // Import model Event

class FixEventJsonData extends Command
{
    protected $signature = 'fix:event-json-data';
    protected $description = 'Fixes target_majors and target_years JSON format in events table.';

    public function handle()
    {
        $this->info('Starting to fix event JSON data...');

        $events = Event::all(); // Ambil semua event
        $fixedCount = 0;

        foreach ($events as $event) {
            $changed = false;

            // Perbaiki target_majors
            if ($event->target_majors !== null && is_array($event->target_majors)) {
                $originalMajors = $event->target_majors;
                // Pastikan semua elemen adalah integer
                $fixedMajors = array_map('intval', $originalMajors);
                // Cek jika ada perubahan nilai atau tipe
                if ($fixedMajors != $originalMajors || collect($originalMajors)->contains(function($value){ return is_string($value); })) {
                    $event->target_majors = $fixedMajors;
                    $changed = true;
                }
            } else if ($event->target_majors !== null) { // Jika bukan array tapi ada isinya (misal: "1")
                // Coba konversi ke array of int
                $value = trim($event->target_majors, '[]'); // Hapus bracket jika ada
                if (str_contains($value, ',')) { // Handle comma separated values
                    $fixedMajors = array_map('intval', explode(',', $value));
                } else { // Handle single value
                    $fixedMajors = [intval($value)];
                }
                $event->target_majors = $fixedMajors;
                $changed = true;
            }

            // Perbaiki target_years (logika sama dengan target_majors)
            if ($event->target_years !== null && is_array($event->target_years)) {
                $originalYears = $event->target_years;
                $fixedYears = array_map('intval', $originalYears);
                if ($fixedYears != $originalYears || collect($originalYears)->contains(function($value){ return is_string($value); })) {
                    $event->target_years = $fixedYears;
                    $changed = true;
                }
            } else if ($event->target_years !== null) { // Jika bukan array
                $value = trim($event->target_years, '[]');
                if (str_contains($value, ',')) {
                    $fixedYears = array_map('intval', explode(',', $value));
                } else {
                    $fixedYears = [intval($value)];
                }
                $event->target_years = $fixedYears;
                $changed = true;
            }

            if ($changed) {
                $event->save(); // Simpan perubahan
                $fixedCount++;
                $this->info("Fixed event ID: {$event->id}");
            }
        }

        $this->info("Finished fixing event JSON data. Total fixed: {$fixedCount} events.");
    }
}