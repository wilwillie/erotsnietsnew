<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DangerousPhoneNumber extends Model
{
    protected $fillable = [
        'phone_number',
        'keterangan',
    ];
}
