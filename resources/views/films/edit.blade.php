@extends('layouts.app')

@section('title', 'Edit Film')

@section('content')
<h2>Edit Film</h2>

<form action="{{ route('films.update', $film->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul', $film->judul) }}" required>
    </div>
    <div class="mb-3">
        <label>Genre</label>
        <input type="text" name="genre" class="form-control" value="{{ old('genre', $film->genre) }}" required>
    </div>
    <div class="mb-3">
        <label>Tahun</label>
        <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $film->tahun) }}" required>
    </div>
    <div class="mb-3">
        <label>Sutradara</label>
        <input type="text" name="sutradara" class="form-control" value="{{ old('sutradara', $film->sutradara) }}" required>
    </div>
    <div class="mb-3">
        <label>Sinopsis</label>
        <textarea name="sinopsis" class="form-control" required>{{ old('sinopsis', $film->sinopsis) }}</textarea>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('films.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
