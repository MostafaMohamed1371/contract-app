<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    protected $fillable = [
        'case_number',
        'file_number',
        'court',
        'case_type',
        'parties',
        'responsible_lawyer',
        'next_hearing_at',
        'status',
        'attachments',
    ];
}
