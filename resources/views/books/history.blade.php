<!-- resources/views/books/history.blade.php -->

@extends('layout.apps')

@section('content')
    <div class="container">
        <h2>Riwayat Peminjaman</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowings as $borrowing)
                    <tr>
                        <td>{{ $borrowing->id }}</td>
                        <td>{{ $borrowing->book->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($borrowing->borrowed_at)->format('d M Y') }}</td>
                        <td>@if($borrowing->returned_at)
                            {{ date('d M Y', strtotime($borrowing->returned_at)) }}
                            @else
                            Belum Dikembalikan
                            @endif
                        </td>
                        <td>
                            @if($borrowing->returned_at)
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-warning">Belum Dikembalikan</span>
                            @endif
                        </td>
                        <td>
                            @if(!$borrowing->returned_at)
                                <form action="{{ route('books.return', $borrowing->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Kembalikan Buku</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination justify-content-center">
            {{ $borrowings->links() }}
        </div>
    </div>
@endsection
