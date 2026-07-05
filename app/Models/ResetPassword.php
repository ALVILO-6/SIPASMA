<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    const UPDATED_AT = NULL;

    protected $table = 'reset_password';
    protected $primaryKey = 'id';
    protected $fillable = ['nim', 'token'];
}