<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(): View
    {
        return view('books.index', ['books' => Book::paginate(10)]);
    }

    public function create(): View
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'year' => 'required|integer',
            'copies_in_circulation' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')
            ->with('status', 'The book has been added successfully.');
    }

    public function edit($book)
    {
        $book = Book::find($book);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'year' => 'required',
            'copies_in_circulation' => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
            ->with('status', 'The book has been updated successfully.');
    }

    public function destroy(Book $book)
    {
        // Check if the book can be deleted (no loans)
        if ($book->canBeDeleted()) {
            // If there are no related loans, proceed with deletion
            $book->delete();

            return redirect()->route('books.index')
                ->with('status', 'Book deleted (all copies) successfully');
        } else {
            // If there are related loans, inform the user
            return redirect()->route('books.index')
            ->with('delete-status', 'Cannot delete book with related loans');
        }

    }
}
