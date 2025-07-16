<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah total record dari masing-masing tabel
        $eventCount = Event::count();
        $attendeeCount = Attendee::count();

        // Mengirim data ke view 'dashboard'
        return view('dashboard', compact('eventCount', 'attendeeCount'));
    }
}