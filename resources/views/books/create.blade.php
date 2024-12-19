<!-- resources/views/books/create.blade.php -->

@extends('layout.apps')

@section('content')
<div class="container">
    <h2>Tambah Buku Baru</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="title" class="form-control" placeholder="Judul Buku" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="author" class="form-control" placeholder="Pengarang" required>
            </div>
            <div class="col-md-2">
                <select name="category_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="stock" class="form-control" placeholder="Stok" required>
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-success">Tambah Buku</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection
