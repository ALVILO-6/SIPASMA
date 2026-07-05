<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvoFAQ extends Model
{
    protected $table = 'advo_faq';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $fillable = ['id', 'kategori', 'pertanyaan', 'jawaban'];
}
