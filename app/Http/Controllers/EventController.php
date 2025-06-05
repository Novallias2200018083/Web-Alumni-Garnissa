<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Major; // Pastikan model Major sudah di-import
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Tambahkan constructor untuk middleware
    public function __construct()
    {
        // Middleware 'auth' diterapkan ke semua kecuali 'front', 'show', 'detail', 'detail1'.
        // Ini memastikan pengunjung bisa melihat daftar event publik dan detailnya.
        $this->middleware('auth')->except(['front', 'show', 'detail', 'detail1']);
        // Middleware 'role:admin' diterapkan ke semua kecuali 'front', 'show', 'detail', 'detail1'.
        // Ini memastikan hanya admin yang bisa CRUD event, sementara publik hanya melihat.
        $this->middleware('role:admin')->except(['front', 'show', 'detail', 'detail1']);
    }

    /**
     * Tampilkan semua event untuk dashboard admin dengan fungsionalitas pencarian dan filter.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Logika Pencarian untuk Admin (berdasarkan judul, deskripsi, lokasi)
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('location', 'like', '%' . $searchTerm . '%');
            });
        }

        // Logika Filter Status Event (Mendatang/Selesai) untuk Admin
        $status = $request->input('status');
        if ($status === 'upcoming') {
            $query->where('event_date', '>=', Carbon::today());
        } elseif ($status === 'past') {
            $query->where('event_date', '<', Carbon::today());
        }

        // Logika Filter Tipe Event (Berbayar/Gratis) untuk Admin
        if ($request->filled('type_filter')) {
            if ($request->input('type_filter') === 'paid') {
                $query->where('is_paid', true);
            } elseif ($request->input('type_filter') === 'free') {
                $query->where('is_paid', false);
            }
        }

        // Logika Filter Tipe Audiens untuk Admin
        if ($request->filled('audience_filter')) {
            $audienceFilter = $request->input('audience_filter');
            $query->where('audience_type', $audienceFilter);
        }

        // Logika Filter Berdasarkan Jurusan (target_majors) untuk Admin
        if ($request->filled('major_filter')) {
            $majorId = (int) $request->input('major_filter');
            // Kita harus mencari event yang 'target_majors' array JSON-nya mengandung majorId ini
            $query->whereJsonContains('target_majors', $majorId);
        }

        // Logika Filter Berdasarkan Angkatan (target_years) untuk Admin
        if ($request->filled('year_filter')) {
            $year = (int) $request->input('year_filter');
            // Kita harus mencari event yang 'target_years' array JSON-nya mengandung tahun ini
            $query->whereJsonContains('target_years', $year);
        }

        // Pengurutan (Order By) untuk Admin
        // Urutkan berdasarkan tanggal, jika status 'past' maka descending, jika 'upcoming' atau 'all' maka ascending
        if ($status === 'past') {
            $query->orderBy('event_date', 'desc')->orderBy('event_time', 'desc');
        } else {
            $query->orderBy('event_date', 'asc')->orderBy('event_time', 'asc');
        }

        // Ambil event dengan pagination, urutkan terbaru terlebih dahulu
        // Sertakan query string agar filter tetap ada di link pagination
        $events = $query->paginate(6)->withQueryString();

        // Data tambahan untuk dropdown filter
        $majors = Major::all();
        $currentYear = Carbon::now()->year;
        $years = range($currentYear + 10, $currentYear - 30); // Rentang tahun yang cukup luas
        rsort($years); // Urutkan tahun dari terbesar ke terkecil

        // Pastikan view yang dipanggil sudah benar, sesuai dengan path yang Anda berikan
        return view('dashboard.admin.events.index', compact('events', 'majors', 'years'));
    }

    /**
     * Tampilkan semua event untuk UI publik (Front-end).
     * Metode ini sudah memiliki filter dan pengurutan sendiri.
     */
    public function front(Request $request)
    {
        $query = Event::query();

        // Filter: Hanya event dengan audience_type 'all' untuk tampilan publik utama
        $query->where('audience_type', 'all');

        // Terapkan Filter Pencarian (berdasarkan judul, deskripsi, lokasi)
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        // Terapkan Filter Status (Mendatang/Selesai)
        $status = $request->input('status');
        if ($status === 'upcoming') {
            $query->where('event_date', '>=', Carbon::today());
        } elseif ($status === 'past') {
            $query->where('event_date', '<', Carbon::today());
        } else {
            // Default: Jika tidak ada filter status atau status 'all', tampilkan yang mendatang
            $query->where('event_date', '>=', Carbon::today());
        }

        // Pengurutan (Order By)
        // Urutkan berdasarkan tanggal, jika past maka descending, jika upcoming/all maka ascending
        if ($status === 'past') {
            $query->orderBy('event_date', 'desc')->orderBy('event_time', 'desc');
        } else {
            $query->orderBy('event_date', 'asc')->orderBy('event_time', 'asc');
        }

        // Ambil hasil dengan pagination, sertakan query string agar filter tetap ada di link pagination
        $events = $query->paginate(6)->withQueryString();
        return view('dashboard.admin.events.front', compact('events'));
    }

    /**
     * Tampilkan formulir untuk membuat event baru.
     */
    public function create()
    {
        $majors = Major::all();
        $currentYear = Carbon::now()->year;
        $years = range($currentYear + 10, $currentYear - 30);
        rsort($years);

        return view('dashboard.admin.events.create', compact('majors', 'years'));
    }

    /**
     * Simpan event yang baru dibuat.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'rsvp_required' => 'required|boolean',
            'audience_type' => 'required|in:all,major_only,year_only,major_and_year',
            'max_attendees' => 'nullable|integer|min:1',
            'is_paid' => 'required|boolean',
            'price' => 'nullable|numeric|min:0.01|required_if:is_paid,1',
            'image' => 'nullable|image|max:2048',
        ];

        if ($request->audience_type == 'major_only' || $request->audience_type == 'major_and_year') {
            $rules['target_majors'] = 'required|array|min:1';
            $rules['target_majors.*'] = 'integer|exists:majors,id';
        }
        if ($request->audience_type == 'year_only' || $request->audience_type == 'major_and_year') {
            $rules['target_years'] = 'required|array|min:1';
            $rules['target_years.*'] = 'integer|min:1900|max:' . (Carbon::now()->year + 10);
        }

        $validatedData = $request->validate($rules);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        $targetMajors = null;
        if (in_array($validatedData['audience_type'], ['major_only', 'major_and_year'])) {
            $targetMajors = array_map('intval', $validatedData['target_majors']);
        }

        $targetYears = null;
        if (in_array($validatedData['audience_type'], ['year_only', 'major_and_year'])) {
            $targetYears = array_map('intval', $validatedData['target_years']);
        }

        Event::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'event_date' => $validatedData['event_date'],
            'event_time' => $validatedData['event_time'],
            'location' => $validatedData['location'],
            'rsvp_required' => $validatedData['rsvp_required'],
            'audience_type' => $validatedData['audience_type'],
            'target_majors' => $targetMajors,
            'target_years' => $targetYears,
            'max_attendees' => $validatedData['max_attendees'],
            'is_paid' => $validatedData['is_paid'],
            'price' => $validatedData['is_paid'] ? $validatedData['price'] : null,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat.');
    }

    /**
     * Tampilkan detail sumber daya yang ditentukan untuk tampilan publik.
     */
    public function show(Event $event)
    {
        return view('dashboard.admin.events.show', compact('event'));
    }

    /**
     * Tampilkan formulir untuk mengedit event.
     */
    public function edit(Event $event)
    {
        $majors = Major::all();
        $currentYear = Carbon::now()->year;
        $years = range($currentYear + 10, $currentYear - 30);
        rsort($years);

        return view('dashboard.admin.events.edit', compact('event', 'majors', 'years'));
    }

    /**
     * Perbarui event yang sudah ada.
     */
    public function update(Request $request, Event $event)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'rsvp_required' => 'required|boolean',
            'audience_type' => 'required|in:all,major_only,year_only,major_and_year',
            'max_attendees' => 'nullable|integer|min:1',
            'is_paid' => 'required|boolean',
            'price' => 'nullable|numeric|min:0.01|required_if:is_paid,1',
            'image' => 'nullable|image|max:2048',
        ];

        if ($request->audience_type == 'major_only' || $request->audience_type == 'major_and_year') {
            $rules['target_majors'] = 'required|array|min:1';
            $rules['target_majors.*'] = 'integer|exists:majors,id';
        }
        if ($request->audience_type == 'year_only' || $request->audience_type == 'major_and_year') {
            $rules['target_years'] = 'required|array|min:1';
            $rules['target_years.*'] = 'integer|min:1900|max:' . (Carbon::now()->year + 10);
        }

        $validatedData = $request->validate($rules);

        $imagePath = $event->image;
        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $imagePath = $request->file('image')->store('events', 'public');
        }

        $targetMajors = null;
        if (in_array($validatedData['audience_type'], ['major_only', 'major_and_year'])) {
            $targetMajors = array_map('intval', $validatedData['target_majors']);
        }

        $targetYears = null;
        if (in_array($validatedData['audience_type'], ['year_only', 'major_and_year'])) {
            $targetYears = array_map('intval', $validatedData['target_years']);
        }

        $event->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'event_date' => $validatedData['event_date'],
            'event_time' => $validatedData['event_time'],
            'location' => $validatedData['location'],
            'rsvp_required' => $validatedData['rsvp_required'],
            'audience_type' => $validatedData['audience_type'],
            'target_majors' => $targetMajors,
            'target_years' => $targetYears,
            'max_attendees' => $validatedData['max_attendees'],
            'is_paid' => $validatedData['is_paid'],
            'price' => $validatedData['is_paid'] ? $validatedData['price'] : null,
            'image' => $imagePath,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Hapus event.
     */
    public function destroy(Event $event)
    {
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }

    /**
     * Tampilkan detail event yang ditentukan untuk frontend publik (detailEvent.blade.php).
     */
    public function detail(Event $event)
    {
        return view('events.detailEvent', compact('event'));
    }

    /**
     * Tampilkan detail event yang ditentukan untuk frontend publik (detailEvent1.blade.php).
     * Ini sepertinya adalah tampilan detail alternatif atau duplikat.
     */
    public function detail1(Event $event)
    {
        return view('events.detailEvent1', compact('event'));
    }
}