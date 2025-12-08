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

        $reports = Report::where('user_id', $userId)->latest()->paginate(10);

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
        // Cek apakah user mencentang 'Anonim'
        $isAnonymous = $request->has('is_anonymous');

        // Tentukan aturan: Jika Anonim, data diri boleh kosong (nullable). Jika tidak, wajib (required).
        $identityRule = $isAnonymous ? 'nullable' : 'required';

        // 1. Validasi
        $validator = Validator::make($request->all(), [
            // --- Data Pelapor (Kondisional) ---
            'reporter_pob'        => "$identityRule|string|max:255",
            'reporter_dob'        => "$identityRule|date",
            'reporter_age'        => "$identityRule|integer",
            'reporter_occupation' => "$identityRule|string|max:255",
            'reporter_gender'     => "$identityRule|in:Laki-laki,Perempuan",
            'reporter_phone'      => "$identityRule|string|max:20",
            'reporter_address'    => "$identityRule|string",

            // --- Data Readonly (Email/Nama/NIM) ---
            // Tetap divalidasi formatnya, tapi boleh null jika anonim (karena JS menghapus value-nya)
            'reporter_email'      => "$identityRule|email|max:255",
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
                ->withInput();
        }

        // 2. Generate data otomatis
        $autoTitle = "Laporan: " . Str::limit($request->violence_type, 50);
        $autoCategory = "Laporan Rinci";

        // 3. Buat Laporan
        // Kita gunakan operator '??' (Null Coalescing). 
        // Jika data kosong (karena anonim), isi dengan '-' atau 'Disembunyikan' agar Database tidak error.

        Report::create([
            'user_id'       => Auth::id(),
            'title'         => $autoTitle,
            'category'      => $autoCategory,
            'status'        => 'pending',
            'is_anonymous'  => $isAnonymous, // Simpan status true/false

            // Mapping Data Pelapor (Handle Anonim)
            'reporter_email'      => $isAnonymous ? 'Disembunyikan' : $request->reporter_email,
            'reporter_name'       => $isAnonymous ? 'Disembunyikan' : $request->reporter_name,
            'reporter_pob'        => $isAnonymous ? '-' : $request->reporter_pob,
            // Untuk tanggal lahir, jika anonim kita isi tanggal hari ini atau null (tergantung struktur DB). 
            // Jika DB kolom date tidak boleh null, pakai tanggal dummy. Jika boleh string, pakai '-'.
            // Asumsi: kolom DB bertipe DATE. Kita pakai null jika diizinkan, atau tanggal dummy.
            'reporter_dob'        => $isAnonymous ? now() : $request->reporter_dob,
            'reporter_age'        => $isAnonymous ? 0 : $request->reporter_age,
            'reporter_occupation' => $isAnonymous ? '-' : $request->reporter_occupation,
            'reporter_nim'        => $isAnonymous ? '-' : ($request->reporter_nim ?? '-'),
            'reporter_prodi'      => $isAnonymous ? '-' : ($request->reporter_prodi ?? '-'),
            'reporter_gender'     => $isAnonymous ? 'Perempuan' : $request->reporter_gender, // Default value technical
            'reporter_phone'      => $isAnonymous ? '-' : $request->reporter_phone,
            'reporter_address'    => $isAnonymous ? 'Disembunyikan' : $request->reporter_address,

            // Mapping Data Laporan (Tetap diambil dari request)
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
        // KEAMANAN: Pastikan mahasiswa hanya bisa melihat laporannya sendiri
        if ($report->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

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
}
