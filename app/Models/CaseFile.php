<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseFile extends Model
{
    use HasFactory;

    protected $table = 'cases';

    protected $fillable = [
        'title',
        'description',
        'client_id',
        'lawyer_id',
        'court_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function hearings()
    {
        return $this->hasMany(Hearing::class, 'case_id');
    }
}
