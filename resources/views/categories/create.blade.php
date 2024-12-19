<!-- resources/views/books/create.blade.php -->

@extends('layout.apps')

@section('content')
<div class="container">
    <h2>Tambah Kategori Buku Baru</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Nam Kategori" required>
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-success">Tambah Kategori Buku</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection
