<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FilmController extends Controller
{
    public function index(): View
    {
        $films = Film::latest()->paginate(5);
        return view('films.index', compact('films'));
    }

    public function create(): View
    {
        return view('films.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'judul' => 'required',
            'genre' => 'required',
            'tahun' => 'required|integer',
            'sutradara' => 'required',
            'sinopsis' => 'required',
        ]);

        Film::create($request->all());
        return redirect()->route('films.index')->with('success', 'Film berhasil ditambahkan!');
    }

    public function show(Film $film): View
    {
        return view('films.show', compact('film'));
    }

    public function edit(Film $film): View
    {
        return view('films.edit', compact('film'));
    }

    public function update(Request $request, Film $film): RedirectResponse
    {
        $request->validate([
            'judul' => 'required',
            'genre' => 'required',
            'tahun' => 'required|integer',
            'sutradara' => 'required',
            'sinopsis' => 'required',
        ]);

        $film->update($request->all());
        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui!');
    }

    public function destroy(Film $film): RedirectResponse
    {
        $film->delete();
        return redirect()->route('films.index')->with('success', 'Film berhasil dihapus!');
    }
}
