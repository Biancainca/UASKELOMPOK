<!-- resources/views/books/index.blade.php -->

@extends('layout.apps')

@section('content')
    <div class="container">
        @auth
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="text-white">Kategori Kamu</h2>
            </div>
            <div class="card-body">
                <button class="btn btn-primary" data-bs-toggle="collapse" href="#manageCategories" role="button" aria-expanded="false" aria-controls="manageCategories">Lihat / Sembunyi</button>
                <a class="btn btn-info ms-2"  href="{{route('categories.create')}}" >Tambah Kategori Buku</a>
                <div class="collapse mb-5" id="manageCategories">
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userCategories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
        
                    <!-- Pagination untuk manage books -->
                    {{ $userCategories->links() }}
                </div>
            </div>
        </div>
        @endauth
        

        <hr>
        <!-- Bagian List Semua Buku -->
        <h2 class="mt-5">Semua Kategori</h2>

        <form class="mb-3" method="GET" action="{{ route('categories.index') }}">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search" placeholder="Cari Kategori..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="sort">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Urutkan berdasarkan Kategori</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Urutkan berdasarkan Tanggal</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="card text-center mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <a href="{{route('books.index','?category='.$category->id)}}" class="btn btn-outline-primary btn-sm">Lihat Buku</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination untuk list all books -->
        {{ $categories->links() }}
    </div>
@endsection
