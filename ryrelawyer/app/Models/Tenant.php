<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'domain',
        'logo',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    // Encrypt and decrypt the data attribute
    public function setDataAttribute($value): void
    {
        $this->attributes['data'] = Crypt::encryptString(json_encode($value));
    }

    public function getDataAttribute($value)
    {
        return json_decode(Crypt::decryptString($value), true);
    }
}
