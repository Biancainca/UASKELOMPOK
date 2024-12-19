<?php

// app/Http/Controllers/BookController.php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan halaman dengan dua bagian: manageBooks dan all books
    public function list(Request $request)
    {
        // Fitur pencarian buku berdasarkan nama
        $query = Book::query();
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if($request->has('category')){
            $query->where('category_id',$request->category);
        }

        // Fitur urutkan buku berdasarkan nama atau tanggal
        if ($request->has('sort')) {
            $sort = $request->sort == 'title' ? 'title' : 'created_at';
            $query->orderBy($sort);
        }

        

        $books = $query->paginate(9);
        $categories = Category::all();  // Menampilkan semua kategori untuk CRUD

        if(auth()->user()){
        // Ambil buku yang dimiliki oleh user yang sedang login
        $userBooks = auth()->user()->books()->paginate(5);
        }else{
            $userBooks=[];
        }

        return view('books.index', compact('books', 'categories', 'userBooks'));
    }

    // Menampilkan halaman Create Book
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // Menampilkan halaman Edit Book
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // Store new book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'stock' => 'required|integer',
        ]);

        auth()->user()->books()->create($request->all());

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // Update book details
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'stock' => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui');
    }

    // Delete book
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }
}
