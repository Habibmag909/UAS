<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_acara',
        'tanggal',
        'lokasi',
        'deskripsi',
    ];

    /**
     * Mendapatkan semua peserta untuk acara ini.
     */
    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }
}