<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvoKategori extends Model
{
    protected $table = 'advo_kategori';
    protected $primaryKey = 'id_kategori';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id_kategori','kategori', 'foto'];
}
