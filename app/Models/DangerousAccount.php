<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DangerousAccount extends Model
{
    protected $fillable = [
        'ml_id',
        'server_id',
        'pelaku_nickname',
        'korban_nickname',
        'tanggal_kejadian',
        'bukti_file_path',
        'header_picture_path',
        'kronologi',
        'is_accepted',
    ];

    protected $casts = [
        'bukti_file_path' => 'array',
    ];
}
