@extends('layouts.app')

@section('title', 'Data Game')

@section('content')
<h2 class="mb-3">Data Game</h2>

<form id="gameForm">
    @csrf
    <input type="hidden" id="game_id">
    <div class="mb-2"><input type="text" id="judul" class="form-control" placeholder="Judul Game" required></div>
    <div class="mb-2"><input type="text" id="genre" class="form-control" placeholder="Genre" required></div>
    <div class="mb-2"><input type="text" id="developer" class="form-control" placeholder="Developer" required></div>
    <div class="mb-2"><input type="text" id="platform" class="form-control" placeholder="Platform" required></div>
    <div class="mb-2"><input type="number" id="tahun_rilis" class="form-control" placeholder="Tahun Rilis" required></div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>

<hr>

<table class="table mt-3" id="gameTable">
    <thead>
        <tr>
            <th>#</th><th>Judul</th><th>Genre</th><th>Developer</th><th>Platform</th><th>Tahun</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($games as $game)
        <tr id="game-{{ $game->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $game->judul }}</td>
            <td>{{ $game->genre }}</td>
            <td>{{ $game->developer }}</td>
            <td>{{ $game->platform }}</td>
            <td>{{ $game->tahun_rilis }}</td>
            <td>
                <button onclick="editGame({{ $game->id }})" class="btn btn-sm btn-warning">Edit</button>
                <button onclick="deleteGame({{ $game->id }})" class="btn btn-sm btn-danger">Hapus</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#gameForm').submit(function(e){
        e.preventDefault();
        let id = $('#game_id').val();
        let data = {
            _token: $('input[name="_token"]').val(),
            judul: $('#judul').val(),
            genre: $('#genre').val(),
            developer: $('#developer').val(),
            platform: $('#platform').val(),
            tahun_rilis: $('#tahun_rilis').val(),
        };

        if (id) {
            // Update
            $.ajax({
                url: '/games/' + id,
                type: 'PUT',
                data: data,
                success: function(res) {
                    let row = $('#game-' + res.id);
                    row.find('td').eq(1).text(res.judul);
                    row.find('td').eq(2).text(res.genre);
                    row.find('td').eq(3).text(res.developer);
                    row.find('td').eq(4).text(res.platform);
                    row.find('td').eq(5).text(res.tahun_rilis);
                    resetForm();
                }
            });
        } else {
            
            $.post('/games', data, function(res) {
                let nomor = $('#gameTable tbody tr').length + 1;
                $('#gameTable tbody').append(`
                    <tr id="game-${res.id}">
                        <td>${nomor}</td>
                        <td>${res.judul}</td>
                        <td>${res.genre}</td>
                        <td>${res.developer}</td>
                        <td>${res.platform}</td>
                        <td>${res.tahun_rilis}</td>
                        <td>
                            <button onclick="editGame(${res.id})" class="btn btn-sm btn-warning">Edit</button>
                            <button onclick="deleteGame(${res.id})" class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                `);
                resetForm();
            });
        }
    });

    function editGame(id) {
        $.get('/games/' + id + '/edit', function(game) {
            $('#game_id').val(game.id);
            $('#judul').val(game.judul);
            $('#genre').val(game.genre);
            $('#developer').val(game.developer);
            $('#platform').val(game.platform);
            $('#tahun_rilis').val(game.tahun_rilis);
        });
    }

    function deleteGame(id) {
        if (confirm('Yakin hapus data ini?')) {
            $.ajax({
                url: '/games/' + id,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function() {
                    $('#game-' + id).remove();
                }
            });
        }
    }

    function resetForm() {
        $('#gameForm')[0].reset();
        $('#game_id').val('');
    }
</script>
@endpush
