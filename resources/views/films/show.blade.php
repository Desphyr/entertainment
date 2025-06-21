@extends('layouts.app')

@section('title', 'Detail Film')

@section('content')
<h2>Detail Film</h2>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $film->judul }}</h5>
        <p><strong>Genre:</strong> {{ $film->genre }}</p>
        <p><strong>Tahun:</strong> {{ $film->tahun }}</p>
        <p><strong>Sutradara:</strong> {{ $film->sutradara }}</p>
        <p><strong>Sinopsis:</strong><br>{{ $film->sinopsis }}</p>
        <a href="{{ route('films.edit', $film->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('films.destroy', $film->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger">Hapus</button>
        </form>
        <a href="{{ route('films.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
