@extends('layouts.master')

@section('title', 'Books')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Books</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Books</li>
            </ol>
            <a href="{{ url('/books/add') }}" class="btn btn-success">Add Books <i class="fa fa-plus"></i></a>
            <br>
            <br>
            <div class="card mb-4">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {!! session('success') !!}
                        </div>
                    @endif
                    @if(session('danger'))
                        <div class="alert alert-danger">
                            {!! session('danger') !!}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <table class="table table-bordered table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th>Book Code</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Quantity</th>
                                <th>Moving Quantity</th>
                                <th>Days to Return</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $key => $book)
                                <tr>
                                    <td>{{ $book->book_code }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->orig_quantity }}</td>
                                    <td>{{ $book->moving_quantity }}</td>
                                    <td>{{ $book->return_days }}</td>
                                    <td>{{ date('F d, Y', strtotime($book->created_at)) }}</td>
                                    <td>
                                        <a href="{{ url('/books/update/'.$book->book_code) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Update</a>
                                        <a href="{{ url('/books/delete/'.$book->book_code) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
