<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvoStatus extends Model
{
    protected $table = 'advo_status';
    protected $primaryKey = 'id_status';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id_status', 'status'];
}
