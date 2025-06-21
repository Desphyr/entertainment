@extends('layouts.app')

@section('title', 'Tambah Film')

@section('content')
<h2>Tambah Film</h2>

<form action="{{ route('films.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Genre</label>
        <input type="text" name="genre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tahun</label>
        <input type="number" name="tahun" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Sutradara</label>
        <input type="text" name="sutradara" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Sinopsis</label>
        <textarea name="sinopsis" class="form-control" required></textarea>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('films.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
