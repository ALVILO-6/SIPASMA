<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvoStruktur;
use App\Models\AdvoAspirasi;
use App\Models\AdvoKategori;
// use App\Models\AdvoStatus;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboards() {
        //Kondisi jika NIM tidak ada di session
        if(!session()->has('nim')) {
            //Cek apakah ada user yang masih logged_in = true
            $user = AdvoStruktur::where('logged_in',true)->first();

            if($user) {
                //Session expired, matikan logged_in
                $user->update(['logged_in' => false]);
            }
            
            return redirect('/login');
        }

        $nim = session('nim');
        $jabatan = session('jabatan');

        $pj = AdvoStruktur::select('nama')
            ->where('jabatan', 'like', 'Fungsionaris%')
            ->orderBy('nama')
            ->get(); //Untuk menampilkan data seluruh anggota dengan role fungsionaris yang akan jadi PJ

        $query = AdvoAspirasi::leftJoin(
            'advo_kategori', 'advo_aspirasi.kategori', '=', 'advo_kategori.id_kategori'
        )->leftJoin(
            'advo_status', 'advo_aspirasi.status', '=', 'advo_status.id_status'
        )->select(
            'advo_aspirasi.*',
            'advo_kategori.kategori',
            'advo_status.status as nama_status'
        )->where('advo_aspirasi.status','!=','STS4');

        if(!in_array($jabatan, [
            'Ketua Komisi Advokasi', 'Sekretaris Komisi Advokasi'
        ])) {
            $query->where('advo_aspirasi.pj',$nim);
        }

        $data = $query->orderBy('created_at', 'desc')->get();
        
        return view('Dashboard', [
            'aspirasi' => $data,
            'pj' => $pj,
            'nim' => $nim,
            'name' => session('nama'),
            'panggilan' => session('panggilan'),
            'jabatan' => session('jabatan')
        ]);
    }

    //Untuk mengambil data panggilan PJ
    public function getPJ(Request $req) {
        $nama = $req->nama;

        $data = AdvoStruktur::where('nama', $nama)->first();

        return response()->json([
            'success' => true,
            'panggilan' => $data->panggilan
        ]);
    }

    public function deletePJ($id) {
        AdvoAspirasi::where('id',$id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Aspirasi berhasil dihapus.'
        ]);
    }

    public function updatePJ(Request $req, $id) {
        $nama = $req->input('nama');
        $nim = AdvoStruktur::where('nama',$nama)->value('nim');
        AdvoAspirasi::where('id',$id)->update(['pj' => $nim, 'status' => 'STS2']);

        $data = AdvoStruktur::where('nama',$nama)->first();

        return response()->json([
            'success' => true,
            'panggilan' => $data->panggilan,
            'message' => 'PJ berhasil ditambahkan.'
        ]);
    }

    public function updateStatus(Request $req, $id) {
        $status = $req->input('status');

        AdvoAspirasi::where('id',$id)->update(['status' => $status]);
        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui.'
        ]);
    }

    public function updateTanggapan(Request $req, $id) {
        $tanggapan = $req->input('tanggapan');

        //Update tanggapan, dan langsung update menjadi selesai
        AdvoAspirasi::where('id', $id)->update([
            'tanggapan' => $tanggapan,
            'status' => 'STS4'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tanggapan berhasil disimpan.'
        ]);
    }

    public function nimPJ(Request $req) {
        $nim = $req->nim;
        $nama = AdvoStruktur::where('nim',$nim)->value('nama');

        return response()->json([
            'success' => true,
            'nama' => $nama
        ]);
    }

    public function aspirasiDone() {
        if(!session()->has('nim')) {
            //Cek apakah ada user yang masih logged_in = true
            $user = AdvoStruktur::where('logged_in',true)->first();

            if($user) {
                //Session expired, matikan logged_in
                $user->update(['logged_in' => false]);
            }
            
            return redirect('/login');
        }

        $done = AdvoAspirasi::leftJoin(
            'advo_kategori', 'advo_aspirasi.kategori', '=', 'advo_kategori.id_kategori'
        )->leftJoin(
            'advo_status', 'advo_aspirasi.status', '=', 'advo_status.id_status'
        )->leftJoin(
            'advo_struktur', 'advo_aspirasi.pj', '=', 'advo_struktur.nim'
        )->select(
            'advo_aspirasi.*',
            'advo_kategori.kategori',
            'advo_status.status as nama_status',
            'advo_struktur.nama as nama_pj'
        )->where('advo_aspirasi.status','=','STS4')
        ->orderBy('created_at', 'desc')->get();

        //Tampilkan card
        $total = AdvoAspirasi::count(); //Jumlah keseluruhan aspirasi
        $selesai = AdvoAspirasi::where('status', 'STS4')->count(); //Aspirasi yang sudah selesai
        $progress = AdvoAspirasi::where('status', '!=', 'STS4')->count(); //Aspirasi yang belum selesai

        return view('Done', [
            'aspirasi' => $done,
            'name' => session('nama'),
            'jabatan' => session('jabatan'),
            'total' => $total,
            'progress' => $progress,
            'done' => $selesai
        ]);
    }

    public function pieChart() {
        $pie = AdvoAspirasi::leftJoin(
            'advo_kategori', 'advo_aspirasi.kategori', '=', 'advo_kategori.id_kategori'
        )->select('advo_kategori.kategori as kat')
            ->selectRaw('count(*) as total')->groupBy('kat')->get();

        return response()->json([
            'pie' => $pie,
        ]);
    }

    public function lineGraph() {
        $start = Carbon::now()->startOfMonth()->subMonth(12);
        $end = Carbon::now()->endOfMonth();

        $line = AdvoAspirasi::select(
            AdvoAspirasi::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'), 
            AdvoAspirasi::raw('count(*) as total')
        )->whereBetween('created_at',[$start, $end])
        ->groupBy('bulan')->orderBy('bulan', 'asc')->get();

        return response()->json([
            'line' => $line
        ]);
    }
}
