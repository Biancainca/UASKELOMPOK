<!-- resources/views/books/borrow.blade.php -->

@extends('layout.apps')

@section('content')
    <div class="container">
        <h2>Peminjaman Buku</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5>Detail Buku: {{ $book->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store.borrow') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <div class="mb-3">
                        <label for="bookTitle" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" id="bookTitle" value="{{ $book->title }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" id="author" value="{{ $book->author }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="category" value="{{ $book->category->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok Tersedia</label>
                        <input type="text" class="form-control" id="stock" value="{{ $book->stock }}" readonly>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
