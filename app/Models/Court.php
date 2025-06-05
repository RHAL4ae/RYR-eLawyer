<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    public function cases()
    {
        return $this->hasMany(CaseFile::class, 'court_id');
    }
}
