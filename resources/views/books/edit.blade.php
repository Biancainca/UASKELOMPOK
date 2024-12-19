<!-- resources/views/books/edit.blade.php -->

@extends('layout.apps')

@section('content')
<div class="container">
    <h2>Edit Buku</h2>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
            </div>
            <div class="col-md-2">
                <select name="category_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $book->stock) }}" required>
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary">Update Buku</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection
