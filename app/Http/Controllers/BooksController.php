<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Books;
use Auth;
use Session;

class BooksController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function getBooks(){

        $user = Auth::user();
        $books = Books::orderBy('book_id', 'DESC')->get();

        return view('admin.books', compact('user', 'books'));
    }

    public function getAddBooks(){
        
        $user = Auth::user();

        return view('admin.add_books', compact('user'));
    }

    public function postAddBooks(Request $request){

        $validator = Validator::make($request->all(), [
            'book_code' => 'required|unique:tbl_books',
            'title' => 'required',
            'author' => 'required',
            'quantity' => 'required|numeric',
            'return_days' => 'required|numeric',
        ]);

        if($validator->fails()){
            
            Session::flash('errors', $validator->messages());
            return back()->withInput();
        }

        $books = new Books;
        $books->book_code = $request->book_code;
        $books->title = $request->title;
        $books->author = $request->author;
        $books->orig_quantity = $request->quantity;
        $books->moving_quantity = 0;
        $books->return_days = $request->return_days;
        $books->save();

        Session::flash('success', 'Book has been successfully add Book Code: '.$books->book_code);
        return redirect('/books');
    }

    public function getUpdateBooks($book_code){

        $user = Auth::user();
        $book = Books::where('book_code', $book_code)->first();

        return view('admin.update_books', compact('user', 'book'));
    }

    public function postUpdateBooks(Request $request, $book_code){

        $validator = Validator::make($request->all(), [
            'book_code' => 'required|unique:tbl_books,book_code,'.$request->book_code.',book_code',
            'title' => 'required',
            'author' => 'required',
            'quantity' => 'required|numeric',
            'return_days' => 'required|numeric',
        ]);

        if($validator->fails()){
            
            Session::flash('errors', $validator->messages());
            return back()->withInput();
        }

        $books = Books::where('book_code', $book_code)->first();
        $books->book_code = $request->book_code;
        $books->title = $request->title;
        $books->author = $request->author;
        $books->orig_quantity = $request->quantity;
        $books->return_days = $request->return_days;
        $books->save();

        Session::flash('success', 'Book has been successfully updated Book Code: '.$books->book_code);
        return redirect('/books');
    }

    public function postDeleteBooks($book_code){

        Books::where('book_code', $book_code)->delete();

        Session::flash('success', 'Book has been successfully deleted');
        return redirect('/books');
    }

}
