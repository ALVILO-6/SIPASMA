<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvoStruktur extends Model
{
    protected $table = "advo_struktur";
    protected $primaryKey = "nim";
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ["nim", "foto", "nama", "panggilan", "jabatan", "status_lantik", "password", "logged_in"];
}
