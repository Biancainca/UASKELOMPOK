<?php

// app/Http/Controllers/BookController.php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan halaman dengan dua bagian: manageBooks dan all books
    public function list(Request $request)
    {

        $query = Category::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort')) {
            $sort = $request->sort == 'name' ? 'name' : 'created_at';
            $query->orderBy($sort);
        }

        $categories = $query->paginate(9);

        if(auth()->user()){
        $userCategories = auth()->user()->categories()->paginate(5);
        }else{
            $userCategories=[];
        }
        return view('categories.index', compact('categories', 'userCategories'));
    }

    // Menampilkan halaman Create Book
    public function create()
    {
        return view('categories.create');
    }

    // Menampilkan halaman Edit Book
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Store new book
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        auth()->user()->categories()->create($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Update book details
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    // Delete book
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
