<?php

namespace App\Http\Controllers;

use App\Models\Event; // <-- Import model Event
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Menampilkan daftar semua acara
    public function index(Request $request) // Tambahkan Request $request
{
    // Ambil keyword pencarian dari URL query string
    $keyword = $request->input('search');

    // Mulai query builder
    $query = Event::query();

    // Jika ada keyword pencarian, tambahkan kondisi 'where'
    if ($keyword) {
        $query->where('nama_acara', 'like', "%{$keyword}%")
              ->orWhere('lokasi', 'like', "%{$keyword}%");
    }

    // Ambil data terbaru dengan paginasi
    $events = $query->latest()->paginate(10);

    // Penting: Agar paginasi tetap menyertakan query pencarian
    $events->appends(['search' => $keyword]);

    return view('events.index', compact('events'));
}


    // Menampilkan form untuk membuat acara baru
    public function create()
    {
        return view('events.create');
    }

    // Menyimpan acara baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_acara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')
                         ->with('success', 'Acara berhasil ditambahkan!');
    }

    // Menampilkan detail satu acara
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    // Menampilkan form untuk mengedit acara
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Mengupdate data acara di database
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'nama_acara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')
                         ->with('success', 'Acara berhasil diperbarui!');
    }

    // Menghapus acara dari database
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
                         ->with('success', 'Acara berhasil dihapus!');
    }
}
