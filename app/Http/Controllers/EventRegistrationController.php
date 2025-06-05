<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class EventRegistrationController extends Controller
{
    public function __construct()
    {
        // Middleware untuk alumni
        $this->middleware('auth')->except(['front']); // 'front' mungkin untuk melihat daftar event pendaftaran umum
        $this->middleware('role:alumni')->only([
            'rsvp', 'showPaymentForm', 'uploadPaymentProof'
        ]);

        // Middleware untuk admin
        $this->middleware('role:admin')->only([
            'indexAdmin', 'confirmPayment', 'rejectPayment', 'destroyAdmin', 'showAdmin',
            'indexEventRegistrations' // <--- TAMBAHKAN INI
        ]);
    }

    /**
     * Handle event RSVP/Registration for alumni.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function rsvp(Event $event)
    {
        $user = Auth::user();

        
        // 1. Cek apakah user sudah login dan alumni
        if (!$user || $user->role !== 'alumni') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai alumni untuk mendaftar event.');
        }

        // 2. Cek eligibility (sesuai audiens target)
        if (!$event->isEligibleForAlumni($user)) {
            return back()->with('error', 'Anda tidak memenuhi kriteria audiens untuk event ini.');
        }

        // 3. Cek ketersediaan slot (jika ada batasan)
        if (!$event->hasAvailableSlots()) {
            return back()->with('error', 'Maaf, kuota peserta event ini sudah penuh.');
        }

        // 4. Cek apakah user sudah terdaftar untuk event ini
        $existingRegistration = EventRegistration::where('user_id', $user->id)
                                                 ->where('event_id', $event->id)
                                                 ->first();

        if ($existingRegistration) {
            // Jika sudah terdaftar dan statusnya "confirmed" atau "pending_confirmation"
            if ($existingRegistration->status === 'confirmed') {
                return back()->with('info', 'Anda sudah terdaftar dan pendaftaran Anda telah dikonfirmasi untuk event ini.');
            } elseif ($existingRegistration->status === 'pending_confirmation') {
                return back()->with('info', 'Pendaftaran Anda sedang menunggu konfirmasi admin.');
            } elseif ($existingRegistration->status === 'pending_payment') {
                // Jika statusnya pending payment, arahkan ke halaman pembayaran
                return redirect()->route('events.payment', $existingRegistration->id)
                                 ->with('info', 'Anda sudah mendaftar, silakan lanjutkan pembayaran.');
            } else {
                // Misal statusnya rejected/cancelled, bisa daftar ulang
                $existingRegistration->update([
                    'status' => $event->is_paid ? 'pending_payment' : 'confirmed',
                    'payment_proof' => null, // Hapus bukti lama jika daftar ulang
                ]);
                if ($event->is_paid) {
                    return redirect()->route('events.payment', $existingRegistration->id)
                                     ->with('success', 'Anda berhasil mendaftar ulang. Silakan selesaikan pembayaran.');
                } else {
                    return back()->with('success', 'Anda berhasil mendaftar ulang untuk event GRATIS ini!');
                }
            }
        }

        // 5. Buat pendaftaran baru
        $status = $event->is_paid ? 'pending_payment' : 'confirmed';

        $registration = EventRegistration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => $status,
        ]);

        if ($event->is_paid) {
            return redirect()->route('events.payment', $registration->id)
                             ->with('success', 'Pendaftaran berhasil! Silakan unggah bukti pembayaran Anda.');
        } else {
            return back()->with('success', 'Anda berhasil mendaftar untuk event GRATIS ini!');
        }
    }

    /**
     * Show the payment form for a specific registration.
     *
     * @param  \App\Models\EventRegistration  $registration
     * @return \Illuminate\Http\Response
     */
    public function showPaymentForm(EventRegistration $registration)
    {
        // Pastikan registrasi milik user yang sedang login
        if (Auth::id() !== $registration->user_id) {
            abort(403, 'Anda tidak memiliki akses ke pendaftaran ini.');
        }

        // Pastikan event ini berbayar dan statusnya pending_payment
        if (!$registration->event->is_paid || $registration->status !== 'pending_payment') {
            return redirect()->route('events.public.detail', $registration->event->id)
                             ->with('error', 'Pendaftaran ini tidak memerlukan pembayaran atau sudah diproses.');
        }

        return view('dashboard.alumni.events.payment_form', compact('registration'));
    }

    /**
     * Upload payment proof for a specific registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventRegistration  $registration
     * @return \Illuminate\Http\Response
     */
    public function uploadPaymentProof(Request $request, EventRegistration $registration)
    {
        // Pastikan registrasi milik user yang sedang login
        if (Auth::id() !== $registration->user_id) {
            abort(403, 'Anda tidak memiliki akses untuk mengunggah bukti pembayaran ini.');
        }

        // Validasi
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Hapus bukti lama jika ada
        if ($registration->payment_proof && Storage::disk('public')->exists($registration->payment_proof)) {
            Storage::disk('public')->delete($registration->payment_proof);
        }

        // Simpan bukti pembayaran baru
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $registration->update([
            'payment_proof' => $path,
            'status' => 'pending_confirmation', // Ubah status menjadi menunggu konfirmasi
        ]);

        return redirect()->route('events.public.detail', $registration->event->id)
                         ->with('success', 'Bukti pembayaran berhasil diunggah! Pendaftaran Anda akan segera dikonfirmasi oleh admin.');
    }

    // =================================================================
    // ADMIN FUNCTIONS
    // =================================================================

    /**
     * Display a listing of event registrations for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin(Request $request)
    {
        $query = EventRegistration::with(['user.alumniProfile', 'event'])
                                  ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search by user name or event title
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('event', function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }

        $registrations = $query->paginate(10);
        $statuses = ['pending_payment', 'pending_confirmation', 'confirmed', 'rejected', 'cancelled'];

        return view('dashboard.admin.events.registrations.index', compact('registrations', 'statuses'));
    }

    /**
     * Display the specified event registration for admin.
     *
     * @param  \App\Models\EventRegistration  $registration
     * @return \Illuminate\Http\Response
     */
    public function showAdmin(EventRegistration $registration)
    {
        $registration->load(['user.alumniProfile','user.major', 'event']); // Load relasi yang diperlukan
        return view('dashboard.admin.events.registrations.show', compact('registration'));
    }

    /**
     * Confirm a pending payment registration.
     *
     * @param  \App\Models\EventRegistration  $registration
     * @return \Illuminate\Http\Response
     */
    public function confirmPayment(EventRegistration $registration)
    {
        if ($registration->status !== 'pending_confirmation') {
            return back()->with('error', 'Status pendaftaran ini tidak dapat dikonfirmasi.');
        }

        // Cek kuota lagi sebelum konfirmasi (jika ada batasan)
        if (!$registration->event->hasAvailableSlots()) {
             return back()->with('error', 'Maaf, kuota peserta event ini sudah penuh. Tidak bisa dikonfirmasi.');
        }

        $registration->update(['status' => 'confirmed']);

        return back()->with('success', 'Pendaftaran berhasil dikonfirmasi.');
    }

    /**
     * Reject a pending payment registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventRegistration  $registration
     * @return \Illuminate\Http\Response
     */
    public function rejectPayment(Request $request, EventRegistration $registration)
    {
        // Validasi alasan penolakan
        $request->validate([
            'rejection_reason' => 'nullable|string|max:500', // Opsional, bisa ditambahkan di DB
        ]);

        if ($registration->status === 'confirmed') {
            return back()->with('error', 'Pendaftaran yang sudah dikonfirmasi tidak dapat ditolak.');
        }

        $registration->update([
            'status' => 'rejected',
            // 'rejection_reason' => $request->rejection_reason, // Jika ada kolom ini di DB
        ]);

        return back()->with('success', 'Pendaftaran berhasil ditolak.');
    }

    /**
     * Delete an event registration.
     *
     * @param  \App\Models\EventRegistration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroyAdmin(EventRegistration $registration)
    {
        // Hapus bukti pembayaran dari storage jika ada
        if ($registration->payment_proof && Storage::disk('public')->exists($registration->payment_proof)) {
            Storage::disk('public')->delete($registration->payment_proof);
        }

        $registration->delete();

        return back()->with('success', 'Pendaftaran berhasil dihapus.');
    }

    /**
     * Display a listing of registrations for a specific event (for admin).
     *
     * @param  \App\Models\Event  $event // <-- PASTIKAN PARAMETER INI ADA DAN DI-TYPE HINT
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexEventRegistrations(\App\Models\Event $event, Request $request)
    {
        $query = $event->eventRegistrations()->with(['user.alumniProfile'])
                                            ->orderBy('created_at', 'desc');

        // Filter by status (opsional)
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search by user name (opsional)
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $registrations = $query->paginate(10);
        $statuses = ['pending_payment', 'pending_confirmation', 'confirmed', 'rejected', 'cancelled'];

        // <-- PASTIKAN ANDA MENGIRIMKAN VARIABEL $event KE VIEW -->
        return view('dashboard.admin.events.registrations.index', compact('event', 'registrations', 'statuses'));
    }
}