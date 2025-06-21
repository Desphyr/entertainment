@extends('layouts.app')

@section('title', 'Daftar Film')

@section('content')
<h2>Daftar Film</h2>
<a href="{{ route('films.create') }}" class="btn btn-primary mb-3">Tambah Film</a>
@php use Illuminate\Support\Str; @endphp

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Genre</th>
            <th>Tahun</th>
            <th>Sutradara</th>
            <th>Sinopsis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($films as $film)
        <tr>
            <td>{{ ($films->currentPage() - 1) * $films->perPage() + $loop->iteration }}</td>
            <td>{{ $film->judul }}</td>
            <td>{{ $film->genre }}</td>
            <td>{{ $film->tahun }}</td>
            <td>{{ $film->sutradara }}</td>
            <td>{{ Str::limit($film->sinopsis, 60) }}</td>
            <td>
                <a href="{{ route('films.show', $film->id) }}" class="btn btn-info btn-sm">Lihat</a>
                <a href="{{ route('films.edit', $film->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('films.destroy', $film->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Belum ada data film.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $films->links() }}
@endsection