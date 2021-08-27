@extends('layouts.master')

@section('title', 'Add Books')

<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Add Books</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Add Books</li>
            </ol>
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
                    @if(session('errors'))
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/books/add') }}">
                        @csrf
                        <div class="form-group">
                            <label for="book_code">Book Code</label>
                            <input type="text" name="book_code" class="form-control" placeholder="Book Code" autocomplete="off" value="{{ old('book_code') }}">
                        </div>

                        <div class="form-group mt-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title" autocomplete="off" value="{{ old('title') }}">
                        </div>

                        <div class="form-group mt-2">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control" placeholder="Author" autocomplete="off" value="{{ old('author') }}">
                        </div>

                        <div class="form-group mt-2">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'')" placeholder="Quantity" autocomplete="off" value="{{ old('quantity') }}">
                        </div>

                        <div class="form-group mt-2">
                            <label for="return_days">Days to Return <small>(* no# of days to return)</small></label>
                            <input type="number" name="return_days" class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'')" placeholder="" autocomplete="off" value="{{ old('return_days') }}">
                        </div>

                        <button type="submit" class="btn btn-success mt-3" style="float:right;"><i class="fa fa-plus"></i> Add Book</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
