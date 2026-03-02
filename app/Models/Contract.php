<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'contract_number',
        'entity_name',
        'contract_type',
        'signed_at',
        'duration',
        'end_date',
        'amount',
        'status',
        'signed_pdf_path',
        'notify_before_days',
    ];
}
