<?php

// app/Http/Controllers/AttendeeController.php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    // Menyimpan peserta baru untuk sebuah acara
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:attendees,email',
            'no_telepon' => 'required|string|max:20',
        ]);

        // Menggunakan relasi untuk membuat peserta baru, event_id akan terisi otomatis
        $event->attendees()->create($request->all());

        return redirect()->route('events.show', $event->id)
                         ->with('success', 'Peserta berhasil ditambahkan!');
    }

    // Menampilkan form edit untuk seorang peserta
    public function edit(Attendee $attendee)
    {
        return view('attendees.edit', compact('attendee'));
    }

    // Mengupdate data peserta
    public function update(Request $request, Attendee $attendee)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:attendees,email,' . $attendee->id,
            'no_telepon' => 'required|string|max:20',
        ]);

        $attendee->update($request->all());

        // Redirect kembali ke halaman detail acara induknya
        return redirect()->route('events.show', $attendee->event_id)
                         ->with('success', 'Data peserta berhasil diperbarui!');
    }

    // Menghapus seorang peserta
    public function destroy(Attendee $attendee)
    {
        $eventId = $attendee->event_id; // Simpan event_id sebelum dihapus
        $attendee->delete();

        return redirect()->route('events.show', $eventId)
                         ->with('success', 'Peserta berhasil dihapus.');
    }
}
