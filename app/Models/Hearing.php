<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hearing extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'scheduled_at',
        'notes',
    ];

    public function case()
    {
        return $this->belongsTo(CaseFile::class, 'case_id');
    }
}
