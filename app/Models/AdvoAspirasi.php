<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvoAspirasi extends Model
{
    protected $table = "advo_aspirasi";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'nama', 'nim', 'ip', 'kategori', 'aspirasi', 'tracking_code', 'tanggapan', 'bersedia', 'status', 'pj'];
}
