<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $books = Book::where('name', 'LIKE', '%'.$request->cari.'%')->simplePaginate(5)->appends($request->all());
        return view('pages.data_buku', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('book.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'no_buku' => 'required',
            'name' => 'required',
            'type' => 'required',
            'genre' => 'required',
            'stock' => 'required'
        ]);

        Book::create($request->all());
        return redirect()->route('data_buku.data')->with('success', 'Berhasil menambahkan Buku!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, $id)
    {
        //
        $book = Book::find($id);
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'genre' => 'required',
        ]);

        Book::where('id', $id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'genre' => $request->genre
        ]);

        return redirect()->route('data_buku.data')->with('success', 'Berhasil mengubah data Buku!');
    }

    public function updateStock(Request $request, $id)
    {
        // submit form tidak menggunakan ajax, untuk mendeteksi old (riwayat isi) ketika input dikosongkan, pengecekan required menggunakan isset 
        if(isset($request->stock) == FALSE){
            $bookBefore = Book::find($id);
            return redirect()->back()->with([
                'failed' => 'Stock tidak boleh kosong!', 
                'id' => $id, 
                'stock' => $bookBefore['stock']
        ]);
        }
        // jika tidak kosong, proses update berjalan 
        Book::where('id', $id)->update(['stock' => $request->stock]);
        return redirect()->back()->with('success', 'Berhasil mengubah stock Obat!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, $id)
    {
        //
        Book::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data Buku!');
    }
}
