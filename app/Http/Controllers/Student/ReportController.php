<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // <-- Pastikan Str di-import

class ReportController extends Controller
{
    /**
     * Menampilkan daftar laporan milik mahasiswa yang sedang login.
     */
    public function index()
    {
        $userId = Auth::id();

        // Ambil laporan + Hitung pesan unread dari ADMIN
        $reports = Report::where('user_id', $userId)
            ->withCount(['messages as unread_messages_count' => function ($query) {
                $query->where('sender_role', 'admin') // Cek pesan dari ADMIN
                    ->where('is_read', false);      // Yang belum dibaca
            }])
            ->latest()
            ->paginate(10);

        // Statistik Dashboard (Biarkan seperti semula)
        $stats = [
            'total' => Report::where('user_id', $userId)->count(),
            'pending' => Report::where('user_id', $userId)->whereIn('status', ['pending', 'in_progress'])->count(),
            'resolved' => Report::where('user_id', $userId)->whereIn('status', ['resolved', 'rejected'])->count(),
        ];

        return view('student.reports.index', compact('reports', 'stats'));
    }
    /**
     * Menyimpan laporan baru (Formulir Detail Sesuai Permintaan Mitra).
     */
    /**
     * Menyimpan laporan baru (Formulir Detail Sesuai Permintaan Mitra).
     */
    public function store(Request $request)
    {
        // 1. Cek Status Anonim
        $isAnonymous = $request->has('is_anonymous');

        // Tentukan aturan: Jika Anonim, data diri boleh kosong. Jika tidak, WAJIB.
        $identityRule = $isAnonymous ? 'nullable' : 'required';

        // 2. Validasi
        $validator = Validator::make($request->all(), [
            // --- Data Identitas (Kondisional) ---
            // PENTING: Tambahkan validasi NIM & Prodi yang sebelumnya hilang
            'reporter_nim'        => "$identityRule|string|max:50",
            'reporter_prodi'      => "$identityRule|string|max:100",

            'reporter_phone'      => "$identityRule|string|max:20",
            'reporter_pob'        => "$identityRule|string|max:255",
            'reporter_dob'        => "$identityRule|date",
            'reporter_age'        => "$identityRule|integer",
            'reporter_occupation' => "$identityRule|string|max:255",
            'reporter_gender'     => "$identityRule|in:Laki-laki,Perempuan",
            'reporter_address'    => "$identityRule|string",
            'reporter_name'       => "$identityRule|string|max:255",

            // --- Data Kejadian (SELALU WAJIB) ---
            'violence_type'       => 'required|string',
            'description'         => 'required|string',
            'incident_location'   => 'required|string|max:255',
            'disability_status'   => 'required|string|max:255',
            'report_date'         => 'required|date',

            // --- Data Terlapor (SELALU WAJIB) ---
            'reported_party_name'       => 'required|string|max:255',
            'reported_party_occupation' => 'required|string|max:255',
            'reported_party_age'        => 'required|integer',

            // --- Info Tambahan (SELALU WAJIB) ---
            'reason_for_reporting' => 'required|string',
            'victim_needs'         => 'required|string',
            'witness_contact'      => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // Agar isian tidak hilang saat error
        }

        // ---------------------------------------------------------------------
        // 3. FITUR AUTO-SYNC PROFIL (Update Data User Otomatis)
        // ---------------------------------------------------------------------
        // Jika laporan ini RESMI (Bukan Anonim), kita cek apakah profil user masih kosong.
        // Jika kosong, kita "pinjam" data dari form laporan ini untuk melengkapi profilnya.
        if (!$isAnonymous) {
            $user = Auth::user();
            $updated = false;

            // Cek NIM
            if (empty($user->nim) && $request->filled('reporter_nim')) {
                $user->nim = $request->reporter_nim;
                $updated = true;
            }
            // Cek No HP
            if (empty($user->phone) && $request->filled('reporter_phone')) {
                $user->phone = $request->reporter_phone;
                $updated = true;
            }
            // Cek Prodi / Unit Kerja
            if (empty($user->department) && $request->filled('reporter_prodi')) {
                $user->department = $request->reporter_prodi; // Pastikan nama kolom di DB 'department' atau 'program'
                $updated = true;
            }

            if ($updated) {
                $user->save(); // Simpan perubahan ke tabel users
            }
        }
        // ---------------------------------------------------------------------

        // 4. Generate Judul Otomatis
        $autoTitle = "Laporan: " . Str::limit($request->violence_type, 50);

        // 5. Simpan Laporan ke Database
        Report::create([
            'user_id'       => Auth::id(),
            'title'         => $autoTitle,
            'category'      => $request->violence_type,
            'status'        => 'pending',
            'is_anonymous'  => $isAnonymous,

            // --- Mapping Data Pelapor ---
            // Jika Anonim -> Isi dengan '-' atau 'Disembunyikan'
            // Jika Resmi  -> Ambil dari Request
            'reporter_email'      => $isAnonymous ? 'Disembunyikan' : Auth::user()->email,
            'reporter_name'       => $isAnonymous ? 'Disembunyikan' : Auth::user()->name,

            // Data ini diambil dari input form (karena di form sudah ada logic readonly/input manual)
            'reporter_nim'        => $isAnonymous ? '-' : $request->reporter_nim,
            'reporter_prodi'      => $isAnonymous ? '-' : $request->reporter_prodi,
            'reporter_phone'      => $isAnonymous ? '-' : $request->reporter_phone,

            'reporter_pob'        => $isAnonymous ? '-' : $request->reporter_pob,
            'reporter_dob'        => $isAnonymous ? now() : $request->reporter_dob,
            'reporter_age'        => $isAnonymous ? 0 : $request->reporter_age,
            'reporter_occupation' => $isAnonymous ? '-' : $request->reporter_occupation,
            'reporter_gender'     => $isAnonymous ? 'Perempuan' : $request->reporter_gender,
            'reporter_address'    => $isAnonymous ? 'Disembunyikan' : $request->reporter_address,

            // --- Data Laporan ---
            'description'               => $request->description,
            'violence_type'             => $request->violence_type,
            'incident_location'         => $request->incident_location,
            'disability_status'         => $request->disability_status,
            'reported_party_name'       => $request->reported_party_name,
            'reported_party_occupation' => $request->reported_party_occupation,
            'reported_party_age'        => $request->reported_party_age,
            'reason_for_reporting'      => $request->reason_for_reporting,
            'witness_contact'           => $request->witness_contact,
            'victim_needs'              => $request->victim_needs,
            'report_date'               => $request->report_date,
        ]);

        return redirect()->route('student.reports.index')
            ->with('success', 'Laporan berhasil dikirim' . ($isAnonymous ? ' secara Anonim.' : '.'));
    }
    /**
     * Menampilkan detail laporan (dan chat).
     */
    public function show(Report $report)
    {
        // KEAMANAN: Pastikan akses milik sendiri
        if ($report->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // TANDAI PESAN ADMIN SEBAGAI SUDAH DIBACA (Update is_read)
        ReportMessage::where('report_id', $report->id)
            ->where('sender_role', 'admin') // Hanya pesan admin
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $report->load('user', 'messages.user');
        return view('student.reports.show', compact('report'));
    }

    /**
     * Menyimpan balasan chat dari mahasiswa.
     */
    public function storeMessage(Request $request, Report $report)
    {
        // KEAMANAN: Pastikan mahasiswa hanya bisa membalas laporannya sendiri
        if ($report->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ReportMessage::create([
            'report_id' => $report->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'sender_role' => 'student',
        ]);

        return redirect()->back()->with([
            'success' => 'Pesan terkirim',
            'active_tab' => 'chat'
        ]);
    }

    /**
     * Mengambil isi chat terbaru (untuk AJAX Polling)
     */
    public function fetchChat(Report $report)
    {
        // Pastikan relasi pesan ter-load
        $report->load('messages.user');

        // Kembalikan hanya potongan HTML chatnya saja
        return view('partials.chat_content', compact('report'));
    }
}
