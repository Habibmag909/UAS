<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'nama_lengkap',
        'email',
        'no_telepon',
    ];

    /**
     * Mendapatkan acara yang dimiliki oleh peserta.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}