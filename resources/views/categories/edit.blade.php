<!-- resources/views/books/edit.blade.php -->

@extends('layout.apps')

@section('content')
<div class="container">
    <h2>Edit Kategori</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary">Update Kategori Buku</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection
