<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function getAllBooks()
    {
        $_books = Books::all();
        return $_books;
    }

    public function getBookById($id)
    {
        $_book = Books::find($id);

        if (!$_book) {
            return ['msg' => 'No Book available in this ID'];
        }
        return $_book;
    }

    public function createBook()
    {
        request()->validate([
            'name' => 'required',
            'content' => 'required',
            'author' => 'required'
        ]);

        $_books =  new Books();
        $_books->name = request('name');
        $_books->content = request('content');
        $_books->author = request('author');
        $_books->year = request('year');
        $_books->save();

        return $_books;
    }

    public function updateBook($id)
    {
        $_book = Books::find($id);

        $_book->update([
            'name' => request('name'),
            'content' => request('content'),
            'author' => request('author'),
            'year' => request('year'),
        ]);

        $_book->save();
        return $_book;
    }

    public function deleteBook($id)
    {
        $_book = Books::find($id);
        $success = $_book->delete();

        return ['success' => $success];
    }
}
