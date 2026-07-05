<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AdvoStruktur;
use App\Models\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function checkNIM(Request $req) {
        $req->validate([
            'nim' => 'required'
        ]);

        $user = AdvoStruktur::where('nim', $req->nim)->first();

        if($user) {
            return response()->json([
                'success' => true,
                'nama' => $user->nama,
                'jabatan' => $user->jabatan
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'NIM tidak terdaftar di database kami.'
            ]);
        }
    }

    public function validateUser(Request $req) {
        $req->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        $user = AdvoStruktur::where('nim', $req->nim)->first();
        
        if(!$user || !Hash::check($req->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah'
            ]);
        }

        //Cek apakah user sudah login atau belum. Jika sudah, device lain tidak bisa login
        if($user->logged_in) {
            return response()->json(['error' => 'User sudah login di device lain']);
        }

        //Update status login di database jika berhasil login
        $loggedIn = $user->update(['logged_in' => true]);

        session([
            'nim' => $user->nim,
            'nama' => $user->nama,
            'panggilan' => $user->panggilan,
            'jabatan' => $user->jabatan,
            'logged_in' => $loggedIn
        ]);

        return response()->json([
            'success' => true,
            'redirect' => url(route('dashboard')),
            'nim' => $user->nim,
            'nama' => $user->nama,
            'panggilan' => $user->panggilan,
            'jabatan' => $user->jabatan,
        ]);
    }

    public function logout() {
        //Tampilkan panggilan di blade sebelum dihapus dari session
        $panggilan = session('panggilan');

        if(session()->has('nim')) {
            AdvoStruktur::where('nim', session('nim'))->update(['logged_in' => false]);
        }

        session()->flush();
        return response()->json([
            'success' => true,
            'panggilan' => $panggilan,
            'message' => 'Logout Berhasil'
        ]);
    }

    public function forgetPassword(Request $req) {
        $req->validate([
            'nim' => 'required'
        ]);

        $nim = $req->nim;
        
        //Cek apakah NIM ada di database
        $user = AdvoStruktur::where('nim',$nim)->first();

        if(!$user) {
            return response()->json([
                'success' => false,
                'messageTitle' => 'NIM Tidak Ditemukan',
                'messageText' => 'NIM tidak terdaftar di database kami'
            ]);
        }
        
        //Jika ada
        $email = $nim.'@student.uksw.edu'; //Jadikan email
        $token = Str::random(9);

        //Hapus token jika ada, untuk diperbarui ke yang baru
        ResetPassword::where('nim',$nim)->delete();

        //Buat baris baru
        ResetPassword::create([
            'nim' => $nim,
            'token' => $token
        ]);

        //Kirim email
        try {
            Mail::raw(
                "Kode reset password (berlaku selama 15 menit): $token.",
                function($message) use ($email) {
                    $message->to($email)->subject('Reset Token');
                }
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'messageTitle' => 'Terjadi Kesalahan',
                'messageText' => 'Gagal memverifikasi NIM'
            ]);
        }

        //Kembalikan json
        return response()->json([
            'success' => true,
            'messageTitle' => 'Token Reset Telah Dikirim',
            'messageText' => 'Silahkan cek email student.' 
        ]);
    }

    public function validateToken(Request $req) {
        $req->validate([
            'token' => 'required'
        ]);

        $token = $req->token;

        if(!$token) {
            return response()->json([
                'success' => false,
                'messageTitle' => 'Token Kosong',
                'messageText' => 'Isi token untuk lanjut'
            ]);
        }

        $resetToken = ResetPassword::where('token',$token)->first();

        if(!$resetToken) {
            return response()->json([
                'success' => false,
                'messageTitle' => 'Token Tidak Ditemukan',
                'messageText' => 'Silahkan minta token baru'
            ]);
        }

        if($resetToken->created_at->addMinutes(5)->isPast()) {
            return response()->json([
                'success' => false,
                'messageTitle' => 'Token Sudah Kadaluwarsa',
                'messageText' => 'Silahkan minta token baru'
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function resetPassword(Request $req) {
        //Validasi  kesamaan konfirmasi password dengan password baru
        $req->validate([
            'token' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required|same:password'
        ]);

        $resetToken = ResetPassword::where('token',$req->token)->first();

        //Cek NIM di database
        $user = AdvoStruktur::where('nim',$resetToken->nim)->first();

        //Update password dengan password baru
        $user->password = Hash::make($req->password);
        $user->save();

        //Hapus session & kolom reset password jika password sudah diubah
        ResetPassword::where('token',$req->token)->delete();

        return response()->json([
            'success' => true,
            'messageTitle' => 'Password Berhasil Diubah',
            'messageText' => 'Silahkan login dengan password baru'
        ]);
    }
}
