<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\AdvoStruktur;
use App\Models\AdvoAspirasi;
use App\Models\AdvoFAQ;
use App\Models\AdvoKategori;

class AdvoController extends Controller
{
    public function index() {
        $aspirasi = AdvoAspirasi::leftJoin(
            'advo_kategori', 'advo_aspirasi.kategori', '=', 'advo_kategori.id_kategori'
        )->select(
            'advo_aspirasi.aspirasi',
            'advo_aspirasi.tanggapan',
            'advo_kategori.kategori as nama_kategori'
        )->where('advo_aspirasi.status', 'STS4')
        ->orderBy('advo_aspirasi.created_at', 'desc')
        ->get();

        return view('Advokasi', ['aspirasi' => $aspirasi]);
    }

    //Panggil semua atribut struktur untuk ditampilkan di section 'Struktur Organisasi'
    public function getStruktur() {
        $data = AdvoStruktur::select('foto', 'nama', 'jabatan') //Tampilkan foto, nama, dan jabatan
            ->where('jabatan','not like', 'Calon%') //Calon fungsionaris tidak ditampilkan di blade
            ->get()
            ->groupBy(function($items) {
                if(str_starts_with($items->jabatan, 'Ketua')) return 'kakom';
                if(str_starts_with($items->jabatan, 'Sekretaris')) return 'sekom';
                if(str_starts_with($items->jabatan, 'Fungsionaris')) return 'fungsio';
            });
        return view('Struktur', ['struktur' => $data]);
    }

    //Mengirimkan aspirasi
    public function postAspirasi(Request $req) {
        $ip = $req->ip();
        $nim = $req->nim;
        $tracking = $req->input('tracking_code');
        if (!$tracking) {
            $tracking = $this->generateTrackingCode();
        }

        AdvoAspirasi::create([
            'nama' => $req->nama,
            'nim' => $req->nim,
            'ip' => $ip,
            'kategori' => $req->kategori,
            'aspirasi' => $req->aspirasi,
            'tracking_code' => $tracking,
            'bersedia' => $req->has('bersedia')
        ]);

        // return redirect('form');
        return redirect('/form');
    }

    //Validasi NIM
    public function validateNIM(Request $req) {
        $nim = $req->nim;

        //1. Jika NIM kosong
        if(empty($nim)) {
            return response()->json([
                'success' => false,
                'message' => 'NIM Kosong'
            ]);
        }

        //2. Jika panjang NIM tidak sama dengan 9
        if(strlen($nim) !== 9) {
            return response()->json([
                'success' => false,
                'message' => 'Panjang NIM adalah 9 digit'
            ]);
        }

        //3. Validasi berdasarkan kode prodi
        $kodeNIM = substr($nim, 0, 2); //Ambil 2 digit pertama dari NIM

        // 56: D3 Teknik Informatika
        // 60: S1 Hubungan Masyarakat
        // 67: S1 Teknik Informatika
        // 68: S1 Sistem Informasi
        // 69: S1 Desain Komunikasi Visual
        // 71: S1 Pendidikan Teknik Informatika dan Komputer
        // 74: S1 Perpustakaan dan Sains Informasi
        // 84: S1 Bisnis Digital

        $kodeProdi = ['56', '60', '67', '68', '69', '71', '74', '84'];

        if(!in_array($kodeNIM, $kodeProdi, true)) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu bukan dari FTI'
            ]);
        }

        //4. Validasi berdasarkan tahun angkatan
        $tahunAngkatan = (int) substr($nim, 2, 4);
        $awal = Carbon::create($tahunAngkatan, 8, 1)->startOfDay();
        $akhir = Carbon::create($tahunAngkatan + 7, 7, 31)->endOfDay();
        $sekarang = Carbon::now();

        if(!$sekarang->between($awal, $akhir)) {
            return response()->json([
                'success' => false,
                'message' => 'Tahun angkatan tidak valid'
            ]);
        }

        $nomorUrut = substr($nim, 6, 3);

        if($nomorUrut === '000') {
            return response()->json([
                'success' => false,
                'message' => 'Nomor urut NIM tidak valid'
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    //Menampilkan data FAQ (pertanyaan yang sering ditanyakan)
    public function getFAQ() {
        $data = AdvoFAQ::join('advo_kategori', 'advo_faq.kategori', '=', 'advo_kategori.id_kategori')
            ->select(
                'advo_kategori.kategori as nama_kategori',
                'advo_kategori.foto as foto_kategori',
                'advo_faq.pertanyaan',
                'advo_faq.jawaban'
            )
            ->orderBy('advo_kategori.kategori')
            ->get()
            ->groupBy('nama_kategori');
        return view('FAQ', ['FAQ' => $data]);
    }

    public function getKategori(Request $req) {
        $kategori = $req->kategori;
        $data = AdvoKategori::where('id_kategori', $kategori)->value('kategori');
        
        return response()->json([
            'success' => True,
            'kategori' => $data
        ]);
    }

    public function listKategori() {
        $data = AdvoKategori::all(); //Ambil semua data di AdvoKategori
        return view('Form', ['kategori' => $data]);
    }

    public function generateTracking(Request $req) {
        return response()->json([
            'success' => true,
            'tracking_code' => $this->generateTrackingCode()
        ]);
    }

    public function trackAspirasi(Request $req) {
        $code = strtoupper($req->input('tracking_code'));
        $data = AdvoAspirasi::leftJoin(
            'advo_kategori', 'advo_aspirasi.kategori', '=', 'advo_kategori.id_kategori'
        )->leftJoin(
            'advo_status', 'advo_aspirasi.status', '=', 'advo_status.id_status'
        )->select(
            'advo_aspirasi.*',
            'advo_kategori.kategori as nama_kategori',
            'advo_status.status as nama_status'
        )->where('advo_aspirasi.tracking_code', $code)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Kode pelacakan tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'nama' => $data->nama,
                'nim' => $data->nim,
                'kategori' => $data->nama_kategori,
                'aspirasi' => $data->aspirasi,
                'status' => $data->nama_status,
                'tanggapan' => $data->tanggapan,
                'created_at' => $data->created_at ? $data->created_at->format('d/m/Y H:i') : null
            ]
        ]);
    }

    private function generateTrackingCode(): string {
        do {
            $code = Str::random(9);
        } while (AdvoAspirasi::where('tracking_code', $code)->exists());

        return $code;
    }

    public function aspirasiLimit(Request $req) {
        $ip = $req->ip();
        $nim = $req->nim;

        $sudahKirim = AdvoAspirasi::whereDate('created_at', now()->toDateString())
            ->where(function($query) use ($nim, $ip) {
                if($nim) {
                    $query->where('nim',$nim);
                } else {
                    $query->where('ip',$ip);
                }
            })->exists();
        
        if($sudahKirim) {
            return response()->json([
                'success' => true,
                'messageTitle' => 'Kamu sudah beraspirasi hari ini',
                'messageText' => 'Silahkan menunggu besok'
            ]);
        }
        
        return response()->json([
            'success' => false
        ], 200);
    }
}
