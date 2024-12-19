@extends('layout.apps')

@section('title', 'Selamat Datang di Perpustakaan Digital')

@section('content')
<div class="row">
    <!-- Informasi Website -->
    <div class="col-12 mb-4">
        <div class="card" >
            <div class="card-body">
                <div class="row" style="min-height: 50vh;">
                    <div class="col-12 my-auto">
                        <h1 class="card-title text-center mb-5">Selamat Datang di Perpustakaan Digital</h1>
                        <p class="card-text text-center px-5 mt-5">
                            Perpustakaan Digital adalah platform yang memudahkan Anda untuk mencari, membaca, dan meminjam buku secara online. 
                            Daftar sekarang untuk menikmati berbagai fitur menarik!
                        </p>
                        <div class="col-12 text-center mt-4">
                            @guest
                            <a href="{{route('login')}}" class="btn btn-primary"> Masuk </a> <a href="{{route('register')}}" class="ms-5 btn btn-warning"> Buat Akun </a>
                            @endguest
                            @auth
                            <a href="{{route('books.index')}}" class="ms-5 btn btn-warning"> Pinjam Sekarang </a>
                            @endauth
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Daftar Buku Terbaru -->
    <div class="col-12 mb-4">
        <h2>Buku Terbaru</h2>
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
    </div>

    <!-- Kategori Buku -->
    <div class="col-12 mb-4">
        <h2>Kategori Buku</h2>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="card text-center mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <a href="#" class="btn btn-outline-primary btn-sm">Lihat Buku</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
