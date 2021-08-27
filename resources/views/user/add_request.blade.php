@extends('layouts.master')

@section('title', 'Add Request')

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
            <h1 class="mt-4">Add Request</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Add Request</li>
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

                    <form method="POST" action="{{ url('/request/books/add') }}">
                        @csrf
                        <div class="form-group">
                            <label for="book_id">Choose Book</label>
                            <select name="book_id" class="form-control" autocomplete="off" value="{{ old('book_id') }}">
                                <option selected disabled>Choose Book</option>
                                @foreach($books as $book)
                                    @if($book->orig_quantity != $book->moving_quantity)
                                        <option value="{{ $book->book_id }}">{{ $book->book_code }} - {{ $book->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'')" placeholder="Quantity" autocomplete="off" value="{{ old('quantity') }}">
                        </div>
                        <button type="submit" class="btn btn-success mt-3" style="float:right;"><i class="fa fa-plus"></i> Add Request</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
