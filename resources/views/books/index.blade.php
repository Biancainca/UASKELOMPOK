<!-- resources/views/books/index.blade.php -->

@extends('layout.apps')

@section('content')
    <div class="container">
        @auth
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="text-white">Buku Kamu  </h2>
            </div>
            <div class="card-body">
                <button class="btn btn-primary" data-bs-toggle="collapse" href="#manageBooks" role="button" aria-expanded="false" aria-controls="manageBooks">Lihat / Sembunyi</button>
                <a class="btn btn-info ms-2"  href="{{route('books.create')}}" >Tambah Buku</a>
                <div class="collapse mb-5" id="manageBooks">
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userBooks as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->category->name }}</td>
                                    <td>{{ $book->stock }}</td>
                                    <td>
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
        
                    {{ $userBooks->links() }}
                </div>
            </div>
        </div>
        <hr>
        @endauth
        <h2 class="mt-5">Semua Buku</h2>

        <form class="mb-3" method="GET" action="{{ route('books.index') }}">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search" placeholder="Cari Buku..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="sort">
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Urutkan berdasarkan Judul</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Urutkan berdasarkan Tanggal</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">Penulis: {{ $book->author }}</p>
                            <p class="card-text">Kategori: {{ $book->category->name }}</p>
                            <p class="card-text">Stok: {{ $book->stock }}</p>
                            <a href="{{route('books.borrow',$book->id)}}" class="btn btn-primary btn-sm">Pinjam Buku</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada buku yang tersedia.</p>
            @endforelse
        </div>

        <!-- Pagination untuk list all books -->
        {{ $books->links() }}
    </div>
@endsection
