<?php

// app/Http/Controllers/BookController.php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function borrow($id)
    {
        // Menampilkan buku yang tersedia untuk dipinjam
        $book = Book::find($id);
        return view('books.borrow', compact('book'));
    }

    // Menangani proses peminjaman buku
    public function storeBorrow(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        // Mencari buku yang dipilih
        $book = Book::findOrFail($request->book_id);

        // Memeriksa apakah stok buku masih tersedia
        if ($book->stock <= 0) {
            return redirect()->route('books.borrow')->with('error', 'Buku ini sudah tidak tersedia.');
        }

        // Menambahkan peminjaman
        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        // Mengurangi stok buku
        $book->decrement('stock');

        return redirect()->route('books.history')->with('success', 'Buku berhasil dipinjam.');
    }

    // Menampilkan riwayat peminjaman buku pengguna
    public function history()
    {
        // Mengambil riwayat peminjaman pengguna yang sedang login
        $borrowings = Borrowing::where('user_id', auth()->id())
            ->with('book')  // Menambahkan relasi dengan tabel books
            ->paginate(10);

        return view('books.history', compact('borrowings'));
    }

    // Menandai peminjaman sebagai dikembalikan
    public function returnBook($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        // Menandai peminjaman sebagai dikembalikan dan mengembalikan stok buku
        $borrowing->returned_at = now();
        $borrowing->save();

        // Mengembalikan stok buku
        $borrowing->book->increment('stock');

        return redirect()->route('books.history')->with('success', 'Buku berhasil dikembalikan.');
    }
}
