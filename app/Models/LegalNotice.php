<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalNotice extends Model
{
    protected $fillable = [
        'type',
        'subject',
        'content',
        'contract_id',
        'legal_case_id',
        'sent_at',
        'recipient',
        'attachment_path',
    ];
}
