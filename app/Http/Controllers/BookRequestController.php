<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Books;
use App\BookRequest;
use App\User;
use Auth;
use Session;
use Carbon\Carbon;

class BookRequestController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user')->only([
            'getUserBooksRequest',
            'getReturnBooksRequest',
            'getRequestBooks',
            'postRequestBooks'
        ]);
        $this->middleware('admin')->only([
            'getAdminBooksRequest',
            'getApproveBooksRequest',
            'getDeclineBooksRequest'
        ]);
    }
    
    public function getUserBooksRequest(){

        $user = Auth::user();

        $requests = BookRequest::with('user', 'approved', 'book')->where('user_id', $user->user_id)->get();

        return view('user.request_books', compact('user', 'requests'));
    }

    public function getAdminBooksRequest(){

        $user = Auth::user();

        $requests = BookRequest::with('user', 'approved', 'book')->orderBy('request_id', 'DESC')->get();

        return view('admin.request_books', compact('user', 'requests'));
    }
    
    public function getRequestBooks(){
        
        $user = Auth::user();
        
        $books = Books::orderBy('book_id', 'DESC')->get();

        return view('user.add_request', compact('user', 'books'));
    }

    public function postRequestBooks(Request $request){

        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'book_id' => 'required',
            'quantity' => 'required|numeric'
        ]);

        if($validator->fails()){
            
            Session::flash('errors', $validator->messages());
            return back()->withInput();
        }

        $book = Books::where('book_id', $request->book_id)->first();

        if(!$book){
            
            Session::flash('danger', 'Book does not exists');
            return back();
        }

        $sum_quantity = ($book->orig_quantity - $book->moving_quantity);

        if($request->quantity > $sum_quantity){

            Session::flash('danger', 'Quantity requested is invalid current stock: '.$sum_quantity);
            return back();
        }

        $generate_code = 'RQ-'.$user->user_id.'-'.date('His');

        $request_book = new BookRequest;
        $request_book->user_id = $user->user_id;
        $request_book->book_id = $request->book_id;
        $request_book->request_code = $generate_code;
        $request_book->quantity = $request->quantity;
        $request_book->date_request = date('Y-m-d');
        $request_book->save();

        Session::flash('success', 'Book has been successfully requested '.$generate_code);
        return redirect('/request/books/user');

    }

    public function getApproveBooksRequest($request_code, $book_code){

        $user = Auth::user();

        $approve = BookRequest::where('request_code', $request_code)->first();

        if(!$approve){
            
            Session::flash('danger', 'Request does not exists');
            return back();
        }
        
        $book = Books::where('book_code', $book_code)->first();

        if(!$book){
            
            Session::flash('danger', 'Book does not exists');
            return back();
        }
        
        $approve->approved_by = $user->user_id;
        $approve->date_approved = date('Y-m-d');
        $approve->date_return = Carbon::now()->addDays($book->return_days);
        $approve->status = 1;
        $approve->save();

        $moving = $book;
        $moving->moving_quantity = ((int)$book->moving_quantity + $approve->quantity);
        $moving->save();

        Session::flash('success', 'Book has been successfully approved '.$request_code);
        return back();
    }

    public function getDeclineBooksRequest($request_code, $book_code){

        $user = Auth::user();

        $approve = BookRequest::where('request_code', $request_code)->first();

        if(!$approve){
            
            Session::flash('danger', 'Request does not exists');
            return back();
        }

        $approve->approved_by = $user->user_id;
        $approve->status = 3;
        $approve->save();

        Session::flash('success', 'Book has been successfully declined '.$request_code);
        return back();
    }

    public function getReturnBooksRequest($request_code){

        $user = Auth::user();

        $approve = BookRequest::where('request_code', $request_code)->first();

        if(!$approve){
            
            Session::flash('danger', 'Request does not exists');
            return back();
        }

        $approve->returned = date('Y-m-d');
        $approve->status = 2;
        $approve->save();

        $book = Books::where('book_id', $approve->book_id)->first();
        if(!$book){
            
            Session::flash('danger', 'Book does not exists');
            return back();
        }

        $moving = $book;
        $moving->moving_quantity = ((int)$book->moving_quantity - $approve->quantity);
        $moving->save();

        Session::flash('success', 'Book has been successfully returened '.$request_code);
        return back();
    }
}